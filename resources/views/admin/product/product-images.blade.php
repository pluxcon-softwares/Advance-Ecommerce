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
            <li class="breadcrumb-item active">Product Images</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


    <div class="row justify-content-center mt-3">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">Add Product Images</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Product Detail and Add Attribute Section -->
                        <div class="col-md-8">
                            <p><strong>Product Name: </strong> {{ $product->product_name }}</p>
                            <p><strong>Product Code: </strong> {{ $product->product_code }}</p>
                            <hr>
                            <form action="{{ url('admin/product/images/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Additional Image</label>
                                    <div class="custom-file">
                                        <input type="file" multiple name="image[]" class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}" id="">
                                        <label class="custom-file-label" for="">Choose file</label>
                                    </div>
                                    @if($errors->has('image'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                            <div style="margin: 10px 0 0 0;">
                                <button type="submit" class="btn btn-sm btn-primary fa-pull-right">Add Images</button>
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
                    <table class="table" id="productImagesTbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->images as $image)
                                <tr>
                                    <td>{{ $image->id }}</td>
                                    <td><img src="{{ asset('storage/product_images/additional_images/'.$image->image) }}" style="width: 50px"></td>
                                    <td>
                                        @if($image->status == 1)
                                        <a href="#" class="product_image_status" data-product_image_status="{{ $image->status }}" data-image_id="{{ $image->id }}">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                        @else
                                        <a href="#" class="product_image_status" data-product_image_status="{{ $image->status }}" data-image_id="{{ $image->id }}">
                                            <i class="fas fa-toggle-off"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger delete_product_image" data-image_id="{{ $image->id }}"><i class="fas fa-trash"></i> Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    @if(count($product->images) > 0)
                    <div class="card-footer">
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">Update Image</button>
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
