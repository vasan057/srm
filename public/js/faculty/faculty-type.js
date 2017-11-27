$(function(){

    $('#edit-modal').on('show.bs.modal',function(e){
        var btn = $(e.relatedTarget);
        $(this).find('form').attr('action',btn.data('url'));
        $(this).find('form input[name=type_name]').val(btn.data('value'));
    });

    $('#faculty-type-form,#faculty-type-edit-form').submit(function(e){
        e.preventDefault();
        var data = $(this).serializeArray();
        var btn = $(this).find('button[type=submit]');
        var url = $(this).attr('action');
        $.ajax({
            type : 'post',
            data :data,
            url : url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend : function(){
                btn.button('loading');
            },
            complete : function(){
                btn.button('reset');
            },
            success : function(){
                window.location.reload();
            },
            statusCode: {
                422: function(res) {
                    var err = res.responseJSON;
                    if (err) {
                        $.each(err, function(k, v) {
                            $('p.' + k + "_e").text(v[0]);
                        })
                    }
                }
            }
        });
    });
}); 