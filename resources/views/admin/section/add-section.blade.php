@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6 mt-3">
            <div class="card card-default">
                <form action="{{ url('admin/section/add') }}" method="post">
                    @csrf
                    <div class="card card-header">
                        <h3 class="card-title">Add Section</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Section Name</label>
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter Section Name">
                            @if($errors->has('name'))
                            <span style="display: block; font-size:12px; color:red;">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary fa-pull-right">Submit Section</button>
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
