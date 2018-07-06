<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Http\Requests;

use App\Address, App\City, App\OrderProduct, App\Client, App\Transcation;
use App\Tracking;

use Auth;
use Log;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id);
		if ($request->has('no')) $orders = $orders->where('no', 'like', '%' . $request->no . '%');
        if ($request->has('status_id')) $orders = $orders->where('status_id', $request->input('status_id'));
        //if ($request->has('no')) $query = $query->where('no', $request->no);
		// if ($request->has('nickname')) $query = $query->where('users.nickname', $request->input('name'));
		// if ($request->has('price')) $query = $query->where('orders.price', $request->input('price'));

        $orders = $orders->where('status_id', '>=', '0');
        $orders = $orders->orderBy('id', 'desc');

        // request flash to access the old value
        $request->flash();

        $orders = $orders->paginate(20);
        $orders->appends($request->all());


        return view('orders.index', ['nav' => 'order', 'orders' => $orders ]);
    }

    /**
     * 包裹回收站列表
     *
     * @return Response
     */
    public function trash(Request $request)
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id);
        if ($request->has('no')) $orders = $orders->where('no', 'like', '%' . $request->no . '%');
        //if ($request->has('no')) $query = $query->where('no', $request->no);
        // if ($request->has('nickname')) $query = $query->where('users.nickname', $request->input('name'));
        // if ($request->has('price')) $query = $query->where('orders.price', $request->input('price'));

        // 回收站中包裹status为负数
        $orders = $orders->where('status_id', '<', '0');
        $orders = $orders->orderBy('id', 'desc');

        // request flash to access the old value
        $request->flash();

        $orders = $orders->paginate(20);
        $orders->appends($request->all());


        return view('orders.trash', ['nav' => 'order', 'orders' => $orders ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request, $id)
    {
        $client = Client::find($id);
        return view('orders.create', ['nav' => 'order', 'client' => $client]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $order = new Order;
        $order->user_id = $user->id;
        $order->client_id = $request->client_id;
        $order->type_id = $request->type_id;
        $order->source = $request->source;
        $order->save();

        // 刷新订单号
        $nostr = strval($order->id);
        // 补足6位订单后缀
        while(strlen($nostr) < 6) {
          $nostr = '0' . $nostr;
        }
        $order->no = date("Ymd") . $nostr;
        $order->save();

        return redirect()->route('order.waybill', ['id' => $order->id]);
    }

    public function waybill(Request $request, $id)
    {
        // 获取所有发货地址
        $order = Order::find($id);
        $user = Auth::user();
        $addresses = Address::where('client_id', $order->client_id) -> get();

        // 发货地城市列表
        $cities = City::get();
        //
        return view('orders.waybill', ['nav' => 'order', 'order' => $order, 'addresses' => $addresses, 'cities' => $cities]);
    }

    public function storeWaybill(Request $request)
    {
        // 获取所有发货地址
        $user = Auth::user();
        // 储存数据
        $oid = $request->oid;
        $order = Order::find($oid);
        // 存储发货信息
        $order->name = $request->name;
        $order->mobile = $request->mobile;
        $order->country = $request->country;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->zip = $request->zip;
        $order->tel = $request->tel;
        $order->mailbox = $request->mailbox;

        // 存储收货信息
        $order->shipping_name = $request->shipping_name;
        $order->shipping_mobile = $request->shipping_mobile;
        $order->shipping_state = $request->shipping_state;
        $order->shipping_city = $request->shipping_city;
        $order->shipping_district = $request->shipping_district;
        $order->shipping_address = $request->shipping_address;
        $order->shipping_zip = $request->shipping_zip;

        $order->save();
        //
        return redirect()->route('order.products', ['id' => $order->id]);
    }

    public function products(Request $request, $id)
    {
        $order = Order::find($id);
        $ops = $order->orderProducts;
        return view('orders.products', ['nav' => 'order', 'order' => $order, 'ops' => $ops]);
    }

    /**
     * 存储订单内的商品列表
     * @param  int  $id
     * @return Response
     */
    public function storeProducts(Request $request)
    {
        $order = Order::find($request->oid);

        // 删除原有订单中所有商品
        OrderProduct::where('order_id', $order->id)->delete();

        // 存储所有商品
        $products = $request->products;
        foreach($products as $product) {
            $op = new OrderProduct;
            $op->order_id = $order->id;
            $op->category_id = $product['category'];
            $op->name = $product['name'];
            $op->model = $product['model'];
            $op->number = $product['number'];
            $op->price = $product['price'];
            $op->save();
        }

        $order->status_id = 1;
        $order->weight = $request->weight;
        $order->price = $request->weight * 8.0;
        $order->save();

        return redirect()->route('order.payment', ['id' => $order->id]);
    }

    /**
     * 存储订单内的商品列表
     * @param  int  $id
     * @return Response
     */
    public function payment(Request $request, $id)
    {
        $order = Order::find($id);
        $ops = $order->orderProducts;
        return view('orders.payment', ['nav' => 'order', 'order' => $order, 'ops' => $ops]);
    }

    public function storePayment(Request $request)
    {
        $user = Auth::user();

        // 修改订单状态为已付款，记录付款时间
        $order = Order::find($request->oid);
        $order->status_id = 2;
        $order->paid_at = Carbon::now();
        $order->save();
        
        // 生成第一条追踪信息
        $tracking = new Tracking;
        $tracking->order_id = $order->id;
        $tracking->location = '西班牙';
        $tracking->description = '已揽件';
        $tracking->save();

        // 扣除寄件人的费用
        $client = $order->client;
        $client->balance = $client->balance - $order->price;
        $client->save();

        // 保存财务信息
        $transcation = new Transcation;
        $transcation->type = '运单支付';
        $transcation->user_id = $user->id;
        $transcation->client_id = $client->id;
        $transcation->order_no = $order->no;
        $transcation->amount = $order->price;
        $transcation->save();

        return redirect()->route('order.done', ['id' => $order->id]);
    }

    /**
     * 显示订单成功页面
     * @param  int  $id
     * @return Response
     */
    public function done(Request $request, $id)
    {
        $order = Order::find($id);
        return view('orders.done', ['nav' => 'order', 'order' => $order]);
    }

    public function tracking(Request $request)
    {
        $order = Order::find($request->oid);
        $status = 1;
        if($request->code == '0000') $status = 0;
        return view('orders.tracking', ['nav' => 'order', 'order' => $order, 'status' => $status]);
    }

    public function qr(Request $request, $id)
    {
        //$order = Order::find($id);
        return view('orders.qr', ['nav' => 'order']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->status_id = -1;
        $order->save();
        return redirect()->route('order.index')->with('status', '包裹编号 - ' . $order->no . ' 已放入回收站');
    }
    
    /**
     * 显示订单详情
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $order = Order::find($id);
        return view('orders.show', ['nav' => 'order', 'order' => $order]);
    }
}
