$(function(){
	$('#send_to').tagsInput({
		// autocomplete_url:'http://myserver.com/api/autocomplete',
		// autocomplete:{selectFirst:true,width:'100px',autoFill:true},
		 'height':'35px',
		 'width':'100%',
		 'defaultText':"Email(s)"
		 // 'removeWithBackspace' : true
	});
	$("#header_text").keyup(function(event) {
		$('#head-text').html($(this).val());
	});
	$('#body').keyup(function(event) {
		$('#body-text').html($(this).val());
	});
	$('#newsletter-form').submit(function(e){
		$("p[class$=_e]").text('');
		e.preventDefault();
		var that = $(this);
		console.log($('#send_to_addTag'));
		var email = $('#send_to').val();
		var subject = $('#subject').val();
		var head = $('#header_text').val();
		var body = $('#body').val();
		var text = $('#preview-div').html();
		var data = {email:email,subject:subject,header_text:head,body:body,text:text};
		var url = $(this).attr('action');
		$.ajax({
			type:'post',
			data : data,
			url :url,
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
                     new PNotify({
			            title: 'Success!',
			            text: 'The newsletter submitted is successful.',
			            type: 'success'
			        });
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
		return false;
	});
});