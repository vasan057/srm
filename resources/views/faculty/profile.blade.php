@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
<ol class="breadcrumb">
  <li><a href="{{url('/')}}">Dashboard</a></li>
  <li><a href="{{url('/faculty/editprofile')}}">Edit profile</a></li>
  <li class="active">View </li>
</ol>

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('faculty')}}" id="faculty-form" data-res_url="{{url('/faculty')}}">
                    <div class="panel panel-default">
                        <div class="x_title panel">
                            <div class="col-md-6">
                                 <h4>Profile <small>Details</small></h4>
                            </div>
                          <!--   <div class="col-md-6">
                                <h6 align="right">* Mandatory Fields</h6>
                            </div> -->
                           <div class="clearfix"></div>

                            <!--<h3 class="panel-title"><strong>Counselor</strong> Details</h3>-->
                        </div>
                        <div class="panel-body">                                                                        

                            <div class="row">

                                <div class="col-md-6">

                                   
                                   <form class="form-horizontal">
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">First Name</label>
                <div class="col-sm-5">{{$faculties->first_name ? $faculties->first_name:'-'}}</div>      
                </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">Last Name</label>
                <div class="col-sm-5">{{$faculties->last_name ? $faculties->last_name:'-'}}</div>      
                </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">Email</label>
                <div class="col-sm-5">{{$faculties->email_id ? $faculties->email_id:'-'}}</div>      
                </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">DOB</label>
                <div class="col-sm-5">{{$faculties->dob ? $faculties->dob:'-'}}</div>      
                </div>
                </div>
                 <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">Gender</label>
                <div class="col-sm-5">{{$faculties->gender ? $faculties->gender:'-'}}</div>      
                </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">Blood Group</label>
                <div class="col-sm-5">{{$faculties->blood_group ? $faculties->blood_group:'-'}}</div>      
                </div>
                </div>
                 <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">Address</label>
                <div class="col-sm-5">{{$faculties->address ? $faculties->address:'-'}}</div>      
                </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">Mobile No</label>
                <div class="col-sm-5">{{$faculties->phone ? $faculties->phone:'-'}} </div>      
                </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">e-Name</label>
                <div class="col-sm-5"> {{$faculties->e_name ? $faculties->e_name:'-'}}</div>      
                </div>
                </div>
                  <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">e-Rel</label>
                <div class="col-sm-5"> {{$faculties->e_rel ? $faculties->e_rel:'-'}}</div>      
                </div>
                </div>
                  <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">e-Email</label>
                <div class="col-sm-5"> {{$faculties->e_email ? $faculties->e_email:'-'}}</div>      
                </div>
                </div>
                <div class="box-body">
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2"></div>
                <label class="col-md-3 control-label">e-Phone</label>
                <div class="col-sm-5"> {{$faculties->e_phone ? $faculties->e_phone:'-'}}</div>      
                </div>
                </div>
                 <div class="box-body">
                 <div class="form-group">
                      <div class="col-sm-2 col-sm-offset-4"></div>
                    <div class="col-sm-6"><a  href="{{url('faculty/editprofile')}}", class= 'btn btn-block btn-success' >EDIT PROFILE</a></div>
                    </div>
                  </div>
                </form> 
                                  
                                 
                                    
                                
                              

            </div>
        </div>                    

    </div>
    <!-- END PAGE CONTENT WRAPPER -->                                                
</div>            
<!-- END PAGE CONTENT -->


@endsection
@push('script')
<script src="{{asset('public/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('public/js/faculty/create.js')}}?d={{time()}}"></script>

@endpush
@push('style')
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
@endpush