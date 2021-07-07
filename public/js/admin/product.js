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
            success:function(res){
                if(res['status'] == 1)
                {
                    productEl.html(`<i class="fas fa-toggle-on"></i>`);
                    productEl.attr('data-product_status', 1);
                }

                if(res['status'] == 0)
                {
                    productEl.htlm(`<i class="fas fa-toggle-off"></i>`);
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

    //Create additional product attributes form element
    var maxElementsNumber = 5;
    var initializer = 1;
    var parentElement = $("#addAttributesField");
    $("#addAttributesField").on('click', '.add_elements', function(){
        var newChildElement = `
                <div>
                    <input type="text" name="size[]" placeholder="Size" class="form-control" required style="width: 23%">
                    <input type="text" name="sku[]" placeholder="SKU" class="form-control" required style="width: 23%">
                    <input type="number" name="price[]" placeholder="Price" class="form-control" required style="width: 23%">
                    <input type="number" name="stock[]" placeholder="Stock" class="form-control" required style="width: 23%">
                    <a href="javascript:void(0)" class="remove_elements" style="margin: 0 0 0 2px;"><i class="fas fa-trash"></i></a>
                </div>
        `;
        if(initializer < maxElementsNumber)
        {
            parentElement.append(newChildElement);
            initializer += 1;
        }
    });

    $("#addAttributesField").on('click', '.remove_elements', function(){
        $(this).parent('div').remove()
        initializer -= 1;
    });

    //Initialize Product Attributes Datatabel
    $("#productAttributesTbl").DataTable();

    // Change product attribute status
    //Change section status
    $("#productAttributesTbl").on('click', '.product_attribute_status', function(e){
        e.preventDefault();
        //e.stopImmediatePropagation();
        var attributeEl = $(this);
        var attribute_id = attributeEl.attr('data-attribute_id');
        var product_attribute_status = attributeEl.attr('data-product_attribute_status');
        $.ajax({
            url: '/admin/product/attribute/change-attribute-status',
            method: 'POST',
            data:{attribute_id: attribute_id, product_attribute_status: product_attribute_status},
            success:function(res){
                if(res['status'] == 1)
                {
                    attributeEl.html(`<i class='fas fa-toggle-on'></i>`);
                    attributeEl.attr('data-product_attribute_status', 1);
                }

                if(res['status'] == 0)
                {
                    attributeEl.html(`<i class='fas fa-toggle-off'></i>`);
                    attributeEl.attr('data-product_attribute_status', 0);
                }
            }
        });
    });


    //Delete Product Attributes
    $("#productAttributesTbl").on('click', '.delete_product_attribute', function(){
        var product_attribute_id = $(this).attr('data-attribute_id');
        swal.fire({
            title: 'Warning!',
            text: 'Deleted product attribute cannot be reverted!',
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
                    url: `/admin/product/attribute/delete`,
                    method: 'POST',
                    data: {product_attribute_id: product_attribute_id},
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
