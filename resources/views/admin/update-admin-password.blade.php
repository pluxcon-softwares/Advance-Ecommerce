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
              <li class="breadcrumb-item active">Update Admin Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>


<div class="row mt-5 justify-content-center">
    <div class="col-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Update Admin Password</h3>
            </div>
            <div class="card-body">

            <div class="col-12 mt-2 mb-2">
            @include('partials.flash_messages')
            </div>

            <form action="{{ url('admin/update-admin-password') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" value="{!! old('current_password') !!}" class="form-control" placeholder="Enter current Password">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password" disabled>
                    @if($errors->has('new_password'))
                        <div class="col-12">
                            <div style="font-size:12px;color:red;">{{ $errors->first('new_password') }}</div>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="new_password_confirmation" id="confirm_password" class="form-control" placeholder="Confirm Passowrd" disabled>
                </div>
                <div class="form-group">                    
                    <button type="submit" class="btn btn-primary fa-pull-right" id="submitBtn" disabled>Submit</button>
                </div>
            </form>
            </div>
        </div>
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
    $("#current_password").on('keyup', function(e){
        var inputCurrentPassword = $("#current_password");
        var inputNewPassword = $("#new_password");
        var inputConfirmPassword = $("#confirm_password");
        var submitBtn = $("#submitBtn");
        $.ajax({
            url: '/admin/check-current-password',
            method: 'POST',
            data: {current_password: e.currentTarget.value},
            success: function(res)
            {
                $('div.current_password_error').remove();
                if(res.status === true)
                {
                    //console.log(res.status);
                    $(`<div style="color:blue;font-size:12px;font-weight:bold;" class="current_password_error">Current password is correct</div>`).insertAfter(inputCurrentPassword);
                    inputNewPassword.removeAttr('disabled');
                    inputConfirmPassword.removeAttr('disabled');
                    submitBtn.attr('disabled', false);
                }

                if(res.status === false)
                {
                    //console.log(res.status);
                    $(`<div style="color:red;font-size:12px;font-weight:bold;" class="current_password_error">Current password is incorrect</div>`).insertAfter(inputCurrentPassword);
                    inputNewPassword.attr('disabled', true);
                    inputConfirmPassword.attr('disabled', true);
                    submitBtn.attr('disabled', true);
                }
            }
        });
    });

});

</script>
@endsection