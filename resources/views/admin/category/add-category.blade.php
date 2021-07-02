@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 mt-3">
            <div class="card card-default">
                <form action="{{ url('admin/category/add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-header">
                        <h3 class="card-title">Category</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" placeholder="Enter Category Name">
                                    @if($errors->has('category_name'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('category_name') }}</span>
                                    @endif
                                </div>

                                <div id="append_category_level">
                                    @include('admin.category._category-lavel')
                                </div>

                                <div class="form-group">
                                    <label for="">Category Discount</label>
                                    <input type="text" name="category_discount" value="0" id="category_discount" class="form-control {{ $errors->has('category_discount') ? 'is-invalid' : '' }}" placeholder="Enter Category Discount">
                                    @if($errors->has('category_discount'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('category_discount') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Category Description</label>
                                    <textarea name="description" id="description" cols="" rows="3" class="form-control" placeholder="Enter Category Description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" cols="" rows="3" class="form-control" placeholder="Enter Meta Description"></textarea>
                                </div>
                            </div>

                            <!-- /. Left Form Elements -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Select Section</label>
                                    <select name="section_id" id="section_id" class="form-control {{ $errors->has('section_id') ? 'is-invalid' : '' }}">
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('section_id'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('section_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Category Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="category_image" class="custom-file-input {{ $errors->has('category_image') ? 'is-invalid' : '' }}" id="">
                                        <label class="custom-file-label" for="">Choose file</label>
                                    </div>
                                    @if($errors->has('category_image'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('category_image') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Category URL</label>
                                    <input type="text" name="url" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url" placeholder="Enter Category URL">
                                    @if($errors->has('url'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('url') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Title</label>
                                    <textarea name="meta_title" id="meta_title" cols="" rows="3" class="form-control" placeholder="Enter Meta Title"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Keywords</label>
                                    <textarea name="meta_keywords" id="meta_keywords" cols="" rows="3" class="form-control" placeholder="Enter Meta Keywords"></textarea>
                                </div>

                            </div>
                            <!-- /. Left Form Elements -->

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary fa-pull-right">Submit Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script src="{{ asset('js/admin/category.js') }}"></script>
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
