$(function(){

    //Initialize ajaxSetup CSRF TOKEN
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        }
    })

    //Initialize brands datatable
    $("#brandsTbl").DataTable();

    //Delete Brand
    $("#brandsTbl").on('click', '.delete_brand', function(){
        var brand_id = $(this).attr('data-brand_id');
        swal.fire({
            title: 'Warning!',
            text: 'Deleted brand cannot be reverted!',
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result)=>{
            if(result.isConfirmed)
            {
                $.ajax({
                    url: `/admin/brand/delete`,
                    method: 'POST',
                    data: {brand_id: brand_id},
                    success:function(res){
                        if(res.success)
                        {
                            swal.fire({
                                title: 'Success!',
                                text: `${res.success}`,
                                icon: 'success',
                            }).then((result)=>{
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
    });

    //
});
