@extends('admin.layouts.master')

@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Admin Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>


<div class="row mt-3 justify-content-center">
<div class="col-md-5">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user shadow">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{ Auth::guard('admin')->user()->name }}</h3>
                <h5 class="widget-user-desc">{{ Auth::guard('admin')->user()->type }}</h5>
              </div>
              <div class="widget-user-image">
              <?php
                if(Auth::guard('admin')->user()->image)
                {
                  $profileImage = asset("storage/profile/".Auth::guard('admin')->user()->image);
                }else{
                  $profileImage = asset("images/admin/avatar.png");
                }
              ?>
                <img class="img-circle elevation-2" src="{{ $profileImage }}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12">

                    <div class="mt-2 mb-2">
                    @include('partials.flash_messages')
                    </div>

                    <form action="{{ url('admin/update-admin-details') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="admin_email">Admin Email</label>
                            <input type="text" id="admin_email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="admin_email">Admin Type</label>
                            <input type="text" id="admin_type" class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="admin_email">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter Your Fullname">
                            @if($errors->has('name'))
                            <div style="font-size:12px; color:red;">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="admin_email">Mobile</label>
                            <input type="text" name="mobile" id="mobile" value="{{ Auth::guard('admin')->user()->mobile }}" class="form-control" placeholder="Mobile Number">
                        </div>

                        <div class="form-group">
                            <label for="admin_email">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <input type="hidden" name="current_image" value="{{ Auth::guard('admin')->user()->image }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary fa-pull-right">Update</button>
                        </div>

                    </form>
                  </div>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
</div>

@endsection

@section('extra_script')
<script>

$(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        }
    });

});

</script>
@endsection