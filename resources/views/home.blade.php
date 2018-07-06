@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
    </ol>
    

    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-3">
                        <h3><img src="{{ asset('image/avatar.gif') }}" class="img-rounded img-responsive"/></h3>
                    </div>
                    <div class="col-md-9">
                        <h3>Welcome! {{ Auth::user()->name }}</h3>
                        <p>YCG Logistics System Portal</p>
                    </div>
                </div>
                <p>
                    <a class="btn btn-primary" href="{{ url('/order/create') }}" role="button">发送包裹</a>
                    <a class="btn btn-success" href="{{ url('/order') }}" role="button">查看所有包裹</a>
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-eur" aria-hidden="true"></i><strong>Finance</strong></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-center"><i class="fa fa-eur fa-title" aria-hidden="true"></i>324.5</h2>
                            <p class="text-center text-muted">未使用余额</p>
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-center"><i class="fa fa-eur fa-title" aria-hidden="true"></i>324.5</h2>
                            <p class="text-center text-muted">包裹总金额</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-plane" aria-hidden="true"></i><strong>包裹信息</strong></div>
                <div class="panel-body">
                    <a class="btn btn-default parcel-btn" href="{{ route('order.index') }}" role="button">
                        <h2 class="text-center">2</h2>
                        <p class="text-center text-muted">所有包裹</p>
                    </a>
                    <a class="btn btn-default parcel-btn" href="#" role="button">
                        <h2 class="text-center">5</h2>
                        <p class="text-center text-muted">未付款包裹</p>
                    </a>
                    <a class="btn btn-default parcel-btn" href="#" role="button">
                        <h2 class="text-center">3</h2>
                        <p class="text-center text-muted">未完成包裹</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
