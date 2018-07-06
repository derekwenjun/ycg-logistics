@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li><a href="{{ url('/client') }}">客户列表</a></li>
      <li class="active">编辑客户信息 - {{ $client->name }}</li>
    </ol>

    <div class="row">
    <div class="col-md-10">
        <div class="media">
            <form action="{{ Route('client.update', ['id'=>$client->id]) }}" method="POST">
            
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            
            <div class="media-left">
                    <img style="width:200px; height:200px;" class="media-object img-thumbnail" src="http://ycg.51meiqiu.com/image/avatar.gif" alt="{{ $client->name }}">
            </div>
            
            <div class="media-body">
                <div class="panel panel-default">
                    <div class="panel-heading">个人资料</div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr><th>#</th><th>Item Name</th><th>Data</th></tr>
                            </thead>
                            <tr><th>1</th><td>#</td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $client->id }}" disabled>
                                </td>
                            </tr>
                            <tr><th>2</th><td>客户姓名</td>
                                <td>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
                                </td>
                            </tr>
                            <tr><th>3</th><td>手机号</td>
                                <td>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $client->mobile }}" required>
                                </td>
                            </tr>
                            <tr><th>4</th><td>账户余额</td>
                                <td>
                                    <input type="text" class="form-control" id="balance" name="balance" value="€{{ $client->balance }}" disabled>
                                </td>
                            </tr>
                            <tr><th>5</th><td>注册网点</td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $client->user->name }}" disabled>
                                </td>
                            </tr>
                            <tr><th>6</th><td>用户等级</td>
                                <td><input type="text" class="form-control" id="level" name="level" value="Normal" disabled></td>
                            </tr>
                            <tr><th>9</th><td>创建时间</td>
                                <td><input type="text" class="form-control" value="{{ $client->created_at }}" disabled></td>
                            </tr>
                        </table>
                        <button class="btn btn-primary" type="submit">保存编辑</button>
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
    </div>
    
</div>
@endsection
