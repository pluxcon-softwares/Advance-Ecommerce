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
            <li class="breadcrumb-item active">Categories</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


    <div class="row justify-content-center mt-3">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                    <a href="{{ url('admin/category/add') }}" class="btn btn-sm btn-danger fa-pull-right"><i class="fas fa-plus"></i> Add Category</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="categoriesTbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Parent Category</th>
                                <th>Section</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allcategories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        @if($category->parentcategory)
                                            {{$category->parentcategory->category_name}}
                                        @else
                                            Root
                                        @endif
                                    </td>
                                    <td>{{ $category->section->name }}</td>
                                    <td>{{ $category['url'] }}</td>
                                    <td>
                                        @if($category->status == 1)
                                        <a href="#" class="category_status" data-category_status="{{ $category->status }}" data-category_id="{{ $category->id }}">Active
                                            <span class="spinner spinner-border spinner-border-sm" style="display: none"></span>
                                        </a>
                                        @else
                                        <a href="#" class="category_status" data-category_status="{{ $category->status }}" data-category_id="{{ $category->id }}">Inactive
                                            <span class="spinner spinner-border spinner-border-sm" style="display: none"></span>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- <a href="#" class="btn btn-info btn-xs"><i class="fas fa-file"></i> Details</a> -->
                                            <a href="{{ url('admin/category/update/'.$category->id) }}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs delete_category" data-category_id="{{ $category->id }}"><i class="fas fa-trash"></i> Delete</a>
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

@endsection

@section('extra_script')
    <script src="{{ asset('js/admin/category.js') }}"></script>
@endsection
