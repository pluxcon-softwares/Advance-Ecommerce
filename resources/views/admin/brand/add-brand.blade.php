@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-5 mt-3">
            <div class="card card-default">
                <form action="{{ url('admin/brand/add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-header">
                        <div class="card-title">Brands</div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Brand Name</label>
                            <input type="text" name="name" value="{{ old('name')}}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter Brand Name">
                            @if($errors->has('name'))
                            <span style="display: block; font-size:12px; color:red;">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Brand Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}" id="">
                                <label class="custom-file-label" for="">Choose file</label>
                            </div>
                            @if($errors->has('image'))
                                <span style="display: block; font-size:12px; color:red;">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary fa-pull-right">Submit Brand</button>
                        <a href="{{ url('admin/brands') }}" class="btn btn-default"><< Back</a>
                    </div>
                </form>
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
