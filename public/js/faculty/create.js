$(function(){
    $('#faculty-form').submit(function(e){
        
        e.preventDefault();
        var that = $(this);
        var res_url = that.attr('data-res_url');
        $("p[class$='_e']").text('');
        var url = $(this).attr('action');
        var input = $(this).find('input:checked,input:not(:radio):not(:checkbox):not(:submit):not(:reset):not([type=file]),select,textarea');
        var img = document.getElementById('photo').files;
        var form = new FormData();
        if (img.length) form.append('photo', img[0]);
        input.each(function(k, v) {
            form.append($(v).attr('name'), $(v).val());
        });
        $.ajax({
            type: 'post',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend : function(){
                that.find('button[type=submit]').button('loading');
            },
            complete : function(){
                that.find('button[type=submit]').button('reset');
            },
            success: function(res) {
                if (res.success) {
                    window.location.href = res_url+'?response=true';
                }
            },
            statusCode: {
                422: function(request, error) {
                    $.each(request.responseJSON, function(k, v) {
                        $('p.' + k + '_e').text(v[0]);
                    });
                }
            }
    
        });
    });
    $("input[name=dob]").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true,
        yearRange: "-100:-17"
    })
});