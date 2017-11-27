 $(function(){
    $('#edit-invoice').on('show.bs.modal',function(event){
        var btn = $(event.relatedTarget);
        var url = btn.data('url');
        $.get(url).done(function(res){
            if(res.success){
                $('#edit-body').html(res.success);
                $('#edit-invoice .modal-title').html(res.institute);
            }
        });
    });
    $('body').on('focus',"#fromDate", function(){
        $(this).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear : true
        }).on( "change", function() {
            $('#toDate').datepicker( "option", "minDate", getDate( this ) );
        });
    });
    $('body').on('focus',"#toDate", function(){
        $(this).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear : true
        }).on( "change", function() {
            $('#fromDate').datepicker( "option", "maxDate", getDate( this ) );
        });
    });
    $('#edit-invoice').on('change','#consultancyPercentage,#gst',calAmount);
    $('#edit-invoice').on('keyup','#consultancyPercentage,#gst',calAmount);
    // form button event
    $('#send-invoice').click(function(){
      console.log('dff');
      var that = $(this);
        var url = that.attr('data-url');
        $.ajax({
            type : 'get',
            url : url,
            beforeSend : function(){
                that.button('loading');
            },
            complete : function(){
                that.button('reset');
            },
            success : function(res){
                if(res.success){
                    new PNotify({
                        title: 'Success!',
                        text: 'The Invoice sent successful.',
                        type: 'success'
                    });
                }
            }
        });
    });
    $('#edit-button').click(function(){
        $("p[class$='_e']").text('');
        var data = $('#edit-invoice form').serializeArray();
        var url = $('#edit-invoice form').attr('action');
        $.ajax({
            type : 'post',
            data : data,
            url : url,
            beforeSend : function(){
                $('#edit-button').button('loading');
            },
            complete : function(){
                $('#edit-button').button('reset');
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

 function getDate( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( 'dd-mm-yy', element.value );
    } catch( error ) {
      date = null;
    }

    return date;
  }

  function calAmount(){
      $("p[class$='_e']").text('');
      var amount = $('#edit-invoice #amount').val();
      var percent = $('#edit-invoice #consultancyPercentage').val();
      var subtotal = $('#edit-invoice #totalAmount').val();
      var gst = $('#edit-invoice #gst').val();
      var grandTotal = $('#edit-invoice #grandTotal').val();
      if(isNaN(percent)) $('#edit-invoice .consultancyPercentage_e').text('provide valid data');
      if(isNaN(gst)) $('#edit-invoice .gst_e').text('provide valid data');
      if(!parseFloat(amount)) amount = 0;
      if(!parseFloat(percent)) percent = 0;
      if(!parseFloat(subtotal)) subtotal = 0;
      if(!parseFloat(gst)) gst = 0;
      grandTotal = 0;
      subtotal = 0;
      if(parseFloat(percent) > 0){
          var pe = parseFloat(percent) / 100;
          subtotal = parseFloat(amount)*pe;
          grandTotal = subtotal;
          if(parseFloat(gst) >0){
              var g_pe = parseFloat(gst) /100;
              grandTotal = grandTotal + (g_pe*grandTotal);
          }
      }
      $('#edit-invoice #amount').val(amount);
    //   $('#edit-invoice #consultancyPercentage').val(percent);
      $('#edit-invoice #totalAmount').val(subtotal);
    //   $('#edit-invoice #gst').val(gst);
      $('#edit-invoice #grandTotal').val(grandTotal);
      

  }