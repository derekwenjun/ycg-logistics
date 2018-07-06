@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li class="active">完成</li>
    </ol>

    <div class="row" style="margin-bottom:40px;">
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
          <span class="text-center text-success"><span class="label label-success step-label-finished">
            <i class="fa fa-check" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;支付
          </span>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-success" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="text-center text-success"><span class="label label-success">5</span>&nbsp;&nbsp;&nbsp;完成</span>
          </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="jumbotron">
                <h2><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Parcel Sent Successfully!</h2>
                <p>运单号. - {{ $order->no }}. 包裹类型 - {{ $order->type->name }}. You may upload ID of
                the receiver anytime before custome clerence, and tax fired by this parcel my be deducked from your balance account.</p>
                <p>订单追踪信息将在1-2天后可用.</p>
                <p>
                  <a class="btn btn-primary" href="../../components/#navbar" role="button">查看该包裹</a>
                  <a class="btn btn-primary" href="../../components/#navbar" role="button">查看包裹列表</a>
                  <a class="btn btn-success" href="../../components/#navbar" role="button">继续创建包裹</a>
                </p>
            </div>
        </div>        
    </div>
</div>
@endsection
