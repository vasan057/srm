$(function(){
    $('input[type=radio]').change(function(){
        var id = $(this).val();
        if(id){
            $("div[class$='_div']").hide().find("select").prop('disabled',true);
            $("."+id+"_div").show().find("select").attr('disabled',false);
        }
    });
    $("select,input[type=radio]").change(listReferrence);
    $('#search-btn').click(listReferrence);
    $('#search-list').on('click','.edit-btn',function(){
        var url = $(this).attr('data-url');
        $.get(url).done(function(res){
            if(res.success){
                $('#ref-modal').modal('show');
                $('#form-modal').html(res.success);
            }
        })
    });
    $('#form-modal').on('change','.prize_type',function(){
        var type = $(this).val();
        $("div[class$=_divs]").val('').hide().find('input').prop('disabled',true);
        $('.'+type+'_divs').show().find('input').attr('disabled',false);
    });

    $('#ref-btn').click(function(){
        $("p[class$='_e']").text('');
        var form = $('#ref-modal form');
        var data = form.serializeArray();
        url = form.attr('action');
        $.ajax({
            type : 'post',
            data : data,
            url : url,
            beforeSend:function(){
                $('#ref-btn').button('loading');
            },
            complete : function(){
                $('#ref-btn').button('reset');
            },
            success : function(res){
                listReferrence();
                $('#ref-modal').modal('hide');
                // window.location.href = url;
            },
            statusCode : {
                422: function(request, error) {
                    $.each(request.responseJSON, function(k, v) {
                        $('p.' + k + '_e').text(v[0]);
                    });
                }
            }
        });
    });
});

function listReferrence(){
     $("p[class$='_e']").text('');
    var data = $('#search-form').serializeArray();
    var url = $("#search-form").attr('action');
    $('#search-btn').button('loading');
    $.post(url,data).done(function(res){
        if(res.success){
            $('#search-list').html(res.success);
            $('#search-btn').button('reset');
        }
    }).error(function(res){
         $.each(res.responseJSON, function(k, v) {
            $('p.' + k + '_e').text(v[0]);
        });
        $('#search-btn').button('reset');
    });
}