$(function(){

});

function editCourse(that){
    $("p[class$='_e']").text('');
    var data = $(that).serializeArray();
    var url = $(that).attr('action');
    var pe_url = $(that).attr('data-url');
    $.ajax({
        type : 'post',
        url : url,
        data : data,
        headers:{
            "X-CSRF-TOKEN" : $('meta[name=csrf-token]').attr('content')
        },
        beforeSend:function(){
            $('#institute-form-submit').button('loading');
        },
        complete : function(){
            $('#institute-form-submit').button('reset');
        },
        success : function(res){
            window.location.href = pe_url;
        },
        statusCode : {
            422: function(request, error) {
                var init = request.responseJSON;
                var i=0;
                var pos="";
                $.each(request.responseJSON, function(k, v) {
                    if(i==0) pos = k+'_e'; 
                     $('p.' + k + '_e').text(v[0]);
                    i++;
                });
                $("html, body").animate({ scrollTop: $('.'+pos).offset().top }, 2000);
            }
        }
    })
    return false;
}
