<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client, App\User, App\City, App\Transcation;

use Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $clients = Client::where('user_id', $user->id) -> orderBy('id', 'desc');
        if ($request->has('name')) $clients = $clients->where('name', 'like', '%' . $request->name . '%');
        // if ($request->has('no')) $query = $query->where('no', $request->no);
        // if ($request->has('nickname')) $query = $query->where('users.nickname', $request->input('name'));
        // if ($request->has('app')) $query = $query->where('orders.app', $request->input('app'));
        // if ($request->has('price')) $query = $query->where('orders.price', $request->input('price'));
        // if ($request->has('status')) $query = $query->where('orders.status', $request->input('status'));

        // $request->flash();
        // $orders = $query->where('orders.price', '<>', '0.0') -> orderBy('orders.id', 'desc') -> paginate(20);
        // $orders->appends($request->all());

        $clients = $clients->get();

        // request flash to access the old value
        $request->flash();

        return view('clients.index', ['nav' => 'client', 'clients' => $clients, 'user' => $user ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $client = Client::find($id);
        $addresses = $client->addresses;
        $shippingAddresses = $client->shippingAddresses;
        $cities = City::get();
        return view('clients.show', ['nav' => 'client', 
                                        'client' => $client, 
                                        'addresses' => $addresses, 
                                        'shippingAddresses' => $shippingAddresses, 
                                        'cities' => $cities]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function charge(Request $request, $id)
    {
        $client = Client::find($id);
        return view('clients.charge', ['nav' => 'client', 'client' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function store_charge(Request $request)
    {
        $user = Auth::user();
        
        $client = Client::find($request->client_id);
        $client->balance += $request->amount;
        $client->save();
        
        // 保存财务信息
        $transcation = new Transcation;
        $transcation->type = '用户充值';
        $transcation->user_id = $user->id;
        $transcation->client_id = $client->id;
        //$transcation->order_no = $order->no;
        $transcation->amount = $request->amount;
        $transcation->save();
        
        return redirect()->route('client.show', ['id' => $client->id]);
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $client = Client::find($id);
        return view('clients.edit', ['nav' => 'client', 'client' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        // 保存所有可编辑信息
        $client->name = $request->name;
        $client->mobile = $request->mobile;
        $client->save();
        return redirect()->route('client.show', ['id' => $client->id]);
    }

    /**
     * 创建一个新用户
     *
     * @param  int  $id
     * @return Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $client = new Client;
        $client->name = $request->name;
        $client->mobile = $request->mobile;
        $client->user_id = $user->id;
        $client->save();
        return redirect()->route('client.index')->with('status', '客户创建成功，客户编号 - ' . $client->id);
    }

}
