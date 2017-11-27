$(function(){
	$('.check-doc,.view-details').click(function(){
		var type = $(this).attr('name');
		var type_id = $(this).attr('data-type');
		var href = 0;
		var extra = "";
		var val = $(this).is(":checked") ? '1':'0';
		if($(this).is("a")){
			href = 1;
		}
		if(type == 'coe_applied' && val == '1'){
			var suggest = $("input[name=suggest_id]:checked");
			if(!suggest.length){
				alert('Please choose course');
				return false;
			}else{
				extra = "&suggest="+suggest.val();
			}
		}
		var url = $(this).attr('data-url');
		var data = url+'?type='+type+'&type_id='+type_id+'&check='+val+'&href='+href+extra;
		$.get(data, function(data) {
			if(data.success){
				$("#stage-modal .modal-body").html(data.success);
				$('#stage-modal').modal('show');
				if(href){
					$('#stage-button').hide();
				}else{
					$('#stage-button').show();
				}
			}
		});
	});
	$('#drop').change(function(){
		var that = $(this);
		var val = that.val();
		var url = that.attr("data-url");
		var _token = that.attr('data-token');
		$.post(url,{institute_id:val,_token:_token}, function(data, textStatus, xhr) {
			console.log(textStatus);
		}); 
	});
	 $('#stage-button').click(function(){
        $("p[class$='_e']").text('');
        var form = $('#stage-modal form');
        var data = form.serializeArray();
        url = form.attr('action');
        $.ajax({
            type : 'post',
            data : data,
            url : url,
            beforeSend:function(){
                $('#stage-button').button('loading');
            },
            complete : function(){
                $('#stage-button').button('reset');
            },
            success : function(res){
            	if(res.success){
	            	$('#stage-modal').modal('hide');
            	}
                window.location.href = url;
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