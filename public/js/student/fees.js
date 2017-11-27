$(function(){
    suggest = $.parseJSON(suggest);
    var course = [];
    $.each(suggest,function(k,v){
        course[v.id] = v;
    });
    $('#institution').change(function(){
        var ins = $(this).val();
        if(ins){
            $('#coursename').html("<option value='"+course[ins].course_id+"'>"+course[ins].course_name+"</option>")
        }else{
            $('#coursename').html("<option value=''>Select</option");
        }
    }); 
    $('#totalfees,#scholarship,#amountpaid').keyup(function(){
        if(isNumber($(this).val())){
           $(this).parent().next('.text-danger').text('');
        }else{
            $(this).parent().next('.text-danger').text('Total Fee should not be string');
            $(this).val('');
            // return false;
        }
        calculateFees();
    });
    
    $('#free-form').submit(function(){
        feeForm(this);
        return false;
    })
});

function calculateFees(){
    var tot_fee =  $('#totalfees').val();
    var scholarship =  $('#scholarship').val();
    var paid = $('#amountpaid').val();
    var pre_paid = $('#pre_amount').val();
    
    if(tot_fee == '' || !isNumber(tot_fee)) tot_fee =0;
    if(scholarship == '' || !isNumber(scholarship)) scholarship =0;
    // grand total
    var grand_total = parseFloat(tot_fee)-parseFloat(scholarship);
    $('#grandtotal').val(grand_total);
    // Amount after paid
    if(paid == '' || !isNumber(paid)) paid =0;
    // prepaid
    if(pre_paid == undefined || !isNumber(pre_paid)) pre_paid=0;
    var balance = grand_total-(parseFloat(paid)+parseFloat(pre_paid));
    $('#balanceamount').val(balance);

}
function isNumber(val) {
    var regexp = /^[\d.]+$/;
     if (regexp.test(val)) {
         return true;
     }
     return false;
 }

 function feeForm(that){
    $("p[class$='_e']").text('');
    var data = $(that).serializeArray();
    var url = $(that).attr('action');
    $.ajax({
        type : 'post',
        url : url,
        data : data,
        beforeSend:function(){
            $(that).find('button[type=submit]').button('loading');
        },
        complete : function(){
            $(that).find('button[type=submit]').button('reset');
        },
        success : function(res){
            // console.log(res);
            window.location.href = url;
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
