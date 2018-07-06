@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li class="active">全部商品</li>
    </ol>

    <form action="{{Route('order.index')}}" method="GET">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>商品名</td>
                <td>分类</td>
                <td>型号</td>
                <td>条形码</td>
                <td>重量</td>
                <td>申报价</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td><input type="text" class="form-control input-sm" name="name" value="{{ old('name') }}"/></td>
                    <td></td>
                    <td></td>
                    <td><input type="text" class="form-control input-sm" name="upc" value="{{ old('upc') }}"/></td>
                    <td><input type="number" class="form-control input-sm" name="weight" value="{{ old('weight') }}"/></td>
                    <td><input type="number" class="form-control input-sm" name="price" value="{{ old('price') }}"/></td>
                    <td><button type="submit" class="btn btn-primary btn-sm">操作</button></td>
                </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->model }}</td>
                    <td>{{ $product->upc }}</td>
                    <td>{{ $product->weight }} KG</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        -
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>

    

    <script>
        function confirmDelete(action) {
            $('.deleteConfirm form').attr('action', action);
        }
    </script>
</div>
@endsection
