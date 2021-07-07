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
            <li class="breadcrumb-item active">Product Attributes</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


    <div class="row justify-content-center mt-3">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">Add Product Attribute</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Product Detail and Add Attribute Section -->
                        <div class="col-md-8">
                            <p><strong>Product Name: </strong> {{ $product->product_name }}</p>
                            <p><strong>Product Code: </strong> {{ $product->product_code }}</p>
                            <hr>
                            <form action="{{ url('admin/product/attributes/'.$product->id) }}" method="POST" class="form-inline">
                                @csrf
                            <div id="addAttributesField">
                                <div>
                                    <input type="text" name="size[]" placeholder="Size" class="form-control" required style="width: 23%">
                                    <input type="text" name="sku[]" placeholder="SKU" class="form-control" required style="width: 23%">
                                    <input type="number" name="price[]" placeholder="Price" class="form-control" required style="width: 23%">
                                    <input type="number" name="stock[]" placeholder="Stock" class="form-control" required style="width: 23%">
                                    <a href="javascript:void(0)" class="add_elements" style="margin: 0 0 0 2px;"><i class="fas fa-plus-circle"></i></a>
                                </div>
                            </div>

                            <div style="margin: 10px 0 0 0;">
                                <button type="submit" class="btn btn-sm btn-primary fa-pull-right">Add Attribute</button>
                            </div>
                            </form>
                        </div>

                        <!-- Product image display section -->
                        <div class="col-md-4" style="text-align: center">
                            @if(!empty($product->product_main_image))
                                <img src="{{ asset('storage/product_images/medium/'.$product->product_main_image) }}" alt="{{ $product->product_main_image }}" style="width: 50%">
                            @else
                                <img src="{{ asset('images/no_image.jpg') }}" alt="no_image" srcset="" style="width: 50%">
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ url('admin/product/attributes/update/'.$product->id) }}" method="post">
                @csrf
                <div class="card-header">
                    <div class="card-title">Product Attributes</div>
                </div>

                <div class="card-body">
                    <table class="table" id="productAttributesTbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Size</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td>
                                    <td>{{ $attribute->size }}</td>
                                    <td>{{ $attribute->sku }}</td>
                                    <td><input type="number" name="price[]" value="{{ $attribute->price }}" class="form-control form-control-sm"></td>
                                    <td><input type="number" name="stock[]" value="{{ $attribute->stock }}" class="form-control form-control-sm"></td>
                                    <td>
                                        @if($attribute->status == 1)
                                        <a href="#" class="product_attribute_status" data-product_attribute_status="{{ $attribute->status }}" data-attribute_id="{{ $attribute->id }}">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                        @else
                                        <a href="#" class="product_attribute_status" data-product_attribute_status="{{ $attribute->status }}" data-attribute_id="{{ $attribute->id }}">
                                            <i class="fas fa-toggle-off"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="hidden" name="attribute_id[]" value="{{ $attribute->id }}">

                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger delete_product_attribute" data-attribute_id="{{ $attribute->id }}"><i class="fas fa-trash"></i> Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    @if(count($product->attributes) > 0)
                    <div class="card-footer">
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">Update Attribute</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

@endsection

@section('extra_script')
    <script src="{{ asset('js/admin/product.js') }}"></script>
    @if (Session::has('flash_success'))
        <script>
            $(function(){
                swal.fire({
                    title: 'Success!',
                    text: "{{ Session::get('flash_success') }}",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif

    @if (Session::has('flash_error'))
        <script>
            $(function(){
                swal.fire({
                    title: 'Error',
                    text: "{{ Session::get('flash_error') }}",
                    icon: 'error',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif
@endsection
