@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li class="active"><i class="fa fa-trash fa-title" aria-hidden="true"></i>包裹回收站</li>
    </ol>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('status') }}
        </div>
    @endif

    <form action="{{Route('order.trash')}}" method="GET">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>运单号</td>
                <td>客户名称</td>
                <td>包裹类型</td>
                <td>包裹来源</td>
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
                            <option value="" @if (old('type')=="") selected @endif></option>
                            <option value="1" @if (old('type')=="1") selected @endif>BC</option>
                            <option value="2" @if (old('type')=="2") selected @endif>个人物品</option>
                        </select>
                    </td>
                    <td class="{{ old('source') ? 'has-success' : '' }}">
                        <input class="form-control input-sm" type="text" name="source" value="{{ old('source') }}"/>
                    </td>
                    <td><input class="form-control input-sm" type="text" name="name" value="{{ old('name') }}"/></td>
                    <td><input class="form-control input-sm" type="text" name="shipping_name" value="{{ old('shipping_name') }}"/></td>
                    <td><!-- 创建时间 --></td>
                    <td><!-- 付款时间 --></td>
                    <td><!-- 订单状态 --></td>
                    <td><button type="submit" class="btn btn-primary btn-sm">筛选</button></td>
                </tr>
            @foreach ($orders as $order)
                <tr class="danger">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->no }}</td>
                    <td>{{ $order->client->name}}</td>
                    <td>{{ $order->type->name}}</td>
                    <td>{{ $order->source }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->shipping_name }}&nbsp;-&nbsp;{{ $order->shipping_city }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->paid_at }}</td>
                    <td>已删除</td>
                    <td>
                        <a data-toggle="modal" data-target=".deleteConfirm" onclick="confirmDelete('{{Route('order.destroy', ['id'=>$order->id])}}')">删除</a>
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
