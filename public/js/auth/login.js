$(function(){
    $('#login-form').submit(function(e){
        $("p[class$='_e']").text('');
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            url : url,
            type : 'post',
            data : data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           
            success : function(res){
                // e.preventDefault();
                window.location.reload();
                return true;
            },
            statusCode:{
                422 : function(res){
                    if(res.responseText){
                        var errors = $.parseJSON(res.responseText);
                        $.each(errors,function(k,v){
                            $('.'+k+'_e').text(v);
                        });
                    }
                    e.preventDefault();
                    return false;
                }
            }
        });
      
        e.preventDefault();
        
    });
});