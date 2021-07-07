$(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content'),
        }
    });

    //Initialize Categories Datatable
    var categoriesTbl = $("#categoriesTbl").DataTable({});

    //Change section status
    $("#categoriesTbl").on('click', '.category_status', function(e){
        e.preventDefault();
        //e.stopImmediatePropagation();
        var categoryEl = $(this);
        var category_id = categoryEl.attr('data-category_id');
        var category_status = categoryEl.attr('data-category_status');
        $.ajax({
            url: '/admin/category/change-category-status',
            method: 'POST',
            data:{category_id: category_id, category_status: category_status},
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
                    categoryEl.html(`<i class="fas fa-toggle-on"></i>`);
                    categoryEl.attr('data-category_status', 1);
                }

                if(res['status'] == 0)
                {
                    categoryEl.html(`<i class="fas fa-toggle-off"></i>`);
                    categoryEl.attr('data-category_status', 0);
                }
            }
        });
    });

    // Fetch all categories by section
    $("#section_id").on('change', function(e){
        let section_id = $(this).val();
        $.ajax({
            url: '/admin/fetch/section/categories',
            method: 'POST',
            data: {section_id: section_id},
            success:function(resp){
                console.log(resp);
                $("#append_category_level").html(resp);
            }
        });
    });

    // Delete Category
    $("#categoriesTbl").on('click', '.delete_category', function(){
        var deleteCategoryEl = $(this);
        var category_id = deleteCategoryEl.attr('data-category_id');
        swal.fire({
            title: 'Warning!',
            text: 'Deleted category cannot be reverted!',
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
                    url: `/admin/category/delete`,
                    method: 'POST',
                    data: {category_id: category_id},
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
