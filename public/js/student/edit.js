var count = 1;
var exp_count = 1;
var cou_count =1;
$(function(){
    studentType();
    $("#loader").fakeLoader();
    $("#loader").hide();
    $('input[name=student_type]').change(studentType);
    // $('input[name=dob]').datetimepicker({
    //     format:'D-MM-YYYY'
    // });
    $('#expiry_date').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
    });
    $(".add_ed").click(addEducation);
    $(".add_co").click(addCourse);
    $('#add_ed_table').on('keyup','.duration,.backlogs',function(event){
        var that= this;
        if(isNumber($(that).val())){
            $('.ed-table-error').text('').slideUp();
            $(that).removeClass('has-error');
        }else{
            $('.ed-table-error').text('Value should not be string').slideDown();
            $(that).val('').addClass('has-error');
            return false;
        }
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
    $('#add_ed_table').on('click','.rem_ed',function(){
        $(this).parent().parent().remove();
    });
    $('#add-course').on('click','.rm_co',function(){
        $(this).parent().parent().remove();
    });
    $('.add_work').click(addWorkExp);
    $('#add-work_exp').on('click','.rm_work',function(){
        $(this).parent().parent().remove();
    });
    $('.refer').change(function(){
        $('.refer-extra').hide();
        $('.refer-extra input,.refer-extra select').val('').attr('disabled',true);
        var _current = $(this).val();
        $('#'+_current+'Div').show();
        $('#'+_current+'Div input,#'+_current+'Div select').attr('disabled',false);

    });
// visa from to date
    $('#visa_grand_date').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
        }).on( "change", function() {
          $('#visa_expiry_date').datepicker( "option", "minDate", getDate( this ) );
      });
    $('#visa_expiry_date').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
    }).on( "change", function() {
        $('#visa_grand_date').datepicker( "option", "maxDate", getDate( this ) );
    });
    // eduction course from to date
    
    $('#course_from').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
        }).on( "change", function() {
          $('#course_to').datepicker( "option", "minDate", getDate( this ) );
      });
    $('#course_to').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
    }).on( "change", function() {
        $('#course_from').datepicker( "option", "maxDate", getDate( this ) );
    });
    // end
    
    // Experience from to date
    
    $('#work_from').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
        }).on( "change", function() {
          $('#work_to').datepicker( "option", "minDate", getDate( this ) );
      });
    $('#work_to').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
    }).on( "change", function() {
        $('#work_from').datepicker( "option", "maxDate", getDate( this ) );
    });
    // end

    $('#dob1,#expiry_date,.datepicker').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true,
    });
    $("input[name=dob]").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true,
        yearRange: "-100:-17"
    })
    // $('#dob1,#expiry_date,#visa_expiry_date,#visa_grand_date,.datepicker').val('');
    $('#others_referral_name').change(function(){
        if($(this).val() == 'new'){
            $('#modal_no_footer').modal('show');
        }
    });
    

    // upload photo
    $('#photos').change(function(){
        uploadPhoto(this);
    });
    $('.refer-extra').hide();
    var _current = $('.refer:checked').val();
    $('#'+_current+'Div').show();

    $('#new-referral').submit(function(){
        $("p[class$='_e']").text('');
        var data = $(this).serializeArray();
        var btn = $(this).find("button[type=submit]");
        var url = this.action;
        $.ajax({
           type : 'post',
           url: url,
           data: data,
           beforeSend : function(){
                btn.button('loading');
           },
           complete : function(){
               btn.button('reset');
           },
           success : function(res){
                if(res.success){
                    $('#othersDiv select').append("<option value='"+res.success.id+"'>"+res.success.name+"</option>");
                    $('#modal_no_footer').modal('hide');
                    $('#othersDiv select').val(res.success.id);
                }
           },
           statusCode:{
               422: function(response){
                   $.each(response.responseJSON,function(k,v){
                        $('p.' + k + '_e').text(v[0]);
                   });
               }
           }
        });
        return false;
    });

    // check same course already available or not
    $('#add-course').on('change','.course-title',function(){
        var list = [""];
        var that= this;
        $('#add-course .course-title').not(this).each(function(k,v){
            list.push($(v).val());
        });
        if($.inArray($(that).val(),list) != -1){
            $(that).val('');
        }
    });
    $('#add_ed_table').on('change','.edu_course_title',function(){
        var list = [""];
        var that= this;
        $('#add_ed_table .edu_course_title').not(this).each(function(k,v){
            list.push($(v).val());
        });
        if($.inArray($(that).val(),list) != -1){
            $(that).val('');
        }
    });

    // check if the same date is available
    $('#add_ed_table').on('change','.from-year',function(){
        var that = this;
        var cu_tr = $($(this).parent()).parent();
        var all = $('.from-year').parent().parent();
        // loop the dates tr except current
        all.not(cu_tr).each(function(k,v){
            var from = $(v).find('.from-year').val();
            var to = $(v).find('.to-year').val();
            var curr = $(that).val();
            if( from  && to && curr){
               if(dateCheck(from,to,curr)){
                    $(that).val('');
               }
            }
           
        })
    });
    $('#add_ed_table').on('change','.to-year',function(){
        var that = this;
        var cu_tr = $($(this).parent()).parent();
        var all = $('.to-year').parent().parent();
        // loop the dates tr except current
        all.not(cu_tr).each(function(k,v){
            var from = $(v).find('.from-year').val();
            var to = $(v).find('.to-year').val();
            var curr = $(that).val();
            if( from  && to && curr){
               if(dateCheck(from,to,curr)){
                    $(that).val('');
               }
            }
           
        })
    });

    // check expleriance date time
    $('#add-work_exp').on('change','.exp-from-date',function(){
        var that = this;
        var cu_tr = $($(this).parent()).parent();
        var all = $('.exp-from-date').parent().parent();
        // loop the dates tr except current
        all.not(cu_tr).each(function(k,v){
            var from = $(v).find('.exp-from-date').val();
            var to = $(v).find('.exp-to-date').val();
            var curr = $(that).val();
            if( from  && to && curr){
               if(dateCheck(from,to,curr)){
                    $(that).val('');
               }
            }
           
        })
    });
    $('#add-work_exp').on('change','.exp-to-date',function(){
        var that = this;
        var cu_tr = $($(this).parent()).parent();
        var all = $('.exp-to-date').parent().parent();
        // loop the dates tr except current
        all.not(cu_tr).each(function(k,v){
            var from = $(v).find('.exp-from-date').val();
            var to = $(v).find('.exp-to-date').val();
            var curr = $(that).val();
            if( from  && to && curr){
               if(dateCheck(from,to,curr)){
                    $(that).val('');
               }
            }
           
        })
    });
    $('#pre-img').popover({html:true,trigger:"hover"});

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
function studentType(){
    var type = $('input[name=student_type]:checked').attr('data-type');
    if(type == 'onshore'){  
        $('#onshore-div').show();
    }else{
        $('#onshore-div').hide();
    }
}
function addCourse(){
    var date = new Date();
    var year = date.getFullYear();
    var options = "";
    for(var i=0; i<14;i++){
        options +=  "<option value='"+(year+i)+"'>"+(year+i)+"</option>";
    }
    $('#add-course').append(
        '<tr>'+
        '<td>'+
            '<select class="form-control course-title course_title.'+cou_count+'" name="course_title['+cou_count+']" >'+
                '<option value="" selected>Select</option>'+
                '<option value="Certificate III">Certificate III</option>'+
                '<option value="Certificate IV">Certificate IV</option>'+
                '<option value="Diploma">Diploma</option>'+
                '<option value="Bachelors">Bachelors</option>'+
                '<option value="Graduate Certificate">Graduate Certificate</option>'+
                '<option value="Graduate Diploma">Graduate Diploma</option>'+
                '<option value="English">English</option>'+
                '<option value="IELTS">IELTS</option>'+
                '<option value="Masters">Masters</option>'+
            '</select>'+
            '<p class="text-danger"></p>'+
        '</td>'+
        '<td>'+
            '<input type="text" class="form-control precourse.'+cou_count+'" name="precourse['+cou_count+']" placeholder="Course Name"/>'+
            '<p class="text-danger"></p>'+
        '</td>'+
        '<td>'+
            '<select class="form-control select year commencement_year.'+cou_count+'" name="commencement_year['+cou_count+']" >'+options+
            '</select>'+
            '<p class="text-danger"></p>'+
        '</td>'+
        '<td><a href="javascript:void(0);" class="rm_co"><i class="fa fa-minus-square"></i></a></td>'+
    '</tr>'
    );
    cou_count++;
}
function addWorkExp(){
    $('#add-work_exp').append(
      '<tr>'+
      '<td>'+
          '<input type="text" class="form-control employer_name.'+exp_count+'" name="employer_name['+exp_count+']"  placeholder="Employer\'s Name" /></td><p class="text-danger"></p>'+
      '<td>'+
          '<input type="text" class="form-control exp-from-date from.'+exp_count+'" placeholder="From Year" id="work_from_'+exp_count+'" name="from['+exp_count+']" readOnly="readOnly" placeholder="Start Year" /><p class="text-danger"></p>'+
      '</td>'+
      '<td>'+
          '<input type="text" class="form-control exp-to-date to.'+exp_count+'" placeholder="To Year" id="work_to_'+exp_count+'" name="to['+exp_count+']" readOnly="readOnly" placeholder="End Year" /><p class="text-danger"></p>'+
      '</td>'+
      '<td>'+
          '<input type="text" class="form-control responsbility.'+exp_count+'" name="responsibilty['+exp_count+']" placeholder="Responsibilty" /><p class="text-danger"></p>'+
      '</td>'+
      '<td>'+
          '<a href="javascript:void(0);" class="rm_work"><i class="fa fa-minus-square"></i></a>'+
      '</td>'+
  '</tr>'  
    );
    var c_count = exp_count;
    $('#add-work_exp #work_from_'+exp_count).datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
    }).on( "change", function() {
        $('#add-work_exp #work_to_'+c_count).datepicker( "option", "minDate", getDate( this ) );
    });
    $('#add-work_exp #work_to_'+exp_count).datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear : true
    }).on( "change", function() {
        $('#add-work_exp #work_from_'+c_count).datepicker( "option", "maxDate", getDate( this ) );
    });
    exp_count++;
}
function addEducation(){
    $("#add_ed_table").append('<tr>'+
        '<td>'+
            '<select class="form-control edu_course_title.'+count+' edu_course_title" name="edu_course_title['+count+']" id="edu_course_title' + count + '">'+
                '<option value="" selected>Select</option>'+
                '<option value="Certificate III">Certificate III</option>'+
                '<option value="Certificate IV">Certificate IV</option>'+
                '<option value="Diploma">Diploma</option>'+
                '<option value="Bachelors" >Bachelors</option>'+
                '<option value="Graduate Certificate" >Graduate Certificate</option>'+
                '<option value="Graduate Diploma" >Graduate Diploma</option>'+
                '<option value="English" >English</option>'+
                '<option value="IELTS" >IELTS</option>'+
                '<option value="Masters">Masters</option>'+
            '</select>'+
        '</td>'+
        '<td>'+
            '<input type="text" class="form-control course_name.'+count+'" name="course_name['+count+']" id="course_name' + count + '" placeholder="Course Name" />'+
        '</td>'+
        '<td>'+
        '<input type="text" class="form-control institution.'+count+'" name="institution['+count+']" id="institution' + count + '" placeholder="Institution Name"/>'+
        '</td>'+
        '<td><input type="text" class="form-control country_val' + count + '" name="country_val[]" id="country_val' + count + '" placeholder="Country" />'+
        '</td><td><input type="text" class="form-control country_state' + count + '" name="country_state[]" id="country_state' + count + '" placeholder="State/Country" />'+
        '</td>'+
        '<td>'+
        '<input type="text" class="form-control year_from.'+count+' from-year" value="" id="course_from_'+count+'" name="year_from['+count+']" readonly="" placeholder="Start Year" autocomplete="on" >'+
        '</td>'+
        '<td>'+
        '<input type="text" class="form-control year_to.'+count+' to-year" value="" name="year_to['+count+']" id="course_to_'+count+'" placeholder="End Year"  readonly />'+
        '</td>'+
        '<td>'+
        '<input type="text" class="form-control duration.'+count+' duration" name="duration['+count+']" id="duration' + count + '" placeholder="Duration" maxlength="1"/>'+
        '</td>'+
        '<td>'+
        '<select  class="form-control" name="status['+count+']">'+
        '<option value="1">Completed</option>'+
        '<option value="0">Incomplete</option>'+
        '</select>'+
        '</td>'+
        '<td>'+
        '<input type="text" class="form-control backlogs.'+count+' backlogs" name="backlogs['+count+']" id="backlogs' + count + '" maxlength="2" placeholder="Backlogs"/>'+
        '</td>'+
        '<td><a href="javascript:void(0);" class="rem_ed"><i class="fa fa-minus-square"></i></a></td></tr>');
        var c_count = count;
        $('#add_ed_table #course_from_'+count).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear : true
        }).on( "change", function() {
            $('#add_ed_table #course_to_'+c_count).datepicker( "option", "minDate", getDate( this ) );
        });
        $('#add_ed_table #course_to_'+count).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear : true
        }).on( "change", function() {
            $('#add_ed_table #course_from_'+c_count).datepicker( "option", "maxDate", getDate( this ) );
        });
        count++;
    }
    function isNumber(val) {
       var regexp = /^[\d.]+$/;
        if (regexp.test(val)) {
            return true;
        }
        return false;
    }
function studentForm(that){
    $("p[class$='_e']").text('');
    $('.alert.alert-danger').hide();
    $('.has-error').removeClass('has-error');
    var data = $(that).serializeArray();
    var url = $(that).attr('action');
    $.ajax({
        type : 'post',
        url : url,
        data : data,
        beforeSend:function(){
            $('#student-form-submit').button('loading');
        },
        complete : function(){
            $('#student-form-submit').button('reset');
        },
        success : function(res){
            // window.location.href = url;
            if(res.success){
                new PNotify({
                    title: 'Success!',
                    text: 'The student details updated successful.',
                    type: 'success'
                });
            }
        },
        statusCode : {
            422: function(request, error) {
                var init = request.responseJSON;
                var i=0;
                var pos="";
                $.each(request.responseJSON, function(k, v) {
                    if(i==0) pos = k+'_e'; 
                    if (k.indexOf('.') > -1)
                    {
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
function dateCheck(from,to,check) {
    
    var fDate,lDate,cDate;
    var d1 = from.split("-");
    var d2 = to.split("-");
    var c = check.split("-");
    var fDate = new Date(d1[2], parseInt(d1[1])-1, d1[0]);  // -1 because months are from 0 to 11
    var lDate   = new Date(d2[2], parseInt(d2[1])-1, d2[0]);
    var cDate = new Date(c[2], parseInt(c[1])-1, c[0]);
    if((cDate <= lDate && cDate >= fDate)) {
        return true;
    }
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
                $('#pre-img').attr('src',"/storage/app/"+path);
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
    })
}