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
            <li class="breadcrumb-item active">Sections</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


    <div class="row justify-content-center mt-3">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Section</h3>
                    <button class="btn btn-sm btn-danger fa-pull-right"><i class="fas fa-plus"></i> Add Section</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="sectionsTbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $section->id }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>
                                        @if($section->status == 1)
                                        <a href="#" class="section_status" data-section_status="{{ $section->status }}" data-section_id="{{ $section->id }}">Active
                                            <span class="spinner spinner-border spinner-border-sm" style="display: none"></span>
                                        </a>
                                        @else
                                        <a href="#" class="section_status" data-section_status="{{ $section->status }}" data-section_id="{{ $section->id }}">Inactive
                                            <span class="spinner spinner-border spinner-border-sm" style="display: none"></span>
                                        </a>
                                        @endif
                                    </td>
                                    <td>{{ $section->id }}</td>
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
    <script src="{{ asset('js/admin/section.js') }}"></script>
@endsection
