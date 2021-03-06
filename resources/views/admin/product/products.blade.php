@extends('admin.layouts.master')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ Session::get('page') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


    <div class="row justify-content-center mt-3">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Products</h3>
                    <a href="{{ url('admin/product/add') }}" class="btn btn-sm btn-danger fa-pull-right"><i class="fas fa-plus"></i> Add Product</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="productsTbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Category</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ Str::substr($product->product_name, 0, 80) }}</td>
                                    <td>
                                        {{ $product->product_code }}
                                    </td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->section->name }}</td>
                                    <td>
                                        @if($product->status == 1)
                                        <a href="#" class="product_status" data-product_status="{{ $product->status }}" data-product_id="{{ $product->id }}">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                        @else
                                        <a href="#" class="product_status" data-product_status="{{ $product->status }}" data-product_id="{{ $product->id }}">
                                            <i class="fas fa-toggle-off"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="">
                                            <a href="{{ url('admin/product/attributes/'.$product->id) }}" class="" title="View/Add Attributes"><i class="fas fa-plus"></i></a>
                                            <a href="{{ url('admin/product/images/'.$product->id) }}" class="" title="View/Add Images"><i class="fas fa-plus-circle"></i></a>
                                            <a href="#" class="view_product" data-product_id="{{ $product->id }}" title="View Details"><i class="fas fa-file"></i></a>
                                            <a href="{{ url('admin/product/update/'.$product->id) }}" class="" title="Edit Product"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="delete_product" data-product_id="{{ $product->id }}" title="Delete Product"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@include('admin.product._view-product')

@endsection

@section('extra_script')
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endsection
