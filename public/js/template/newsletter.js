$(function(){
    $('#photo').change(function(){
        uploadPhoto(this);
    });
});
function uploadPhoto(that){
    var file = that.files[0];
    // 2000000 bytes = 2mb
    var types = ["image/jpeg","image/svg+xml","image/png"];
    if($.inArray(file.type,types) == -1){
        alert('Provide valid image file');
        return false;
    }
    if(file.size > 2000000){
        alert('image should not be more than 2Mb');
        return false;
    }
    var data = new FormData();
    data.append('photo',file);
    var url = $(that).attr('data-url');
    $.ajax({
        type : 'post',
        data : data,
        url : url,
        contentType: false,
        processData:false,
        headers : {
            "X-CSRF-TOKEN" : $("meta[name=csrf-token]").attr('content')
        },
        beforeSend : function(){
            $("#loader").show();
        },
        complete : function(){
            $("#loader").hide();
        },
        success : function(res){
            if(res.success){
                var path = res.success.full_path;
                var photo_id = res.success.id;
                $('#current_img').attr('src','/storage/app/'+path);
                $("input[name=photo_id]").val(photo_id).attr('disabled',false);
                
            }else{
                alert('problem while uploading');
                $("input[name=photo_id]").attr('disabled',true);
                $(that).val('');
                return false;
            }
        },
        statusCode:{
            422: function(request){
                $.each(request.responseJSON, function(k, v) {
                    alert(v);
                });
                $(that).val('');
                $("input[name=photo_id]").attr('disabled',true);
            }
        }
    });
}
function updateNewsletter(that){
    $("p[class$='_e']").text('');
    $('.alert.alert-danger').hide();
    $('.has-error').removeClass('has-error');
    var data = $(that).serializeArray();
    var url = $(that).attr('action');
    $.ajax({
        type : 'post',
        url : url,
        data : data,
        headers:{
            "X-CSRF-TOKEN" : $('meta[name=csrf-token]').attr('content')
        },
        beforeSend:function(){
            $('#student-form-submit').button('loading');
        },
        complete : function(){
            $('#student-form-submit').button('reset');
        },
        success : function(res){
            if(res.success){
                new PNotify({
                    title: 'Success!',
                    text: 'updated successfully',
                    type: 'success'
                });
                $('#preview-div').html(res.success);
            }
            
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