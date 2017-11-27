$(function(){
    $("#loader").fakeLoader();
    $("#loader").hide();
    $("#add_intake").click(function () {
        var selectedItem = $("#intake option:selected");
        $("#intake_month").append(selectedItem);
    });
    $('#pre-img').popover({html:true,trigger:"hover"});
    $("#delete_intake").click(function () {
        var selectedItem = $("#intake_month option:selected");
        $("#intake").append(selectedItem);
    });

    $('#course-upload').change(function(){
        uploadCourse(this);
    });

     // upload photo
     $('#photo').change(function(){
        uploadPhoto(this);
    });

    $('.ielts,.pte').keyup(function(event){
        var that= this;
        if(isNumber($(that).val())){
            $('.en-lang-error').text('').slideUp();
            $(that).removeClass('has-error');
        }else{
            $('.en-lang-error').text('Value should not be string').slideDown();
            $(that).val('').addClass('has-error');
            return false;
        }
        if($(that).val()<=0 || $(that).val()>10){
            $('.en-lang-error').text('Value should not be between 1 to 10').slideDown();
            $(that).addClass('has-error');
            return false;
        }else{
            $('.en-lang-error').text('').slideUp();
            $(that).removeClass('has-error');
        }
    });
    $('.ielts').change(function(){
        var tot = 0;
        var avg = 0;
        var num = 0;
        $('.ielts').each(function(k,v){
            if(isNumber($(v).val())){
                tot += parseInt($(v).val());
                num++;
            } 
        });
        if(tot >0 ) avg = tot / num;
        avg = avg.toFixed(2);
        $('#ielts_overall').val(avg);
        
    });
    $('.pte').change(function(){
        var tot = 0;
        var avg = 0;
        var num = 0;
        $('.pte').each(function(k,v){
            if(isNumber($(v).val())){
                tot += parseInt($(v).val());
                num++;
            } 
        });
        if(tot >0 ) avg = tot / num;
        avg = avg.toFixed(2);
        $('#pte_overall').val(avg);
        
    });
});
function isNumber(val) {
    var regexp = /^[\d.]+$/;
     if (regexp.test(val)) {
         return true;
     }
     return false;
 }
 function uploadPhoto(that){
    $('#pre-img').popover('hide');
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
                $('#pre-img').attr('data-content','<img width="150" height="100" src="/storage/app/'+path+'" alt="Image">').show();
                $('#pre-img').popover('show');
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
function uploadCourse(that){
    var file = that.files[0];
    // 2000000 bytes = 2mb
    var types = [
        "text/csv","text/csv-schema",
        "application/vnd.oasis.opendocument.spreadsheet",
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
    if($.inArray(file.type,types) == -1){
        alert('Provide valid spreadsheet file');
        return false;
    }
    // if(file.size > 2000000){
    //     alert('image should not be more than 2Mb');
    //     return false;
    // }
    var data = new FormData();
    data.append('course_file',file);
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
                var list = res.success;
                var inputs = "";
                $.each(list,function(k,v){
                    inputs += "<input type='hidden' name='course_id[]' value='"+v+"'>";
                });
                $('#course-div').html(inputs);
            }else{
                alert('problem while uploading');
                return false;
            }
        },
        statusCode:{
            422: function(request){
                $.each(request.responseJSON, function(k, v) {
                    alert(v);
                });
                $(that).val('');
            }
        }
    });
}

function instituteForm(that){
    $("p[class$='_e']").text('');
    $('.alert.alert-danger').hide();
    $('.has-error').removeClass('has-error');
    if($("#intake_month option").length){
        $("#intake_month option").prop('selected', true);
    }
    var data = $(that).serializeArray();
    var url = $(that).attr('action');
    var pre_url = $(that).attr('data-url');
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
            window.location.href = pre_url;
        },
        statusCode : {
            422: function(request, error) {
                var init = request.responseJSON;
                var i=0;
                var pos="";
                $.each(request.responseJSON, function(k, v) {
                    if(i==0) pos = k+'_e'; 
                    if (k.indexOf('pte_') > -1)
                    {
                        var cust = k.replace('.','\\.');
                        $('.'+cust).addClass('has-error');
                        pos = cust;
                    }else if(k.indexOf('ielts_') > -1){
                        var cust = k.replace('.','\\.');
                        $('.'+cust).addClass('has-error');
                        pos = cust;
                    }else{
                        $('p.' + k + '_e').text(v[0]);
                    }
                    i++;
                });
                alertMessage();
                $("html, body").animate({ scrollTop: $('.'+pos).offset().top }, 2000);
            }
        }
    })
    return false;
}
function alertMessage(){
    if($('.edu-panel').find('input.has-error').length){
        $('.edu-panel').find('.alert.alert-danger').text("Make sure below details are correct").show();
    }
    if($('.p-course-panel').find('input.has-error').length){
        $('.p-course-panel').find('.alert.alert-danger').text("Make sure below details are correct").show();
    }
    if($('.eng-panel').find('input.has-error').length){
        $('.eng-panel').find('.alert.alert-danger').text("Make sure below details are correct").show();
    }
    if($('.exp-panel').find('input.has-error').length){
        $('.exp-panel').find('.alert.alert-danger').text("Make sure below details are correct").show();
    }
}