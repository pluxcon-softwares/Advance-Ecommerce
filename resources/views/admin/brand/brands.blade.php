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
            <li class="breadcrumb-item active">Brands</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


    <div class="row justify-content-center mt-3">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Brands</div>
                    <a href="{{ url('admin/brand/add') }}" class="btn btn-sm btn-danger fa-pull-right"><i class="fas fa-plus"></i> Add Brand</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="brandsTbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @if(!empty($brand->image))
                                            <img src="{{ asset('storage/brand_images/'.$brand->image) }}" alt="{{ $brand->image }}" style="width:50px;">
                                        @else
                                            <img src="{{ asset('images/no_image.jpg') }}" alt="{{ $brand->image }}" style="width:50px;">
                                        @endif
                                    </td>
                                    <td>
                                       <a href="{{ url('admin/brand/update/'.$brand->id) }}" title="Edit Brand"><i class="fas fa-edit"></i></a>
                                       <a href="javascript:void(0)" title="Delete Brand" class="delete_brand" data-brand_id="{{ $brand->id }}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra_script')
    <script src="{{ asset('js/admin/brand.js') }}"></script>
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
@endsection
