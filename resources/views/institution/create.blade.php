@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
<ol class="breadcrumb">
  <li><a href="{{url('/')}}">Dashboard</a></li>
  <li><a href="{{url('/institution')}}">View Institutions</a></li>
  <li class="active">Create </li>
</ol>
    <!-- top tiles -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('institution')}}" method="post" onsubmit="return instituteForm(this)">
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
                                        <label class="col-md-4 control-label">Name *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="name" id="name" placeholder="Institute Name" />
                                                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger name_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">State/Territory *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="state" id="state" placeholder="State/Territory" />
                                                <span class="fa fa-flag-checkered form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger state_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">LOF Duration *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" maxlength="2" name="lof_duration" id="lof_duration" placeholder="LOF Duration" maxlength="3"/>
                                                <span class="fa fa-hourglass-start form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger lof_duration_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">LOF Remind *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="lof_remainer" id="lof_remainer" placeholder="LOF Remind" maxlength="3" />
                                                <span class="fa fa-bell-o form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger lof_remainer_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">COE Duration *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="coe_duration" id="coe_duration" placeholder="COE Duration" maxlength="3"/>
                                                <span class="fa fa-hourglass-start form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger coe_duration_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">COE Remind *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="coe_remainder" id="coe_remainder" placeholder="COE Remind" maxlength="3"/>
                                                <span class="fa fa-bell-o form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger coe_remainder_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Invoice Clearance Days *</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="invoice_date" id="invoice_date" placeholder="Invoice Clearance Days" maxlength="3" />
                                                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger invoice_date_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- column 2 -->
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Invoice Remind *</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="invoice_remainder" id="invoice_remainder" placeholder="Invoice Remind" maxlength="3" />
                                                <span class="fa fa-bell-o form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger invoice_remainder_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Address *</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <textarea name="address" id="address" cols="30" rows="3" class="form-control has-feedback-left"></textarea>
                                                <p class="text-danger address_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Email ID *</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="email" id="email" placeholder="Email Id" />
                                                <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger email_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Website</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="website" id="website" placeholder="Website" />
                                                <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger website_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Contact No. *</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="phone" id="phone" placeholder="Contact" maxlength="10" />
                                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger phone_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="col-md-3 control-label">Fax No</label>
                                        <div class="col-md-9">
                                            <div class=""> 
                                                <input type="text" class="form-control has-feedback-left" name="fax_no" id="fax_no" placeholder="Fax No" maxlength="10" />
                                                <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger fax_no_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Uploads</label>
                                        <div class="col-md-8">
                                            <div class=""> 
                                                <input type="file" data-url="{{url('common/upload-image')}}" class="fileinput btn-primary has-feedback-left" name="photo" id="photo" title="Upload Photo"/>
                                                <span class="fa fa-upload form-control-feedback left" aria-hidden="true"></span>
                                                <input type="hidden" name="photo_id" disabled>
                                                <p class="text-danger photo_e"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <a id="pre-img" style="display:none" href="javascript://" data-toggle="popover" title="Preview">Preview</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- intake month -->
                    <div class="panel panel-default">
                        <div class="panel-heading ui-draggable-handle">
                            <h3 class="panel-title"><strong>Intake</strong> Month</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Select Month *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" size="5" name="intake" id="intake" multiple="" autocomplete="on">
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-success btn-xs" id="add_intake" >>></button><br>
                                    <button type="button" class="btn btn-danger btn-xs" id="delete_intake"  ><<</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Selected Months </label>
                                        <div class="col-md-9">
                                            <select class="form-control" size="5" name="intake_month[]" id="intake_month" multiple="" autocomplete="on">
                                            <option value="October">October</option><option value="September">September</option></select>
                                            <div style="color:#dd0000;display:none" type="hidden" name="intakediv" class="field-required" id="intakediv">Select at least one month</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <!-- ENglish -->
                    <div class="panel panel-default eng-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b>English Language</b> Proficiency (Min. Requirement)</h3>
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
                                                    <input type="text" class="form-control ielts ielts_listening" name="ielts_listening" id="ielts_listening" maxlength="3" placeholder="Listening Score" />
                                                    <p class="text-danger ielts_listening_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control ielts ielts_reading" name="ielts_reading" id="ielts_reading" maxlength="3" placeholder="Reading Score" />
                                                    <p class="text-danger ielts_reading_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text"  class="form-control ielts ielts_writing" name="ielts_writing" id="ielts_writing" maxlength="3" placeholder="Writing Score" />
                                                    <p class="text-danger ielts_writing_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control ielts ielts_speaking" name="ielts_speaking" id="ielts_speaking" maxlength="3" placeholder="Speaking Score" />
                                                    <p class="text-danger ielts_speaking_e"></p>                                                
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control ielts_overall" name="ielts_overall" id="ielts_overall" maxlength="3" readOnly="readOnly" style="background-color: #fff;" placeholder="Overall Score"/>
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
                                                    <input type="text" class="form-control pte pte_listening" name="pte_listening" id="pte_listening" maxlength="3" placeholder="Listening Score"/>
                                                    <p class="text-danger pte_listening_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control pte pte_reading" name="pte_reading" id="pte_reading" maxlength="3" placeholder="Reading Score"/>
                                                    <p class="text-danger pte_reading_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control pte pte_writing" name="pte_writing" id="pte_writing" maxlength="3" placeholder="Writing Score"/>
                                                    <p class="text-danger pte_writing_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control pte pte_speaking" name="pte_speaking" id="pte_speaking" maxlength="3" placeholder="Speaking Score"/>
                                                    <p class="text-danger pte_speaking_e"></p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control pte_overall" name="pte_overall" id="pte_overall" maxlength="3" readOnly="readOnly" style="background-color: #fff;" placeholder="Overall Score" />
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
                    <!-- add course -->
                    <div class="panel panel-default course-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Add</b> Courses</h3>
                        </div>
                        <div class="panel-body panel-body-table">
                            <div class="col-md-12">
                                <div class="alert alert-danger course-error" style="display:none"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Course uploads </label>
                                        <div class="col-md-8">
                                            <div class="" > 
                                                <input type="file" data-url="{{url('common/upload-course')}}" id="course-upload" class="fileinput btn-primary has-feedback-left" name="course" id="course" title="Upload Course"/>
                                                <span class="fa fa-upload form-control-feedback left" aria-hidden="true"></span>
                                                <p class="text-danger course_e"></p>
                                            </div>
                                            <div id="course-div"></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info pull-right" id="institute-form-submit">Submit</button>
                         <a href="{{url('institution')}}"  class="btn btn-danger pull-right">Cancel</a>
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
@push('script')
<script src="{{asset('public/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('public/vendors/jquery.inputmask/dist/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/js/institution/create.js?d='.time())}}"></script>
<script src="{{asset('public/js/loader.js')}}"></script>
@endpush
@push('style')
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('public/css/loader.css')}}">
@endpush