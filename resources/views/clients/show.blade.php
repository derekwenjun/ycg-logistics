@extends('layouts.app')

@section('content')

<div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">创建发货地址</h4>
      </div>

      <form id="addressForm" action="{{ Route('address.store') }}" method="POST">

      {{ csrf_field() }}
      <input type="hidden" name="client_id" value="{{ $client->id }}">

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
                <label class="control-label" for="country"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;国家</label>
                <input type="text" class="form-control" id="country" value="西班牙" disabled>
                <input type="hidden" name="country" value="西班牙">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="city"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;城市</label>
                <select class="form-control" id="city" name="city">
                  @foreach ($cities as $city)
                  <option value="{{ $city->name }}">{{ $city->name }}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="address"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;详细地址</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="zip"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;邮政编码</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP Code" required>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="tel">固定电话</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="Tel">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="mailbox">邮箱</label>
                <input type="text" class="form-control" id="mailbox" name="mailbox" placeholder="Mailbox">
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
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

@foreach ($addresses as $address)

<div class="modal" tabindex="-1" role="dialog" id="modelAddress{{ $address->id }}" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">编辑发货地址</h4>
      </div>

      <form id="addressForm" action="{{ route('address.update', ['id'=>$address->id]) }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PUT">

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="name"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;发货人</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="发货人" value="{{ $address->name }}" required>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="mobile"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;手机号</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="手机" value="{{ $address->mobile }}" required>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="country"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;国家</label>
                <input type="text" class="form-control" id="country" value="Netherlands" disabled>
                <input type="hidden" name="country" value="Netherlands">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="city"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;城市</label>
                <select class="form-control" id="city" name="city" value="{{ $address->city }}">
                  @foreach ($cities as $city)
                  <option value="{{ $city->name }}">{{ $city->name }}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="address"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;详细地址</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $address->address }}" required>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="zip"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;ZIP邮政编码</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP Code" value="{{ $address->zip }}" required>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="tel">固定电话</label>
                <input type="text" class="form-control" id="tel" name="tel" value="{{ $address->tel }}" placeholder="Tel">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="mailbox">邮箱</label>
                <input type="text" class="form-control" id="mailbox" name="mailbox" value="{{ $address->mailbox }}" placeholder="Mailbox">
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button data-toggle="modal" data-target=".deleteConfirm" onclick="confirmDelete('{{Route('address.destroy', ['id'=>$address->id])}}')" type="submit" class="btn btn-danger pull-left">Delete 删除地址</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">Save 保存</button>
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

@endforeach


<!-- 常用发货地址创建modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="shippingModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">创建收货地址</h4>
      </div>

      <form id="addressForm" action="{{ Route('address.store_shipping') }}" method="POST">

      {{ csrf_field() }}
      <input type="hidden" name="client_id" value="{{ $client->id }}">

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="shipping_name"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;收货人</label>
                <input type="text" class="form-control" id="shipping_name" name="shipping_name" required>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="shipping_mobile"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;手机</label>
                <input type="text" class="form-control" id="shipping_mobile" name="shipping_mobile" placeholder="" required>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;地区</label>
                <div data-toggle="distpicker">
                  <div class="row">
                    <div class="col-md-4">
                      <select class="form-control" id="shipping_state" name="shipping_state"></select>
                    </div>
                    <div class="col-md-4">
                      <select class="form-control" id="shipping_city" name="shipping_city"></select>
                    </div>
                    <div class="col-md-4">
                      <select class="form-control" id="shipping_district" name="shipping_district"></select>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="shipping_address"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;详细地址</label>
            <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="" required>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="shipping_zip"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;邮编</label>
                <input type="text" class="form-control" id="shipping_zip" name="shipping_zip" placeholder="" required>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">保存</button>
      </div>
      <script>
      $( document ).ready(function() {
          $("#addressForm").validate();
          //$("#myElementId").print(/*options*/);
      });
      </script>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li><a href="{{ url('/client') }}">客户列表</a></li>
      <li class="active">客户详情 - {{ $client->name }}</li>
    </ol>

    <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="fa fa-id-card fa-title" aria-hidden="true"></i>基本信息
          <span class="pull-right">
            <a class="btn btn-primary btn-xs" href="{{ route('client.edit', ['id' => $client->id]) }}">
              <i class="fa fa-pencil-square-o fa-title" aria-hidden="true"></i>编辑基本信息
            </a>
          </span>
        </div>
        <div class="panel-body">
          <table class="table table-hover table-striped">
              <thead>
              <tr>
                  <td>#</td>
                  <td>姓名</td>
                  <td>手机号</td>
                  <td>注册网点</td>
                  <td>用户等级</td>
                  <td>创建时间</td>
              </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>{{ $client->id }}</td>
                      <td>{{ $client->name }}</td>
                      <td>{{ $client->mobile }}</td>
                      <td>{{ $client->user->name }}</td>
                      <td>Normal</td>
                      <td>{{ $client->created_at }}</td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="fa fa-eur fa-title" aria-hidden="true"></i>账户余额
          <!-- Button trigger modal -->
          <span class="pull-right">
              <a href="{{ route('client.charge', ['id' => $client->id]) }}" type="button" class="btn btn-primary btn-xs">
                  <i class="fa fa-money fa-title" aria-hidden="true"></i>充值
              </a>
          </span>
        </div>
        <div class="panel-body">
          <h2 class="text-center"><i class="fa fa-eur fa-title" aria-hidden="true"></i>{{ $client->balance }}</h2>
          <p class="text-center text-muted">账户余额</p>
        </div>
      </div>
    </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-building fa-title" aria-hidden="true"></i>发货地址
        <!-- Button trigger modal -->
        <span class="pull-right">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus fa-title" aria-hidden="true"></i>添加发货地址
            </button>
        </span>
      </div>
      <div class="panel-body">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>发件人</td>
                <td>手机号</td>
                <td>国家</td>
                <td>城市</td>
                <td>详细地址</td>
                <td>邮政编码</td>
                <td>固定电话</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($addresses as $address)
                <tr class="{{ $address->is_default == 1 ? 'success' : '' }}">
                    <td>{{ $address->id }}</td>
                    <td>{{ $address->name }}</td>
                    <td>{{ $address->mobile }}</td>
                    <td>{{ $address->country }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->address }}</td>
                    <td>{{ $address->zip }}</td>
                    <td>{{ $address->tel }}</td>
                    <td>
                        @if ($address->is_default == 1)
                            <span class="text-success">Default</span> | 
                        @else
                            <a href="#" data-toggle="modal" data-target="#">设为默认地址</a> | 
                        @endif
                        <a href="#" data-toggle="modal" data-target="#modelAddress{{ $address->id }}">编辑</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-address-book fa-title" aria-hidden="true"></i>收货地址
        <!-- Button trigger modal -->
        <span class="pull-right">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#shippingModal">
                <i class="fa fa-plus fa-title" aria-hidden="true"></i>添加收货地址
            </button>
        </span>
      </div>
      <div class="panel-body">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>发件人</td>
                <td>手机号</td>
                <td>省</td>
                <td>市</td>
                <td>区</td>
                <td>详细地址</td>
                <td>邮政编码</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($shippingAddresses as $shippingAddress)
                <tr>
                    <td>{{ $shippingAddress->id }}</td>
                    <td>{{ $shippingAddress->name }}</td>
                    <td>{{ $shippingAddress->mobile }}</td>
                    <td>{{ $shippingAddress->state }}</td>
                    <td>{{ $shippingAddress->city }}</td>
                    <td>{{ $shippingAddress->district }}</td>
                    <td>{{ $shippingAddress->address }}</td>
                    <td>{{ $shippingAddress->zip }}</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modelAddress{{ $address->id }}">编辑</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>

</div>
@endsection
