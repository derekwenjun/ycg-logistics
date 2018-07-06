@extends('layouts.app')

@section('content')


<div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">创建新客户账号</h4>
      </div>

      <form id="addressForm" action="{{ Route('client.store') }}" method="POST">
      
      {{ csrf_field() }}

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="name"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;姓名</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="mobile"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;手机号</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="country"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;注册网点</label>
                <select class="form-control" disabled>
                    <option>{{ $user->name }}</option>
                </select>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="city"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;用户等级</label>
                <input type="text" class="form-control" value="Normal" disabled>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">保存</button>
      </div>
      <script>
      $( document ).ready(function() {
          $("#addressForm").validate();
      });
      </script>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li class="active">客户列表</li>
        <!-- Button trigger modal -->
        <span class="pull-right">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus fa-title" aria-hidden="true"></i>创建新客户
            </button>
        </span>
    </ol>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('status') }}
        </div>
    @endif

    <form action="{{Route('client.index')}}" method="GET">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>姓名</td>
                <td>手机号</td>
                <td>账户余额</td>
                <td>注册网点</td>
                <td>用户等级</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td><input type="text" class="form-control input-sm" name="name" value="{{ old('name') }}"/></td>
                    <td><input type="text" class="form-control input-sm" name="mobile" value="{{ old('mobile') }}"/></td>
                    <td><input type="text" class="form-control input-sm" name="balance" value="{{ old('balance') }}"/></td>
                    <td><input type="text" class="form-control input-sm" value="" disabled /></td>
                    <td><input type="text" class="form-control input-sm" value="" disabled /></td>
                    <td><!-- 创建时间 --></td>
                    <td><button type="submit" class="btn btn-primary btn-sm">筛选</button></td>
                </tr>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->mobile }}</td>
                    <td><i class="fa fa-title fa-eur" aria-hidden="true"></i>{{ $client->balance }}</td>
                    <td>{{ $client->user->name }}</td>
                    <td>Normal</td>
                    <td>{{ $client->created_at }}</td>
                    <td>
                        <a href="{{ route('client.show', ['id' => $client->id]) }}">详情</a>&nbsp;|&nbsp;
                        <a href="{{ route('order.create', ['id' => $client->id]) }}" class="btn-sm btn-success">寄包裹</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection
