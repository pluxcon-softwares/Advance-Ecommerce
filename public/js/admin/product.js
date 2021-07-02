$(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content'),
        }
    });

    //Initialize Categories Datatable
    var categoriesTbl = $("#productsTbl").DataTable({});


    //Change Product status
    $("#productsTbl").on('click', '.product_status', function(e){
        e.preventDefault();
        //e.stopImmediatePropagation();
        var productEl = $(this);
        var product_id = productEl.attr('data-product_id');
        var product_status = productEl.attr('data-product_status');
        $.ajax({
            url: '/admin/product/change-product-status',
            method: 'POST',
            data:{product_id: product_id, product_status: product_status},
            beforeSend: function(){
                //e.currentTarget.children[0].style.display = 'inline-block';
                //sectionEl.children("span.spinner-border").show();
            },
            complete: function(){
                //e.currentTarget.children[0].style.display = 'none';
                //sectionEl.children("span.spinner-border").show();
            },
            success:function(res){
                if(res['status'] == 1)
                {
                    productEl.text('Active');
                    productEl.attr('data-product_status', 1);
                }

                if(res['status'] == 0)
                {
                    productEl.text('Inactive');
                    productEl.attr('data-product_status', 0);
                }
            }
        });
    });

    //View Product
    $("#productsTbl").on('click', '.view_product', function(e){
        e.preventDefault();
        var product_id = $(this).attr('data-product_id');
        $.ajax({
            url: '/admin/product/view',
            method: 'POST',
            data:{product_id: product_id},
            success:function(resp){
                //console.log(resp)
                if(resp)
                {
                    $("#viewProductModal #view_product").html(resp);
                }
            }
        });
        $("#viewProductModal").modal('show');
    });

    // Delete Category
    $("#productsTbl").on('click', '.delete_product', function(){
        var deleteProductEl = $(this);
        var product_id = deleteProductEl.attr('data-product_id');
        swal.fire({
            title: 'Warning!',
            text: 'Deleted product cannot be reverted!',
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
                    url: `/admin/product/delete`,
                    method: 'POST',
                    data: {product_id: product_id},
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

});
