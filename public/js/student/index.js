$(function(){
    $('#followup-modal').on('show.bs.modal',function(event){
        console.log('sdsd');
        var btn = $(event.relatedTarget);
        var url = btn.data('url');
        $.get(url).done(function(res){
            if(res.success){
                $('#edit-body').html(res.success);
                $('#followup-modal .modal-title').html(res.student.first_name+' - followup');
            }
        });
    });
    $('body').on('focus',"#remind_date", function(){
        $(this).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear : true
        });
    });
    $('#save-button').click(function(){
        $("p[class$='_e']").text('');
        var data = $('#followup-modal form').serializeArray();
        var url = $('#followup-modal form').attr('action');
        $.ajax({
            type : 'post',
            data : data,
            url : url,
            beforeSend : function(){
                $('#save-button').button('loading');
            },
            complete : function(){
                $('#save-button').button('reset');
            },
            success : function(res){
                if(res.success){
                    window.location.reload();
                }
            },
            statusCode:{
                422: function(request){
                    $.each(request.responseJSON, function(k, v) {
                        $('p.' + k + '_e').text(v[0]);
                    });
                    
                }
            }
        });
    });
});

function deleteStudent(that){
    var _confirm = confirm("Really want to delete!");
    if(!_confirm){ return false;   }
    var url = $(that).attr('href');
    $.ajax({
        type : 'post',
        url : url,
        data : {_method:"DELETE"},
        headers:{
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr('content')
        },
        beforeSend:function(){

        },
        complete : function(){

        },
        success : function(res){
            if(res.success){
                window.location.reload();
            }
        }
    });
    return false;

}