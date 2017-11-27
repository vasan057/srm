@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('institution-course/'.$course->id)}}" data-url="{{URL::previous()}}" method="post" onsubmit="return editCourse(this)">
                    {{method_field('PUT')}}
                    <div class="panel panel-default">
                        <div class="x_title">
                            <div class="col-md-6">
                                <h3>Institution <small>Details</small></h3>
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
                                <!-- column 1 -->
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Degree *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="course_type" value="{{$course->course_type or ''}}" id="course_type" placeholder="Degree" />
                                                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger course_type_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Course Name *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="course_name" value="{{$course->course_name or ''}}" id="course_name" placeholder="Course Name" />
                                                <span class="fa fa-flag-checkered form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger course_name_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Duration *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" maxlength="2" name="course_duration" value="{{$course->course_duration or ''}}" id="course_duration" placeholder="Duration" />
                                                <span class="fa fa-hourglass-start form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger course_duration_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Campus *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="campus" id="campus" value="{{$course->campus or ''}}" placeholder="Campus" />
                                                <span class="fa fa-bell-o form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger campus_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                   
                 
                    <!-- /panel -->
                 
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info pull-right" id="institute-form-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
<!-- Loading image -->
<div id="loader"></div>
    <!-- END PAGE CONTENT -->
@endsection
@php 
$response = session('success') ? 'success':'';
$update = session('update') ? 'success':'';
$delete = session('delete') ? 'delete':'';
@endphp
@push('script')
<script src="{{asset('public/js/institution-course/edit.js?d='.time())}}"></script>
<script src="{{asset('public/js/loader.js')}}"></script>
<script type="text/javascript">
    var res = "{{$response}}";
    var del = "{{$delete}}";
    var update = "{{$update}}";
    if(res){
        new PNotify({
            title: 'Success!',
            text: 'The registration is successful.',
            type: 'success'
        });
    }
    if(del){
        new PNotify({
            title: 'Success!',
            text: 'Deleted successfully',
            type: 'success'
        });
    }
    if(update){
        new PNotify({
            title: 'Success!',
            text: 'updated successfully',
            type: 'success'
        });
    }

 </script>
@endpush
@push('style')
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('public/css/loader.css')}}">
@endpush
