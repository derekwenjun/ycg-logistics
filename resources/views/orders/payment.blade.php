@extends('layouts.app')

@section('content')
<div class="container">

  <ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">发货做单 - 确认支付</li>
  </ol>

  <div class="row" style="margin-bottom:30px;">
      <div class="col-md-8 col-md-offset-2">
          <h4 class="text-center">
          <span class="text-center text-success">
            <span class="label label-success step-label-finished"><i class="fa fa-check" aria-hidden="true"></i></span>
            &nbsp;&nbsp;&nbsp;包裹类型
          </span>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-success" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="text-center text-success"><span class="label label-success step-label-finished">
            <i class="fa fa-check" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;面单信息
          </span>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-success" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="text-center text-success"><span class="label label-success step-label-finished">
            <i class="fa fa-check" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;商品信息
          </span>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-success" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="text-center text-success"><span class="label label-success">4</span>&nbsp;&nbsp;&nbsp;支付</span>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-muted" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="text-center text-muted"><span class="label label-default">5</span>&nbsp;&nbsp;&nbsp;完成</span>
          </h4>
      </div>
  </div>

  <form action="{{ url('order/store_payment') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="oid" value="{{ $order->id }}">
    <div class="row">
        <div class="col-md-7 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-address-book" aria-hidden="true"></i><strong>面单信息</strong></div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-6">
                      <table class="table table-striped">
                        <thead><tr><th>发货人</th> <th></th> </tr> </thead>
                        <tbody>
                          <tr><td>姓名</td> <td>{{ $order->name }}</td> </tr>
                          <tr><td>手机号</td><td>{{ $order->mobile }}</td></tr>
                          <tr><td>国家</td><td>{{ $order->country }}</td></tr>
                          <tr><td>城市</td><td>{{ $order->city }}</td></tr>
                          <tr><td>详细地址</td><td>{{ $order->address }}</td></tr>
                          <tr><td>邮政编码</td><td>{{ $order->zip }}</td></tr>
                          <tr><td>固定电话</td><td>{{ $order->tel }}</td></tr>
                          <tr><td>邮箱</td><td>{{ $order->mailbox }}</td></tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table class="table table-striped">
                        <thead><tr><th>收货人</th> <th></th> </tr> </thead>
                        <tbody>
                          <tr><td>姓名</td> <td>{{ $order->shipping_name }}</td> </tr>
                          <tr><td>手机号</td><td>{{ $order->shipping_mobile }}</td></tr>
                          <tr><td>省</td><td>{{ $order->shipping_state }}</td></tr>
                          <tr><td>市</td><td>{{ $order->shipping_city }}</td></tr>
                          <tr><td>区</td><td>{{ $order->shipping_district }}</td></tr>
                          <tr><td>详细地址</td><td>{{ $order->shipping_address }}</td></tr>
                          <tr><td>邮政编码</td><td>{{ $order->shipping_zip }}</td></tr>
                          <tr><td>固定电话</td><td>{{ $order->shipping_tel ? $order->shipping_tel : '-' }}</td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-eur" aria-hidden="true"></i></i><strong>支付</strong></div>
                <div class="panel-body">
                  <div class="alert alert-success" role="alert" style="line-height:24px;">
                        包裹成功创建! <br/>
                        包裹类型&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; {{ $order->type->name }}<br/>
                        运单编号&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; {{ $order->no }}<br/>
                  </div>
                  <table class="table table-striped">
                    <thead><tr><th>费用详情</th> <th></th> </tr> </thead>
                    <tbody>
                      <tr><td>运费总额 :</td><td class="text-right">€ {{ $order->price }}</td></tr>
                      <tr><td>税费 :</td><td class="text-right">€ 0.0</td></tr>
                      <tr><td>折扣 :</td><td class="text-right">€ 0.0</td></tr>
                      <tr><td><strong>总额 :</strong></td><td class="text-right"><strong>€ {{ $order->price }}</strong></td></tr>
                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-success">
                    &nbsp;立即付款&nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;
                  </button>
                  <a href="{{ route('order.index') }}" class="btn btn-primary">查看所有订单</a>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-title fa-archive" aria-hidden="true"></i></i><strong>商品信息</strong></div>
            <div class="panel-body">
              <table class="table table-striped">
                <thead><tr>
                  <th>商品分类</th>
                  <th>商品名</th>
                  <th>型号</th>
                  <th>数量</th>
                  <th>申报价格</th>
                </tr></thead>
                <tbody>
                  @foreach ($ops as $op)
                  <tr>
                    <td>{{ $op->category->name }}</td>
                    <td>{{ $op->name }}</td>
                    <td>{{ $op->model }}</td>
                    <td>{{ $op->number }}</td>
                    <td>{{ $op->price }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

  </form>
</div>
@endsection
