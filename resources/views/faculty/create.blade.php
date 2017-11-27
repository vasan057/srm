@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
<ol class="breadcrumb">
  <li><a href="{{url('/')}}">Dashboard</a></li>
  <li><a href="{{url('/faculty')}}">View Counselor</a></li>
  <li class="active">Create </li>
</ol>

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('faculty')}}" id="faculty-form" data-res_url="{{url('/faculty')}}">
                    <div class="panel panel-default">
                        <div class="x_title panel">
                            <div class="col-md-6">
                                 <h4>Counselor <small>Details</small></h4>
                            </div>
                            <div class="col-md-6">
                                <h6 align="right">* Mandatory Fields</h6>
                            </div>
                           <div class="clearfix"></div>

                            <!--<h3 class="panel-title"><strong>Counselor</strong> Details</h3>-->
                        </div>
                        <div class="panel-body">                                                                        

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Counselor Types *</label>
                                        
                                        <div class="col-md-9">
                                            
                                            <select class="form-control select" name="faculty_type" id="faculty_type">
                                                <option value="">Select</option>
                                                @php $type = App\Model\FacultyType::whereNotIn('id',[1])->pluck('type_name','id'); @endphp
                                                @foreach($type as $key=>$value)
                                                    <option value="{{$key}}">{{ucfirst($value)}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger faculty_type_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">First Name *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" />
                                            </div>
                                            <p class="text-danger first_name_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Middle Name </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle name" />
                                            </div>
                                            <p class="text-danger middle_name_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Last Name *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" />
                                            </div>
                                            <p class="text-danger last_name_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Gender *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <label class="check"><input type="radio" class="iradio"  name="gender" value="male" /> Male &nbsp;&nbsp;</label>
                                                <label class="check"><input type="radio" class="iradio"  name="gender" value="female" /> Female &nbsp;&nbsp;</label>
                                            </div>
                                            <p class="text-danger gender_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email ID *</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                <input type="text" class="form-control" name="email_id" id="email_id" placeholder="E-Mail" />
                                            </div>
                                            <p class="text-danger email_id_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Address *</label>
                                        <div class="col-md-9 col-xs-12">
                                            <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"></textarea>  
                                            <p class="text-danger address_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">                                        
                                        <label class="col-md-3 control-label">DOB *</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                <input type="text" class="form-control datepicker" name="dob" id="dateofbirth" placeholder="DOB" readOnly="readOnly" />                                            
                                            </div>
                                            <p class="text-danger dob_e"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact No. *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" maxlength="10"/>
                                            </div>
                                            <p class="text-danger phone_e"></p>
                                        </div>
                                    </div>
                                     <!-- <div class="col-md-3 col-md-offset-3">
                                        <a id="pre-img" style="display:none" href="javascript://" data-toggle="popover" title="Preview">Preview</a>
                                </div> -->

                                    <div class="form-group">
                                        <div class="col-md-3 col-md-offset-3">
                                            <img  alt="Image" class="thumbnail" width="250">
                                        </div>
                                    </div>
                                 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Photo</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-file-image-o"></span></span>
                                                <input type="file" class="btn-primary" name="photo" title="Upload Photo"  id="photo"/>
                                            </div>
                                            <p class="text-danger photo_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Permission Control</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-cog"></span></span>
                                                <a href='#modal_no_footer' data-toggle='modal' data-target='#modal_no_footer' class='btn btn-primary'>Set Access</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Emergency</strong> Contact</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="e_name" id="e_name" placeholder="Emergency Contact name"/>
                                            </div>
                                            <p class="text-danger e_name_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Relation *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="e_rel" id="e_rel" placeholder="Relation"/>
                                            </div>
                                            <p class="text-danger e_rel_e"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email ID *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                <input type="text" class="form-control" name="e_email" id="e_email" placeholder="Emergency E-Mail" />
                                            </div>
                                            <p class="text-danger e_email_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact No. *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                <input type="text" class="form-control" name="e_phone" id="e_phone" placeholder="Emergency Contact" maxlength="10"/>
                                            </div>
                                            <p class="text-danger e_phone_e"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>   
                          <div class="clearfix"></div>

                        <div class="panel-footer">                                
                            <button type="submit"  class="btn btn-primary pull-right">Submit</button>
                            <a href="{{url('faculty')}}"  class="btn btn-danger pull-right">Cancel</a>
                        </div>
                          <div class="clearfix"></div>

                        <div class='modal' id='modal_no_footer' tabindex='-1' role='dialog' aria-labelledby='defModalHead' aria-hidden='true'>
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="defModalHead">Counselor Access</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal">
                                            <div class="panel panel-default">
                                                <div class="panel-body">     
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>Counselor</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Counselor Register</label>
                                                                    <input value="1" type="checkbox" name="faculty_reg" id="faculty_reg">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Counselor View</label>
                                                                    <input value="1" type="checkbox" name="faculty_view" id="faculty_view">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Counselor Type List</label>
                                                                    <input value="1" type="checkbox" name="faculty_type_list" id="faculty_type_list">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/><br/><br/><br/>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>Student</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Student Register</label>
                                                                    <input value="1" type="checkbox" name="student_reg" id="student_reg" checked="checked">	
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Student View</label>
                                                                    <input value="1" type="checkbox" name="student_view" id="student_view" checked="checked">	
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Student Follow-up</label>
                                                                    <input value="1" type="checkbox" name="student_follow_up" id="student_follow_up" checked="checked">
                                                                </div>
                                                                </br></br></br>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Enquiry</label>
                                                                    <input value="1" type="checkbox" name="student_enquiry" id="student_enquiry" checked="checked">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Referred Commision</label>
                                                                    <input value="1" type="checkbox" name="referral_commision" id="referral_commision" checked="checked">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Bulk Upload</label>
                                                                    <input value="1" type="checkbox" name="student_bulk_upload" id="student_bulk_upload">
                                                                </div>

                                                                <br/><br/><br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/><br/><br/>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>Institution</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Institution Register</label>
                                                                    <input value="1" type="checkbox" name="institution_reg" id="institution_reg">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Institution View</label>
                                                                    <input value="1" type="checkbox" name="institution_view" id="institution_view">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Institution Application Download</label>
                                                                    <input value="1" type="checkbox" name="institution_application_download" id="institution_application_download" checked="checked">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <br/><br/><br/><br/>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>Invoice</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-6 control-label">Invoice List</label>
                                                                    <input value="1" type="checkbox" name="invoice_list" id="invoice_list">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-6 control-label">Archive</label>
                                                                    <input value="1" type="checkbox" name="invoice_archive" id="invoice_archive">
                                                                </div>
                                                                <br/><br/><br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/><br/><br/><br/>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>NewsLetter</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Send News Letter</label>
                                                                    <input value="1" type="checkbox" name="news_letter_send" id="news_letter_send">
                                                                </div>
                                                                <br/><br/><br/><br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/><br/><br/><br/><br/>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>Reports</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Statistical Reports</label>
                                                                    <input value="1" type="checkbox" name="statistical_report" id="statistical_report">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Referred Commision Reports</label>
                                                                    <input value="1" type="checkbox" name="commision_report" id="commision_report">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/><br/><br/><br/>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>Mail Templates</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Reset Password Mail Template</label>
                                                                    <input value="1" type="checkbox" name="forgot_password_mail_template" id="forgot_password_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Counselor Welcome Mail Template</label>
                                                                    <input value="1" type="checkbox" name="welcome_mail_template" id="welcome_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">University Reminder Mail Template</label>
                                                                    <input value="1" type="checkbox" name="university_reminder_mail_template" id="university_reminder_mail_template">
                                                                </div>
                                                                </br></br></br></br>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">LOF Reminder Mail Template</label>
                                                                    <input value="1" type="checkbox" name="lof_reminder_mail_template" id="lof_reminder_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Invoice Reminder Mail Template</label>
                                                                    <input value="1" type="checkbox" name="invoice_reminder_mail_template" id="invoice_reminder_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">News Letter Mail Template</label>
                                                                    <input value="1" type="checkbox" name="news_letter_template" id="news_letter_template">
                                                                    </br></br></br></br>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Invoice Template</label>
                                                                    <input value="1" type="checkbox" name="settings_invoice_settings" id="settings_invoice_settings">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      
                                                    <div class="col-md-12">
                                                        <br/><br/><br/><br/>
                                                        <div class="form-group">
                                                            <h3 class="panel-title"><strong>Settings</strong> Menu</h3>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Change Password</label>
                                                                    <input value="1" type="checkbox" name="settings_change_password" id="settings_change_password">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Add/Remove Countries</label>
                                                                    <input value="1" type="checkbox" name="settings_add_remove_countries" id="settings_add_remove_countries">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Save</button> 
                                    </div>
                                </div>
                            </div>
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