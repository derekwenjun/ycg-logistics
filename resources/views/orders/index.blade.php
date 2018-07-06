@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li class="active">包裹列表</li>
    </ol>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('status') }}
        </div>
    @endif

    <form action="{{Route('order.index')}}" method="GET">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>运单号</td>
                <td>客户名称</td>
                <td>包裹类型</td>
                <!-- <td>包裹来源</td> -->
                <td>重量(KG)</td>
                <td>运费</td>
                <td>发件人</td>
                <td>收件人</td>
                <td>创建时间</td>
                <td>付款时间</td>
                <td>包裹状态</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td class="{{ old('no') ? 'has-success' : '' }}">
                        <input class="form-control input-sm" type="text" name="no" value="{{ old('no') }}"/>
                    </td>
                    <td></td>
                    <td>
                        <select class="form-control input-sm" name="type_id">
                            <option value="" @if (old('type_id')=="") selected @endif></option>
                            <option value="1" @if (old('type_id')=="1") selected @endif>BC</option>
                            <option value="2" @if (old('type_id')=="2") selected @endif>个人物品</option>
                        </select>
                    </td>
                    <!-- <td>包裹来源</td> -->
                    <td><!-- 总重量 --></td>
                    <td><!-- 运费 --></td>
                    <td><input class="form-control input-sm" type="text" name="name" value="{{ old('name') }}"/></td>
                    <td><input class="form-control input-sm" type="text" name="shipping_name" value="{{ old('shipping_name') }}"/></td>
                    <td><!-- 创建时间 --></td>
                    <td><!-- 付款时间 --></td>
                    <td class="{{ old('status_id') ? 'has-success' : '' }}">
                        <select class="form-control input-sm" name="status_id">
                            <option value="" @if (old('status_id')=="") selected @endif></option>
                            <option value="0" @if (old('status_id')=="0") selected @endif>未完成</option>
                            <option value="1" @if (old('status_id')=="1") selected @endif>待支付</option>
                            <option value="2" @if (old('status_id')=="2") selected @endif>已支付</option>
                        </select>
                    </td>
                    <td><button type="submit" class="btn btn-primary btn-sm">筛选</button></td>
                </tr>
            @foreach ($orders as $order)
                <tr class="{{ $order->status_id == 0 ? 'warning' : ( $order->status_id >= 2 ? 'success' : '' ) }}">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->no }}</td>
                    <td>{{ $order->client->name}}</td>
                    <td>{{ $order->type->name}}</td>
                    <!-- <td>{{ $order->source }}</td> -->
                    <td>{{ $order->weight }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->shipping_name }}&nbsp;-&nbsp;{{ $order->shipping_city }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->paid_at }}</td>
                    <td>{{ $order->status->name }}</td>
                    <td>
                        @if ($order->status_id == 0)
                        <a href="{{ route('order.waybill', ['id' => $order->id]) }}">继续做单</a> | 
                        <a data-toggle="modal" data-target=".deleteConfirm" onclick="confirmDelete('{{Route('order.destroy', ['id'=>$order->id])}}')">删除</a>
                        @elseif($order->status_id == 1)
                        <a href="{{ route('order.payment', ['id' => $order->id]) }}" class="btn-sm btn-success">立即支付</a>
                        @elseif($order->status_id >= 2)
                        <a href="{{ route('order.show', ['id' => $order->id]) }}" class="btn-sm btn-primary">详情 | 追踪</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>

    {!! $orders->render() !!}

    <div class="modal fade deleteConfirm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="POST">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="DELETE">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">操作确认</h4>
                    </div>
                    <div class="modal-body">
                        <p>确认删除该包裹？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">删除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(action) {
            $('.deleteConfirm form').attr('action', action);
        }
    </script>
</div>
@endsection
