@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li class="active">QR Tracking</li>
    </ol>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Input 16-digital number under Scatch Layer
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-title fa-random" aria-hidden="true"></i><strong>Tracking Events</strong></div>
                <div class="panel-body">
                <form action="{{ url('/order/tracking') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="oid" value="23"/>

                <div class="row">
                    <div class="col-xs-3" style="padding:0px 5px 0px 15px;">
                      <div class="form-group">
                        <input type="text" maxlength="4" size="4" class="form-control" name="code" placeholder="">
                      </div>
                    </div>
                    <div class="col-xs-3" style="padding:0px 5px;">
                      <div class="form-group">
                        <input type="text" maxlength="4" size="4" class="form-control" id="" placeholder="">
                      </div>
                    </div>
                    <div class="col-xs-3" style="padding:0px 5px;">
                      <div class="form-group">
                        <input type="text" maxlength="4" size="4" class="form-control" id="" placeholder="">
                      </div>
                    </div>
                    <div class="col-xs-3" style="padding:0px 15px 0px 5px;">
                      <div class="form-group">
                        <input type="text" maxlength="4" size="4" class="form-control" id="" placeholder="">
                      </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">查询产品</button>
                </form>

                </div>
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
