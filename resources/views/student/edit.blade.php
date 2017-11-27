@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
     <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Dashboard</a></li>
      <li><a href="{{url('/student')}}">View Student list</a></li>
      <li class="active">Edit </li>
    </ol>
    <!-- top tiles -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" enctype="multipart/form-data" action="{{url('student/'.$student->id)}}" method="post" onsubmit="return studentForm(this)">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="panel panel-default">
                        <div class="x_title">
                            <div class="col-md-6">
                                <h3>Student <small>Details</small></h3>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav navbar-right panel_toolbox">
                                    <h6 align="right">*Mandatory Fields</h6>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">                                                                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Student Identity *</label>
                                        <div class="col-md-9">
                                            <label class="check"><input type="radio" class="iradio"  data-type='onshore' name="student_type" value="Onshore Student" @if($student->is_onshore) checked @endif/> Onshore Student &nbsp;&nbsp;</label>
                                            <label class="check"><input type="radio" class="iradio" data-type='offshore' name="student_type" value="Offshore Student" @if(!$student->is_onshore) checked @endif/> Offshore Student &nbsp;&nbsp;</label>
                                            <p class="text-danger student_type_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Title *</label>
                                        <div class="col-md-9"> 
                                            <select class="form-control select" name="title" id="title">
                                                <option value="">Select</option>
                                                <option value="Mr" @if($student->title == 'Mr') selected @endif>Mr.</option>
                                                <option value="Miss" @if($student->title == 'Miss') selected @endif>Miss</option>
                                                <option value="Mrs" @if($student->title == 'Mrs') selected @endif>Mrs.</option>
                                            </select>
                                            <p class="text-danger title_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">First Name *</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <input type="text" value="{{$student->first_name}}" class="form-control has-feedback-left" name="first_name" id="first_name" placeholder="First Name" />
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger first_name_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Middle Name </label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                <input type="text" value="{{$student->middle_name}}" class="form-control has-feedback-left" name="middle_name" id="middle_name" placeholder="Middle Name" />
                                                <p class="text-danger middle_name_e "></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Last Name *</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <span class="fa fa-user form-control-feedback left"></span>
                                                <input type="text" value="{{$student->last_name}}" class="form-control has-feedback-left" name="last_name" id="last_name" placeholder="Last Name" />
                                                <p class="text-danger last_name_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">                                        
                                        <label class="col-md-3 control-label">DOB *</label>
                                        <div class="col-md-9">
                                            <div >
                                                <span class="fa fa-calendar form-control-feedback left"></span>
                                                <input type="text"  value="{{date('d-m-Y',strtotime($student->dob))}}" class="form-control has-feedback-left "  name="dob" readOnly="readOnly" placeholder="Date of Birth" />
                                                <p class="text-danger dob_e"></p>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nationality *</label>
                                        <div class="col-md-9"> 
                                            @php $country = App\Model\Country::pluck('country_name') @endphp
                                            <select class="form-control select" name="nationality" id="nationality">
                                                <option value="">Select</option>
                                                @foreach($country as $coun)
                                                <option value="{{$coun}}" @if($student->nationality) selected @endif>{{$coun}}</option>
                                                @endforeach 
                                            </select>
                                            <p class="text-danger nationality_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Address *</label>
                                        <div class="col-md-9 col-xs-12">
                                            <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"> {{$student->address}}</textarea>  
                                            <p class="text-danger address_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Email ID *</label>
                                        <div class="col-md-9">
                                            <div > 
                                                <span class="fa fa-envelope form-control-feedback left"></span>
                                                <input type="text" class="form-control has-feedback-left" name="email_id" id="email_id" placeholder="E-mail Id"  value="{{$student->email_id}}"/>
                                                <p class="text-danger email_id_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Contact No. *</label>
                                        <div class="col-md-9">
                                            <div > 
                                                <span class="fa fa-phone form-control-feedback left"></span>
                                                <input type="text" value="{{$student->phone}}" class="form-control has-feedback-left" name="phone" id="phone" placeholder="Contact-No" maxlength="10"/>
                                                <p class="text-danger phone_e"></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Disability(if any)</label>
                                        <div class="col-md-9"> 
                                            <select name="disability" id="disability" class="form-control">
                                                <option value="no" @if($student->disability =='no') selected @endif>No</option>
                                                <option value="yes" @if($student->disability =='yes') selected @endif>Yes</option>
                                            </select>
                                            <p class="text-danger disability_e"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <div id="onshore-div">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Over Seas Health Cover</strong></h3>
                            </div>
                            <div class="panel-body">                                                                        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Health Cover</label>
                                            <div class="col-md-10">
                                                <label class="check"><input type="radio" class="iradio"  name="health_type"  value="By Consultancy" @if(isset($student->health->health_type) && $student->health->health_type == 'By Consultancy') checked @endif /> By Consultancy &nbsp;&nbsp;</label>
                                                <label class="check"><input type="radio" class="iradio"  name="health_type"  value="By Student" @if(isset($student->health->health_type) && $student->health->health_type == 'By Student') checked @endif/> By Student &nbsp;&nbsp;</label>
                                                <p class="text-danger health_type_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="col-md-2 control-label">Name of Health Cover</label>
                                            <div class="col-md-4">
                                                <div> 
                                                    <span class="fa fa-pencil form-control-feedback left"></span>
                                                    <input type="text" class="form-control has-feedback-left" name="health_cover_name" id="health_cover_name" placeholder="Name of Health Cover" value="{{$student->health->health_cover_name or ''}}" />
                                                    <p class="text-danger health_cover_name_e"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>          
                                    <div class="col-md-12">      
                                        <div class="form-group has-feedback">
                                            <label class="col-md-2 control-label">Expiry Date</label>
                                            <div class="col-md-4">
                                                <div >
                                                    @php $exp_date = isset($student->health->expiry_date) ? date('d-m-Y',strtotime($student->health->expiry_date)): ''; @endphp
                                                    <span class="fa fa-calendar form-control-feedback left"></span>
                                                    <input type="text" value="{{$exp_date}}" class="form-control has-feedback-left" name="expiry_date" id="expiry_date" readOnly="readOnly" placeholder="Health Cover Expiry Date" />
                                                    <p class="text-danger expiry_date_e"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Student Visa Details</strong></h3>
                            </div>
                            <div class="panel-body">                                                                        

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group has-feedback" style="margin-bottom:15px;">
                                            <label class="col-md-2 control-label">Visa Expiry Date</label>
                                            <div class="col-md-4">
                                                <div class="">
                                                        @php $v_exp_date = isset($student->visa->visa_expiry_date) ? date('d-m-Y',strtotime($student->visa->visa_expiry_date)): ''; @endphp
                                                    <span class="fa fa-calendar form-control-feedback left"></span>
                                                    <input value="{{$v_exp_date}}" type="text" class="form-control has-feedback-left" name="visa_expiry_date" id="visa_expiry_date" readOnly="readOnly" placeholder="Visa Expiry Date" />
                                                    <p class="text-danger visa_expiry_date_e"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>          
                                    <div class="col-md-12">      
                                        <div class="form-group has-feedback" style="margin-bottom:15px;">
                                            <label class="col-md-2 control-label">Visa Grand Date</label>
                                            <div class="col-md-4">
                                                <div class="">
                                                    @php $v_grand_date = isset($student->visa->visa_grand_date) ? date('d-m-Y',strtotime($student->visa->visa_grand_date)): ''; @endphp
                                                    <span class="fa fa-calendar form-control-feedback left"></span>
                                                    <input value="{{$v_grand_date}}" type="text" class="form-control  has-feedback-left" name="visa_grand_date" id="visa_grand_date" readOnly="readOnly" placeholder="Visa Grand Date" />
                                                    <p class="text-danger visa_grand_date_e"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="col-md-2 control-label">Visa Sub Class</label>
                                            <div class="col-md-4">
                                                <div class=""> 
                                                    <span class="fa fa-pencil form-control-feedback left"></span>
                                                    <input type="text" value="{{$student->visa->visa_sub_class or ''}}" class="form-control has-feedback-left" name="visa_sub_class" id="visa_sub_class1" placeholder="Visa Sub Class" />
                                                    <p class="text-danger visa_sub_class_e"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>										
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /onshore-div -->

                    <div class="panel panel-default edu-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Educational</strong> Details </h3>
                        </div>
                        <div class="panel-body panel-body-table">
                            <div class="col-md-12">
                                <div class="alert alert-danger ed-table-error " style="display:none"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive" >
                                    <br>
                                    <table class="table table-bordered table-striped table-actions" id="add_ed_table">
                                        <thead>
                                            <tr>
                                                <th>Course Title</th>
                                                <th>Name of Course</th>
                                                <th>Institution</th>
                                                <th>Country</th>
                                                <th>State</th>
                                                <th>From Year</th>
                                                <th>To Year</th>
                                                <th>Duration</th>
                                                <th>Completed/ Incomplete</th>
                                                <th>No. of Backlogs</th>
                                                <th>Add / Remove Row</th>
                                            </tr>
                                        </thead>
                                        <tbody id="add_ed_table">
                                            @php 
                                                $educations = $student->education;
                                                $educations = count($educations) ? $educations : (object)["NA"];
                                                $i=0;
                                            @endphp
                                            @foreach($educations as $education)
                                            <tr>
                                                <td width="150px">
                                                    @if(isset($education->id) && $education->id) 
                                                    <input type="hidden" name="edu_id[]" value="{{$education->id}}">
                                                    @endif
                                                    <select class="form-control edu_course_title edu_course_title.0" name="edu_course_title[]" id="course_titletest">
                                                        <option value="">Select</option>
                                                        <option value="Certificate III" @if(isset($education->course_title) && $education->course_title == 'Certificate III') selected @endif>Certificate III</option>
                                                        <option value="Certificate IV" @if(isset($education->course_title) && $education->course_title == 'Certificate IV') selected @endif>Certificate IV</option>
                                                        <option value="Diploma" @if(isset($education->course_title) && $education->course_title == 'Diploma') selected @endif>Diploma</option>
                                                        <option value="Bachelors" @if(isset($education->course_title) && $education->course_title == 'Bachelors') selected @endif>Bachelors</option>
                                                        <option value="Graduate Certificate" @if(isset($education->course_title) && $education->course_title == 'Graduate Certificate') selected @endif>Graduate Certificate</option>
                                                        <option value="Graduate Diploma" @if(isset($education->course_title) && $education->course_title == 'Graduate Diploma') selected @endif>Graduate Diploma</option>
                                                        <option value="English" @if(isset($education->course_title) && $education->course_title == 'English') selected @endif>English</option>
                                                        <option value="IELTS" @if(isset($education->course_title) && $education->course_title == 'IELTS') selected @endif>IELTS</option>
                                                        <option value="Masters" @if(isset($education->course_title) && $education->course_title == 'Masters') selected @endif>Masters</option>
                                                    </select>
                                                    <p class="text-danger"></p>
                                                </td>
                                                <td>
                                                    <input value="{{$education->course_name or ''}}" type="text" class="form-control course_name.0" name="course_name[]" id="course_nametest" placeholder="Course Name"/>
                                                    <p class="text-danger"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$education->institution or ''}}" class="form-control institution.0" name="institution[]" id="institutiontest" placeholder="Institution Name"/>
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$education->country or ''}}" class="form-control country_val.0" name="country_val[]" id="country_valtest" placeholder="Country"/>
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$education->state or ''}}" class="form-control country_state.0" name="country_state[]" id="country_statetest" placeholder="State/Country"/>
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    @php $frm = isset($education->course_from)?date('d-m-Y',strtotime($education->course_from)):''; @endphp
                                                    <input style="width:92px;" value="{{$frm}}" type="text" class="form-control year_from.0 from-year" name="year_from[]" id="course_from" readonly placeholder="Start Year"/>
                                                    <p class="text-danger"></p>
                                                </td>
                                                <td>
                                                        @php $to = isset($education->course_to)?date('d-m-Y',strtotime($education->course_to)):''; @endphp
                                                    <input style="width:92px;" value="{{$to}}" type="text" class="form-control year_to.0 to-year" name="year_to[]" id="course_to" readonly placeholder="End Year"/>
                                                    <p class="text-danger"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$education->duration or ''}}" class="form-control duration.0 duration" name="duration[]" id="durationtest" maxlength="1" placeholder="Duration"/>
                                                    <p class="text-danger"></p>
                                                </td>
                                                <td>
                                                    <select  class="form-control status.0" name="status[]" id="statustest">
                                                        <option value="1" @if(isset($education->is_completed) && $education->is_completed=='1' ) selected @endif>Completed</option>
                                                        <option value="0" @if(isset($education->is_completed) && $education->is_completed=='0' ) selected @endif>Incomplete</option>
                                                    </select>
                                                    <p class="text-danger"></p>
                                                    
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$education->backlogs or ''}}" class="form-control backlogs.0 backlogs" name="backlogs[]" id="backlogstest" maxlength="2" placeholder="Backlogs"/>
                                                    <p class="text-danger"></p>
                                                </td>
                                                <td>
                                                    @if($i++ == 0)
                                                        <a href="javascript:void(0);" class="add_ed"><i class="fa fa-plus-square"></i></a>
                                                    @else
                                                        <a href="javascript:void(0);" class="rem_ed"><i class="fa fa-minus-square"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->

                    <div class="panel panel-default p-course-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Preferred</strong> Courses</h3>
                        </div>
                        <div class="panel-body panel-body-table">
                            <div class="col-md-12">
                                <div class="alert alert-danger pc-table-error " style="display:none"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <br>
                                    <table class="table table-bordered table-striped table-actions" id="add_co_table">
                                        <thead>
                                            <tr>
                                                <th>Course Title</th>
                                                <!--<th>Course Code</th>-->
                                                <th>Course Name</th>
                                                <th>Commencement Year</th>
                                                <!-- <th>Semester</th>-->
                                                <!-- <th>Campus Code</th>-->
                                                <th>Add/Remove Row</th>
                                            </tr>
                                        </thead>
                                        <tbody id="add-course">
                                            @php 
                                                $courses = $student->courses;
                                                $courses = count($courses) ? $courses : (object)["NA"];
                                                $j=0;
                                            @endphp
                                            @foreach($courses as $course)
                                            <tr>
                                                <td>
                                                    @if(isset($course->id) && $course->id) 
                                                    <input type="hidden" name="course_id[]" value="{{$course->id}}">
                                                    @endif
                                                    <select class="form-control course-title course_title.0" name="course_title[]" id="course_title1test">
                                                        <option value="">Select</option>
                                                        <option value="Certificate III"  @if($course->course_title == 'Certificate III') selected @endif>Certificate III</option>
                                                        <option value="Certificate IV"  @if($course->course_title == 'Certificate IV') selected @endif>Certificate IV</option>
                                                        <option value="Diploma"  @if($course->course_title == 'Diploma') selected @endif>Diploma</option>
                                                        <option value="Bachelors"  @if($course->course_title == 'Bachelors') selected @endif>Bachelors</option>
                                                        <option value="Graduate Certificate"  @if($course->course_title == 'Graduate Certificate') selected @endif>Graduate Certificate</option>
                                                        <option value="Graduate Diploma"  @if($course->course_title == 'Graduate Diploma') selected @endif>Graduate Diploma</option>
                                                        <option value="English"  @if($course->course_title == 'English') selected @endif>English</option>
                                                        <option value="IELTS"  @if($course->course_title == 'IELTS') selected @endif>IELTS</option>
                                                        <option value="Masters"  @if($course->course_title == 'Masters') selected @endif>Masters</option>
                                                    </select>
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$course->course_name or ''}}" class="form-control precourse.0" name="precourse[]" id="precourse1test" placeholder="Course Name"/>
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    @php 
                                                     $cur = date('Y');  
                                                     $cum_date = (isset($course->commencement_year) && $course->commencement_year) ? date('Y',strtotime($course->commencement_year)) : NULL;
                                                    @endphp
                                                    <select class="form-control select year commencement_year.0" name="commencement_year[]" id="commencement_yeartest">
                                                        @for($i=0;$i<14;$i++)
                                                            <option value="{{$cur+$i}}" @if($cum_date == ($cur+$i)) selected @endif>{{$cur+$i}}</option>
                                                        @endfor
                                                    </select>
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                @if($j++ == 0)
                                                    <a href="javascript:void(0);" class="add_co"><i class="fa fa-plus-square"></i></a>
                                                @else
                                                    <a href="javascript:void(0);" class="rm_co"><i class="fa fa-minus-square"></i></a>
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- /panel -->
                    <div class="panel panel-default eng-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>English Language</strong> Proficiency</h3>
                        </div>
                        <div class="panel-body panel-body-table">
                            <div class="col-md-12">
                                <div class="alert alert-danger en-lang-error" style="display:none"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <br>
                                    <table class="table table-bordered table-striped table-actions" id="ielts">
                                        <thead>
                                            <tr>
                                                <th colspan="6">IELTS</th>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <th>Listening</th>
                                                <th>Reading</th>
                                                <th>Writing</th>
                                                <th>Speaking</th>
                                                <th>Overall</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control select" name="ielts_type" id="ielts_type" >
                                                        <option value="General" @if(isset($student->ielts->ielts_type) && $student->ielts->ielts_type == 'General') selected @endif>General</option>
                                                        <option value="Academic" @if(isset($student->ielts->ielts_type) && $student->ielts->ielts_type == 'Academic') selected @endif>Academic</option>
                                                    </select>
                                                    <p class="text-danger ielts_type_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->ielts->listening or ''}}" class="form-control ielts" name="ielts_listening" id="ielts_listening" maxlength="3" placeholder="Listening Score" />
                                                    <p class="text-danger ielts_listening_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->ielts->reading or ''}}" class="form-control ielts" name="ielts_reading" id="ielts_reading" maxlength="3" placeholder="Reading Score" />
                                                    <p class="text-danger ielts_reading_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->ielts->writing or ''}}" class="form-control ielts" name="ielts_writing" id="ielts_writing" maxlength="3" placeholder="Writing Score" />
                                                    <p class="text-danger ielts_writing_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->ielts->speaking or ''}}" class="form-control ielts" name="ielts_speaking" id="ielts_speaking" maxlength="3" placeholder="Speaking Score" />
                                                    <p class="text-danger ielts_speaking_e"></p>                                                
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->ielts->overall or ''}}" class="form-control" name="ielts_overall" id="ielts_overall" maxlength="3" readOnly="readOnly" style="background-color: #fff;" placeholder="Overall Score"/>
                                                    <p class="text-danger ielts_overall_e"></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                                
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <br>
                                    <table class="table table-bordered table-striped table-actions" id="pte">

                                        <thead>
                                            <tr>
                                                <th colspan="6">PTE</th>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <th>Listening</th>
                                                <th>Reading</th>
                                                <th>Writing</th>
                                                <th>Speaking</th>
                                                <th>Overall</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control select" name="pte_type" id="pte_type">
                                                        <option value="General" @if(isset($student->pte->pte_type) && $student->pte->pte_type == 'General') selected @endif>General</option>
                                                        <option value="Academic" @if(isset($student->pte->pte_type) && $student->pte->pte_type == 'Academic') selected @endif>Academic</option>
                                                    </select>
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->pte->listening or ''}}" class="form-control pte" name="pte_listening" id="pte_listening" maxlength="3" placeholder="Listening Score"/>
                                                    <p class="text-danger pte_listening_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->pte->reading or ''}}" class="form-control pte" name="pte_reading" id="pte_reading" maxlength="3" placeholder="Reading Score"/>
                                                    <p class="text-danger pte_reading_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->pte->writing or ''}}" class="form-control pte" name="pte_writing" id="pte_writing" maxlength="3" placeholder="Writing Score"/>
                                                    <p class="text-danger pte_writing_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->pte->speaking or ''}}" class="form-control pte" name="pte_speaking" id="pte_speaking" maxlength="3" placeholder="Speaking Score"/>
                                                    <p class="text-danger pte_speaking_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$student->pte->overall or ''}}" class="form-control" name="pte_overall" id="pte_overall" maxlength="3" readOnly="readOnly" style="background-color: #fff;" placeholder="Overall Score" />
                                                    <p class="text-danger pte_overall_e"></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                                
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- /panel -->
                    <div class="panel panel-default exp-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Work</strong> Experience</h3>
                        </div>
                        <div class="panel-body panel-body-table">
                                <div class="col-md-12">
                                        <div class="alert alert-danger exp-error" style="display:none"></div>
                                    </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <br>
                                    <table class="table table-bordered table-striped table-actions" id="add_work_table">

                                        <thead>
                                            <tr>
                                                <th>Employer Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Responsibility</th>
                                                <th>Add/Remove Row</th>
                                            </tr>
                                        </thead>
                                        <tbody id="add-work_exp">

                                                @php 
                                                $works = $student->work;
                                                $works = count($works) ? $works : (object)["NA"];
                                                $k=0;
                                            @endphp
                                            @foreach($works as $work)
                                            <tr>
                                                <td>
                                                    @if(isset($work->id) && $work->id) 
                                                    <input type="hidden" name="work_id[]" value="{{$work->id}}">
                                                    @endif
                                                    <input type="text" value="{{$work->employer_name or ''}}" class="form-control employer_name.0" name="employer_name[]" placeholder="Employer's Name" /><p class="text-danger "></p></td>
                                                <td>
                                                    @php $frm_w = (isset($work->work_from)&&$work->work_from)?date('d-m-Y',strtotime($work->work_from)):''; @endphp
                                                    <input type="text" value="{{$frm_w}}" class="form-control exp-from-date from.0" placeholder="From Year" id="work_from" name="from[]" readOnly="readOnly" placeholder="Start Year" />
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    @php $to_w = (isset($work->work_to)&&$work->work_to)?date('d-m-Y',strtotime($work->work_to)):''; @endphp
                                                    <input type="text" value="{{$to_w}}" class="form-control exp-to-date to.0" placeholder="To Year" id="work_to" name="to[]" readOnly="readOnly" placeholder="End Year" />
                                                    <p class="text-danger "></p>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{$work->responsibility or ''}}" class="form-control responsibilty.0" name="responsibilty[]" placeholder="Responsibilty" />
                                                    <p class="text-danger"></p>
                                                </td>
                                                <td>
                                                    @if($k++ == 0)
                                                        <a href="javascript:void(0);" class="add_work"><i class="fa fa-plus-square"></i></a>
                                                    @else
                                                        <a href="javascript:void(0);" class="rm_work"><i class="fa fa-minus-square"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- /panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Funding</strong> Sources </h3>
                        </div>
                        <div class="panel-body">                                                                        
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="background:#f1f5f9;padding:10px;">Private Funding</h6>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Self</label>
                                        <div class="col-md-9"> 
                                            <select class="form-control select" name="funding_self" id="funding_self">
                                                <option value="0" @if(isset($student->funding->self) && $student->funding->self == '0') selected @endif>No</option>
                                                <option value="1" @if(isset($student->funding->self) && $student->funding->self == '1') selected @endif>Yes</option>
                                            </select>
                                            <p class="text-danger funding_self_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Loan</label>
                                        <div class="col-md-9"> 
                                            <select class="form-control select" name="funding_loan" id="funding_loan">
                                                <option value="0" @if(isset($student->funding->loan) && $student->funding->loan == '0') selected @endif>No</option>
                                                <option value="1" @if(isset($student->funding->loan) && $student->funding->loan == '1') selected @endif>Yes</option>
                                            </select>
                                            <p class="text-danger funding_loan_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Family</label>
                                        <div class="col-md-9"> 
                                            <select class="form-control select" name="funding_family" id="funding_family">
                                                <option value="0" @if(isset($student->funding->family) && $student->funding->family == '0') selected @endif>No</option>
                                                <option value="1" @if(isset($student->funding->family) && $student->funding->family == '1') selected @endif>Yes</option>
                                            </select>
                                            <p class="text-danger funding_family_e"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="background:#f1f5f9;padding:10px;">Scholarships</h6>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Government</label>
                                        <div class="col-md-9"> 
                                            <select class="form-control select" name="scholarship_government" id="scholarship_government">
                                                <option value="0" @if(isset($student->funding->government) && $student->funding->government == '0') selected @endif>No</option>
                                                <option value="1" @if(isset($student->funding->government) && $student->funding->government == '1') selected @endif>Yes</option>
                                            </select>
                                            <p class="text-danger scholarship_government_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Private</label>
                                        <div class="col-md-9"> 
                                            <select class="form-control select" name="scholarship_private" id="scholarship_private">
                                                <option value="0" @if(isset($student->funding->private) && $student->funding->private == '0') selected @endif>No</option>
                                                <option value="1" @if(isset($student->funding->private) && $student->funding->private == '1') selected @endif>Yes</option>
                                            </select>
                                            <p class="text-danger scholarship_private_e"></p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Photo</strong></h3>
                        </div>
                        <div class="panel-body">                                                                        

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Photo</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <span class="fa fa-file-image-o form-control-feedback left"></span>
                                                <input type="file" data-url="{{url('common/upload-image')}}" class="fileinput btn-primary has-feedback-left" name="photo" id="photos" title="Upload Photo"/>
                                                <input type="hidden" name="photo_id" disabled>
                                                <p class="text-danger photo_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                    @php 
                                        $img = '/public/images/logos/no-image.png'; 
                                        if($student->photo){
                                            $img = "/storage/app/".$student->photo->full_path;
                                        }
                                    @endphp
                                    <img id="pre-img" src="{{$img}}" alt=" " width="100">
                                    <input type="hidden" name="photo_id" value="{{$student->photo->id or ''}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Documents</strong></h3>
                        </div>
                        <div class="panel-body">                                                                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <p class="text-danger doc_e"></p>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->passport) && $student->docs->passport == '1') checked @endif name="passport">Passport copy
                                                </label>
                                            </div>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->visa) && $student->docs->visa == '1') checked @endif name="visa">Visa copy
                                                </label>
                                            </div>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->overseas_qualification) && $student->docs->overseas_qualification == '1') checked @endif name="overseas_qualification">Overseas qualification
                                                </label>
                                            </div>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->australian_qualification) && $student->docs->australian_qualification == '1') checked @endif name="australian_qualification">Australian qualification
                                                </label>
                                            </div>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->current_transcript) && $student->docs->current_transcript == '1') checked @endif name="current_transcript">Current Transcript
                                                </label>
                                            </div>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->overseas_student_health_cover) && $student->docs->overseas_student_health_cover == '1') checked @endif name="overseas_student_health_cover">Overseas Student Health Cover (OSHC)
                                                </label>
                                            </div>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->current_COE) && $student->docs->current_COE == '1') checked @endif name="current_coe">Current COE
                                                </label>
                                            </div>
                                            <div class="checkbox col-md-6">
                                                <label>
                                                    <input type="checkbox" value ="1" @if(isset($student->docs->IELTS) && $student->docs->IELTS == '1') checked @endif name="ielts">IELTS
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Staff</strong>(Optional)</h3>
                        </div>
                        <div class="panel-body">                                                                        

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Staff</label>
                                        <div class="col-md-9">
                                            @php $staffs = App\Model\Faculty::where('staff_id','!=','admin')->select('id','first_name','staff_id')->get(); @endphp
                                            <select class="form-control select" name="staff" id="staff">
                                                <option value="">Select</option>
                                                @foreach($staffs as $staff)
                                                <option value="{{$staff->id}}" @if($student->staff_assigned_to == $staff->id) selected @endif>{{$staff->first_name.' - '.$staff->staff_id}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger staff_e"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Referred By</strong></h3>
                        </div>
                        <div class="panel-body">                                                                        

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label pull-left">Referred By</label>
                                        <div class="col-md-10 ">
                                            <label class="check col-md-2"><input type="radio" class="iradio refer"  name="referredBy" @if(isset($student->referal->referral_method) && $student->referal->referral_method == 'By Student') checked @endif value="name" /> By Student </label>
                                            <label class="check col-md-3"><input type="radio" class="iradio refer"  name="referredBy" @if(isset($student->referal->referral_method) && $student->referal->referral_method == 'Facebook Page') checked @endif value="facebook" /> Facebook Page </label>
                                            <label class="check col-md-2"><input type="radio" class="iradio refer"  name="referredBy" @if(isset($student->referal->referral_method) && $student->referal->referral_method == 'Website') checked @endif value="website" /> Website </label>
                                            <label class="check col-md-2"><input type="radio" class="iradio refer"  name="referredBy" @if(isset($student->referal->referral_method) && $student->referal->referral_method == 'Others') checked @endif value="others" /> Others </label>
                                            <label class="check col-md-2"><input type="radio" class="iradio refer"  name="referredBy" @if(isset($student->referal->referral_method) && $student->referal->referral_method == 'Magazine') checked @endif value="magazine" /> Magazine                                                    </label>
                                            <!--</a>-->
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-2">
                                            <div id="nameDiv" class="refer-extra">
                                                @php $_students = App\Model\Student::select('id','first_name','username')->get(); @endphp
                                                <select class="form-control select" name="referral_name" id="referral_name">
                                                    <option value="">Select</option>
                                                    @foreach($_students as $_student)
                                                    <option value="{{$_student->id}}" @if(isset($student->referal->ref_student_id) && $student->referal->ref_student_id == $_student->id) selected @endif>{{$_student->fist_name.' '.$_student->username}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger referral_name_e"></p>
                                            </div>
                                            <div id="othersDiv" class="refer-extra">
                                                @php $o_refs = App\Model\StudentOtherReferral::pluck('name','id');@endphp
                                                <select class="form-control select" name="others_referral_name" id="others_referral_name">
                                                    <option value="">Select</option>
                                                    <option value="new" style="color:blue">New</option>
                                                    @foreach($o_refs as $key=>$val)
                                                    <option value="{{$key or ''}}" @if(isset($student->referal->ref_other_id) && $student->referal->ref_other_id == $key) selected @endif>{{$val or ''}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger others_referral_name_e"></p>
                                            </div>
                                            <div id="magazineDiv" class="refer-extra">
                                                <input type="text" class="form-control" name="magazine_name" id="magazine_name"  placeholder="Magazine Name" value="{{$student->referal->magazine_name or ''}}"/>
                                                <p class="text-danger magazine_name_e"></p>
                                            </div>

                                            <div id="facebookDiv" class="refer-extra">
                                                <input type="text" class="form-control" name="facebook_name" id="facebook_name"  placeholder="Facebook Page" value="{{$student->referal->facebook_url or ''}}"/>
                                                <p class="text-danger facebook_name_e"></p>
                                            </div>

                                            <div id="websiteDiv" class="refer-extra">
                                                <input type="text" class="form-control" name="website_name" id="website_name"  placeholder="Website Name" value="{{$student->referal->website_url or ''}}"/>
                                                <p class="text-danger website_name_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-success pull-right" id="student-form-submit">Update</button>
                              <a href="{{url('student')}}"  class="btn btn-danger pull-left student-form-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>                    
    </div>
    <!-- END PAGE CONTENT WRAPPER -->                                                
</div>
<!-- END PAGE CONTENT -->
<div class='modal' id='modal_no_footer' tabindex='-1' role='dialog' aria-labelledby='defModalHead' aria-hidden='true'>
    <div class="modal-dialog">
        <form class="form-horizontal" action="{{url('common/add-referral')}}" method="post" id="new-referral">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="defModalHead">Referral Details</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body">                                                                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="col-md-3 control-label">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="other_referral_name" id="other_referral_name" placeholder="Referral Person Name" /> 
                                            <p class="text-danger other_referral_name_e"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="col-md-3 control-label">E-Mail</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="other_referral_email" id="other_referral_email" placeholder="Referral E-Mail Id" />
                                            <p class="text-danger other_referral_email_e"></p>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="col-md-3 control-label">Phone</label> 
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="other_referral_phone" id="other_referral_phone" placeholder="Referral Phone Number" maxlength="10"/> 
                                            <p class="text-danger other_referral_phone_e"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="col-md-3 control-label">Description</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="Description" /> 
                                            <p class="text-danger desc_e"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>    
<!-- Loading image -->
<div id="loader"></div>
    <!-- END PAGE CONTENT -->
    @endsection
    @push('script')
    <script src="{{asset('public/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('public/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/js/student/edit.js?d='.time())}}"></script>
    <script src="{{asset('public/js/loader.js')}}"></script>
    @endpush
    @push('style')
    <link rel="stylesheet" href="{{asset('public/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/loader.css')}}">
    @endpush