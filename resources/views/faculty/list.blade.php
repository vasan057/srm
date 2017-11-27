@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
 
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="" onsubmit="return faculty_valid();">
                    <div class="panel panel-default">
                        <div class="x_title panel">
                            <div class="col-md-6">
                                 <h4>Counselor <small>Details</small></h4>
                            </div>
                            <div class="col-md-6">
                                <h6 align="right">*Mandatory Fields</h6>
                            </div>
                           <div class="clearfix"></div>

                            <!--<h3 class="panel-title"><strong>Counselor</strong> Details</h3>-->
                        </div>
                        <div class="panel-body">                                                                        

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Counselor Type *</label>
                                        
                                        <div class="col-md-9">
                                            
                                            <select class="form-control select" name="faculty_type" id="faculty_type">
                                                <option value="select">Select</option>
                                                <option id='4' value='Manager'>Manager</option>
                                                <option id='5' value='Front Desk Staff'>Front Desk Staff</option>
                                                <option id='6' value='Student Admission Officer'>Student Admission Officer</option>                                                    </select>
                                            <div style="color:#dd0000;display:none" type="hidden" name="facultydiv" class="field-required" id="facultydiv">Please select Faculty type</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">First Name *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" />
                                            </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="fnamediv" class="field-required" id="fnamediv">First Name cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="fnamediv1" class="field-required" id="fnamediv1">First Name cannot be less than 2 characters</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Middle Name </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Last Name *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" />
                                            </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="lnamediv" class="field-required" id="lnamediv">Last Name cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="lnamediv1" class="field-required" id="lnamediv1">Last Name cannot be less than 2 characters</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Gender *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <label class="check"><input type="radio" class="iradio"  name="gender" id="gender" value="male" /> Male &nbsp;&nbsp;</label>
                                                <label class="check"><input type="radio" class="iradio"  name="gender" id="gender" value="female" /> Female &nbsp;&nbsp;</label>
                                            </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="genderdiv" class="field-required" id="genderdiv">Please select the gender</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email ID *</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                <input type="text" class="form-control" name="email_id" id="email_id" placeholder="E-Mail" />
                                            </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="emaildiv" class="field-required" id="emaildiv">Email cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="emaildiv1" class="field-required" id="emaildiv1">Email not valid</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="emaildiv2" class="field-required" id="emaildiv2">Email already exists</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Address *</label>
                                        <div class="col-md-9 col-xs-12">
                                            <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"></textarea>  
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                            <div style="color:#dd0000;display:none" type="hidden" name="adddiv" class="field-required" id="adddiv">Address cannot be blank</div></div>                                               
                                    </div>
                                    <div class="form-group">                                        
                                        <label class="col-md-3 control-label">DOB *</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                <input type="text" class="form-control datepicker" name="dob" id="dob" placeholder="DOB" readOnly="readOnly" />                                            
                                            </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="dobdiv" class="field-required" id="dobdiv">DOB cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="dobdiv1" class="field-required" id="dobdiv1">Age Should be 18 years and above</div>
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
                                            <div style="color:#dd0000;display:none" type="hidden" name="phonediv" class="field-required" id="phonediv">Phone Number cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="phonediv1" class="field-required" id="phonediv1">Phone Number should be 10 digits</div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="col-md-3 control-label">Blood Group</label>
                                        <div class="col-md-9"> 
                                            <select class="form-control select" name="blood_group" id="blood_group">
                                                <option value="select">Select</option>
                                                <option value="O−ve">O-ve</option>
                                                <option value="O+ve">O+ve</option>
                                                <option value="A−ve">A-ve</option>
                                                <option value="A+ve">A+ve</option>
                                                <option value="B−ve">B-ve</option>
                                                <option value="B+ve">B+ve</option>
                                                <option value="AB−ve">AB-ve</option>
                                                <option value="AB+ve">AB+ve</option>
                                            </select>
                                        </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="blooddiv" class="field-required" id="blooddiv">Please select a blood group</div>                            
                                    </div>-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Photo</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-file-image-o"></span></span>
                                                
                                                <input type="file" class="btn-primary" name="photo" title="Upload Photo"  multiple id="file-simple111"/>
                                            </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="photodiv" class="field-required" id="photodiv">Choose a photo to upload</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="photodiv1" class="field-required" id="photodiv1">Photo format should <i>.jpg</i>, <i>.jpeg</i>, <i>.bmp</i>, <i>.gif</i> or <i>.png</i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Permission Control</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-cog"></span></span>
                                               
                                                &nbsp;<a href='#modal_no_footer' data-toggle='modal' data-target='#modal_no_footer' class='btn btn-primary'>Set Access</a>
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
                                            <div style="color:#dd0000;display:none" type="hidden" name="enamediv" class="field-required" id="enamediv">Name cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="enamediv1" class="field-required" id="enamediv1">Name cannot be less than 3 characters</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Relation *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" class="form-control" name="e_rel" id="e_rel" placeholder="Relation"/>
                                            </div>
                                        </div>
                                        <div style="color:#dd0000;display:none" type="hidden" name="ereldiv" class="field-required" id="ereldiv">Relation cannot be blank</div>
                                        <div style="color:#dd0000;display:none" type="hidden" name="ereldiv1" class="field-required" id="ereldiv1">Relation cannot be less than 3 characters</div>
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
                                            <div style="color:#dd0000;display:none" type="hidden" name="eemaildiv" class="field-required" id="eemaildiv">Email cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="eemaildiv1" class="field-required" id="eemaildiv1">Email not valid</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact No. *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                <input type="text" class="form-control" name="e_phone" id="e_phone" placeholder="Emergency Contact" maxlength="10"/>
                                            </div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="ephonediv" class="field-required" id="ephonediv">Phone Number cannot be blank</div>
                                            <div style="color:#dd0000;display:none" type="hidden" name="ephonediv1" class="field-required" id="ephonediv1">Phone Number should be 10 digits</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>   
                          <div class="clearfix"></div>

                        <div class="panel-footer">                                
                            <input type="submit" value="Submit" class="btn btn-primary pull-right">
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
                                                                    <input type="checkbox" name="faculty_reg" id="faculty_reg">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Counselor View</label>
                                                                    <input type="checkbox" name="faculty_view" id="faculty_view">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Counselor Type List</label>
                                                                    <input type="checkbox" name="faculty_type_list" id="faculty_type_list">
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
                                                                    <input type="checkbox" name="student_reg" id="student_reg" checked="checked">	
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Student View</label>
                                                                    <input type="checkbox" name="student_view" id="student_view" checked="checked">	
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Student Follow-up</label>
                                                                    <input type="checkbox" name="student_follow_up" id="student_follow_up" checked="checked">
                                                                </div>
                                                                </br></br></br>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Enquiry</label>
                                                                    <input type="checkbox" name="student_enquiry" id="student_enquiry" checked="checked">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Referred Commision</label>
                                                                    <input type="checkbox" name="referral_commision" id="referral_commision" checked="checked">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Bulk Upload</label>
                                                                    <input type="checkbox" name="student_bulk_upload" id="student_bulk_upload">
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
                                                                    <input type="checkbox" name="institution_reg" id="institution_reg">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Institution View</label>
                                                                    <input type="checkbox" name="institution_view" id="institution_view">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Institution Application Download</label>
                                                                    <input type="checkbox" name="institution_application_download" id="institution_application_download" checked="checked">
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
                                                                    <input type="checkbox" name="invoice_list" id="invoice_list">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-6 control-label">Archive</label>
                                                                    <input type="checkbox" name="invoice_archive" id="invoice_archive">
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
                                                                    <input type="checkbox" name="news_letter_send" id="news_letter_send">
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
                                                                    <input type="checkbox" name="statistical_report" id="statistical_report">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Referred Commision Reports</label>
                                                                    <input type="checkbox" name="commision_report" id="commision_report">
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
                                                                    <input type="checkbox" name="forgot_password_mail_template" id="forgot_password_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Counselor Welcome Mail Template</label>
                                                                    <input type="checkbox" name="welcome_mail_template" id="welcome_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">University Reminder Mail Template</label>
                                                                    <input type="checkbox" name="university_reminder_mail_template" id="university_reminder_mail_template">
                                                                </div>
                                                                </br></br></br></br>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">LOF Reminder Mail Template</label>
                                                                    <input type="checkbox" name="lof_reminder_mail_template" id="lof_reminder_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Invoice Reminder Mail Template</label>
                                                                    <input type="checkbox" name="invoice_reminder_mail_template" id="invoice_reminder_mail_template">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">News Letter Mail Template</label>
                                                                    <input type="checkbox" name="news_letter_template" id="news_letter_template">
                                                                    </br></br></br></br>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Invoice Template</label>
                                                                    <input type="checkbox" name="settings_invoice_settings" id="settings_invoice_settings">
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
                                                                    <input type="checkbox" name="settings_change_password" id="settings_change_password">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-md-8 control-label">Add/Remove Countries</label>
                                                                    <input type="checkbox" name="settings_add_remove_countries" id="settings_add_remove_countries">
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