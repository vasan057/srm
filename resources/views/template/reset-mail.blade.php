@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
    <!-- top tiles -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('template/reset-mail')}}" class="form-horizontal" method="post" onsubmit="return updateInvoice(this)">
                    <div class="panel panel-default">
                        <div class="x_title">
                            <div class="col-md-6">
                                <h3>Reset Mail <small>Template</small></h3>
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
                                <!-- form- fields -->
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="subject">Subject *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="subject"  class="form-control" id="subject" value="{{$reset->subject or ''}}" >
                                        <p class="text-danger subject_e"></p>
                                    </div>
                                </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="name">Name *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name"  class="form-control" id="name" value="{{$reset->name or ''}}" >
                                        <p class="text-danger name_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group has-feedback">
                                        @php 
                                            $img = '/public/images/logos/no-image.png'; 
                                            if(isset($reset->photo) && $reset->photo){
                                                $img = "/storage/app/".$reset->photo->full_path;
                                            }
                                        @endphp
                                        <label class="col-md-2 control-label" for="">current Header Image </label>
                                        <div class="col-md-6">
                                            <img src="{{$img}}" alt="" width="150" id="current_img">
                                        </div>
                                    </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="photo_id">New Header Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="logo" id="photo" data-url="{{url('common/upload-image')}}" class="fileinput btn-primary has-feedback-left" >
                                        <span class="fa fa-upload form-control-feedback left" aria-hidden="true"></span>
                                        <input type="hidden" name="photo_id" value="{{$reset->photo_id or ''}}">
                                        <p class="text-danger logo_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="header_text">Header Text *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="header_text"  class="form-control" id="header_text" value="{{$reset->header_text or ''}}" >
                                        <p class="text-danger header_text_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="body">Body *</label>
                                    <div class="col-md-6">
                                        <textarea name="body" id="body" class="body" >{{$reset->body or ''}}</textarea>
                                        <p class="text-danger body_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="signature">Signature *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="signature"  class="form-control" id="signature" value="{{$reset->signature or ''}}" >
                                        <p class="text-danger signature_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="footer_text">Footer Text *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="footer_text"  class="form-control" id="footer_text" value="{{$reset->footer_text or ''}}" >
                                        <p class="text-danger footer_text_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="footer_website_link">Footer Website link *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="footer_website_link"  class="form-control" id="footer_website_link" value="{{$reset->footer_website_link or ''}}" >
                                        <p class="text-danger footer_website_link_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="footer_phone_no">Footer phone no *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="footer_phone_no"  class="form-control" id="footer_phone_no" value="{{$reset->footer_phone_no or ''}}" >
                                        <p class="text-danger footer_phone_no_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="building_no">Building No *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="building_no"  class="form-control" id="building_no" value="{{$reset->building_no or ''}}" >
                                        <p class="text-danger building_no_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="street_name">Street name *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="street_name"  class="form-control" id="street_name" value="{{$reset->street_name or ''}}" >
                                        <p class="text-danger street_name_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="suburb">Suburb *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="suburb"  class="form-control" id="suburb" value="{{$reset->suburb or ''}}" >
                                        <p class="text-danger suburb_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="state">State *</label>
                                    <div class="col-md-6">
                                        <select class="form-control select" name="state" id="state">
                                            <option value="">Select State</option>
                                            @if(isset($reset->state) && $reset->state)
                                            <option value="{{$reset->state}}" selected>{{$reset->state}}</option>
                                            @endif
                                            <option value="Australian Capital Territory">Australian Capital Territory</option>
                                            <option value="New South Wales">New South Wales</option>
                                            <option value="Northern Territory">Northern Territory</option>
                                            <option value="Queensland">Queensland</option>
                                            <option value="South Australia">South Australia</option>
                                            <option value="Tasmania">Tasmania</option>
                                            <option value="Victoria">Victoria</option>
                                            <option value="Western Australia">Western Australia</option>
                                        </select>
                                        <p class="text-danger state_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="post_code">Post code *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="post_code"  class="form-control" id="post_code" value="{{$reset->post_code or ''}}" >
                                        <p class="text-danger post_code_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="country">Country *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="country"  class="form-control" id="country" value="{{$reset->country or ''}}" >
                                        <p class="text-danger country_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                        <button type="submit" class="btn btn-info col-md-offset-2" id="institute-form-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
                <div class="panel panel-default">
                    <div class="x_title">
                        Preview
                    </div>
                    <div class="panel-body">                                                                        
                            
                            <div class="row" id="preview-div">
                                @include('template.preview.reset-mail')
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loader"></div>
@endsection
@push('script')
<script src="{{asset('public/js/template/reset-mail.js?d='.time())}}"></script>
@endpush