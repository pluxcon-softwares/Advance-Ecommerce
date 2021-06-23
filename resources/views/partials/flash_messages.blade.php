@if(session('flash_success'))

<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-ban"></i> Alert!</h5>
{{ session('flash_success') }}
</div>

@endif


@if(session('flash_error'))

<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-ban"></i> Alert!</h5>
{{ session('flash_error') }}
</div>

@endif