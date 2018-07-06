@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li class="active">用户充值 - {{ $client->name }}</li>
    </ol>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-eur fa-title" aria-hidden="true"></i>账户充值
                </div>
                <div class="panel-body">
                    <form id="chargeform" action="{{ Route('client.store_charge') }}" method="POST">

                        {{ csrf_field() }}
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <div class="form-group">
                            <label class="control-label" for="amount"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i>&nbsp;充值金额</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-eur fa-title" aria-hidden="true"></i></div>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">确认充值</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
