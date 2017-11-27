@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Dashboard</a></li>
      <li><a href="{{url('/student')}}">View Student list</a></li>
      <li class="active">Create </li>
    </ol>
    <!-- top tiles -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="panel panel-default">
                <div class="x_title">
                    <div class="col-md-6">
                        <h3><small>Student Suggest </small> - {{$student->first_name or ''}}</h3>
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
                        <div class="col-md-12 alert alert-danger error-msg" style="display:none"></div>   
                        <div class="col-md-12">
                            @if(count($student->suggest))
                            <h3>Applied Courses</h3>
                            <ul>
                                @foreach($student->suggest as $suggest)
                                <li>University - {{$suggest->institute_name or ''}}, 
                                    Course Title - {{$suggest->course_type or ''}}, 
                                    Course Name - {{$suggest->course_name or ''}}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                       <form action="{{url('student/suggest/'.$student->id)}}" method="get" onsubmit="return validate(this)">
                        @php    
                            $course = App\Model\InstitutionCourse::select('course_type')->where('course_type','!=','')->groupBy('course_type')->get();
                        @endphp
                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword1">Course Title</label>
                            <select name="course_type" id="course_type" class="form-control">
                                <option value="">Select Title</option>
                                @foreach($course as $type)
                                <option value="{{$type->course_type or ''}}">{{$type->course_type or ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="course_name">Course Name</label>
                            <input type="text" name="course_name" class="form-control" id="course_name" placeholder="Course name">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="state">State</label>
                            @php    
                                $states = App\Model\InstitutionCourse::select('state_territory')->where('state_territory','!=','')->groupBy('state_territory')->get();
                            @endphp
                            <select name="state" id="state" class="form-control">
                                <option value="">Select state</option>
                                @foreach($states as $state)
                                <option value="{{$state->state_territory or ''}}">{{$state->state_territory or ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info form-control">Search</button>
                        </div>
                       </form>
                    </div>
                </div>
            </div>

            <!-- List -->
            @if($courses)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">University Suggest</h3>
                </div>
                <div class="panel-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Institution</th>
                                <th>Course Type</th>
                                <th>Course</th>
                                <th>IELTS</th>
                                <th>Intake</th>
                                <th>Duration (Weeks)</th>
                                <!-- <th>status</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td>{{$course->institute->institute_name or ''}}</td>
                                <td>{{$course->course_type or ''}}</td>
                                <td>{{$course->course_name or ''}}</td>
                                <td>{{$course->institute->ielts->overall or ''}}</td>
                                <td>{{$course->institute->intake_month or ''}}</td>
                                <td>{{$course->course_duration or ''}}</td>
                                <!-- <td data-course-id="{{$course->id}}">{{$course->suggest->student_id or ''}},{{$student->id}},{{(isset($course->suggest->id) && $course->suggest->student_id == $student->id)  ? 'applied':'-' }}</td> -->
                                <td>
                                    <!-- @if(!isset($course->suggest->id) || $course->suggest->student_id != $student->id ) -->
                                    <!-- @endif -->
                                    <a class="btn btn-success btn-xs apply-course" data-course="{{$course->id}}" href="{{url('student/suggest/'.$student->id)}}">Apply</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>   
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@php 
    $type = isset($_GET['course_type']) ? $_GET['course_type'] : '';
    $course = isset($_GET['course_name']) ? $_GET['course_name'] : '';
    $state = isset($_GET['state']) ? $_GET['state'] : '';
@endphp
@endsection
@push('script')
<script type="text/javascript">
    $(function(){
        $('#course_type').val("{{$type}}");
        $('#course_name').val("{{$course}}");
        $('#state').val("{{$state}}");
        $('.apply-course').click(function(e){
            e.preventDefault();
            var that = this;
            var course = $(this).attr('data-course');
            var url = $(this).attr('href');
            var csrf = $("meta[name=csrf-token]").attr('content');
            $(that).parent().html('');
            $.post(url,{course:course,_token:csrf}).done(function(data){
                if(data.success) {
                    $("td[data-course-id='"+course+"']").text('applied');
                    new PNotify({
                        title: 'Success!',
                        text: 'The applied is successful.',
                        type: 'success'
                    });
                    window.location.reload();
                }
            });
        });
    });
    function validate(that){
        var data = $(that).serializeArray();
        var count = 0;
        $('.error-msg').hide();
        $.each(data,function(k,v){
            if(v.value != '') count++;
        });
        if(!count){
            console.log('test');
            $('.error-msg').text("Please fill atleast one field").slideDown();
            return false;
        }else{
            $('.error-msg').text("Please fill atleast one field").slideUp();
        }
    }
</script>
@endpush