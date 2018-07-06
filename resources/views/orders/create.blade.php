@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li class="active">订单类型</li>
    </ol>

    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-8 col-md-offset-2">
            <h4 class="text-center"><span class="label label-success">1</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="text-success"><strong>订单类型</strong></span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-muted" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="text-center text-muted"><span class="label label-default step-label-todo">2</span>&nbsp;&nbsp;&nbsp;&nbsp;面单信息</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-muted" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="text-center text-muted"><span class="label label-default step-label-todo">3</span>&nbsp;&nbsp;&nbsp;&nbsp;商品信息</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-muted" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="text-center text-muted"><span class="label label-default step-label-todo">4</span>&nbsp;&nbsp;&nbsp;付款</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-muted" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="text-center text-muted"><span class="label label-default step-label-todo">5</span>&nbsp;&nbsp;&nbsp;完成</span>
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-random" aria-hidden="true"></i>分拨中心</div>
                <div class="panel-body">
                  <form class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="city"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;Choose DC:</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="city" name="city" disabled>
                          <option>MADRID - España</option>
                        </select>
                    </div>
                    <span id="helpBlock" class="help-block col-sm-8 col-sm-offset-4">分拨中心目前无法修改</span>
                  </div>
                  </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-user" aria-hidden="true"></i>客户信息</div>
                <div class="panel-body">
                  <form class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="city">
                        <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;客户编号：
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $client->id }}" disabled />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="city">
                        <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;客户姓名：
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $client->name }}" disabled />
                    </div>
                  </div>
                  </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-truck" aria-hidden="true"></i></i>包裹类型</div>

                <div class="panel-body">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>点击发送按钮后，运单号即刻被创建；您可以在包裹中心找到所有已创建但未完成的包裹</strong>
                    </div>

                    <table class="table table-striped">
                        <thead><tr>
                            <th>#</th>
                            <th>包裹类型</th>
                            <th>描述</th>
                            <th>操作</th>
                        </tr></thead>
                        <tbody>
                            <tr>
                                <form method="POST" action="{{ url('/order/store') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="type_id" value="1">
                                <input type="hidden" name="source" value="在线录入">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                
                                <th scope="row">1</th> <td>BC包裹</td>
                                <td>固定税率11.9%，需身份信息，5-7天到门</td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        发送BC包裹&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    </button>
                                </td>
                                </form>
                            </tr>

                            <tr>
                                <form method="POST" action="{{ url('/order/store') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="type_id" value="2">
                                <input type="hidden" name="source" value="在线录入">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">

                                <th scope="row">2</th>
                                <td>CC个人物品</td>
                                <td>海关随机征税，税额人民币¥50以下免征</td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        发送CC包裹&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    </button>
                                </td>
                                </form>
                            </tr>

                            <tr>
                                <form method="POST" action="{{ url('/order/store') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="type_id" value="6">
                                <input type="hidden" name="source" value="在线录入">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">

                                <th scope="row">6</th>
                                <td>中国邮政EMS</td>
                                <td>邮政EMS全程托管</td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        发送EMS包裹&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    </button>
                                </td>
                                </form>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
