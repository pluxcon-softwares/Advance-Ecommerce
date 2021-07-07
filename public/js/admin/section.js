$(function(){
    //Add CSRF TOKEN to ajax header
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
        }
    });

    //Instatiate sections table
    var sectionsTbl = $("#sectionsTbl").DataTable({});

    //Change section status
    $("#sectionsTbl").on('click', '.section_status', function(e){
        e.preventDefault();
        //e.stopImmediatePropagation();
        var sectionEl = $(this);
        var section_id = sectionEl.attr('data-section_id');
        var section_status = sectionEl.attr('data-section_status');
        $.ajax({
            url: '/admin/section/change-section-status',
            method: 'POST',
            data:{section_id: section_id, section_status: section_status},
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
                    sectionEl.html(`<i class="fas fa-toggle-on"></i>`);
                    sectionEl.attr('data-section_status', 1);
                }

                if(res['status'] == 0)
                {
                    sectionEl.html(`<i class="fas fa-toggle-off"></i>`);
                    sectionEl.attr('data-section_status', 0);
                }
            }
        });
    });
});
