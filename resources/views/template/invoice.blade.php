@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
    <!-- top tiles -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('template/invoice')}}" class="form-horizontal" method="post" onsubmit="return updateInvoice(this)">
                    <div class="panel panel-default">
                        <div class="x_title">
                            <div class="col-md-6">
                                <h3>Invoice template <small>Details</small></h3>
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
                                    <label class="col-md-2 control-label" for="invoice_description">Invoice description *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="invoice_description"  class="form-control" id="invoice_description" value="{{$invoice->invoice_description or ''}}" >
                                        <p class="text-danger invoice_description_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="building_no">Building No </label>
                                    <div class="col-md-6">
                                        <input type="text" name="building_no"  class="form-control" id="building_no" value="{{$invoice->building_no or ''}}" >
                                        <p class="text-danger building_no_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="street_name">Street name *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="street_name"  class="form-control" id="street_name" value="{{$invoice->street_name or ''}}" >
                                        <p class="text-danger street_name_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="suburb">Suburb *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="suburb"  class="form-control" id="suburb" value="{{$invoice->suburb or ''}}" >
                                        <p class="text-danger suburb_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="state">State *</label>
                                    <div class="col-md-6">
                                        <select class="form-control select" name="state" id="state">
                                            <option value="">Select State</option>
                                            @if(isset($invoice->state) && $invoice->state)
                                            <option value="{{$invoice->state}}" selected>{{$invoice->state}}</option>
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
                                        <input type="text" name="post_code"  class="form-control" id="post_code" value="{{$invoice->post_code or ''}}" >
                                        <p class="text-danger post_code_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="phone">Phone </label>
                                    <div class="col-md-6">
                                        <input type="text" name="phone"  class="form-control" id="phone" value="{{$invoice->phone or ''}}" >
                                        <p class="text-danger phone_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="fax">Fax </label>
                                    <div class="col-md-6">
                                        <input type="text" name="fax"  class="form-control" id="fax" value="{{$invoice->fax or ''}}" >
                                        <p class="text-danger fax_e"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="website">Website </label>
                                    <div class="col-md-6">
                                        <input type="text" name="website"  class="form-control" id="website" value="{{$invoice->website or ''}}" >
                                        <p class="text-danger website_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="ac_name">Account name *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="ac_name"  class="form-control" id="ac_name" value="{{$invoice->ac_name or ''}}" >
                                        <p class="text-danger ac_name_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="bank_name">Bank name *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="bank_name"  class="form-control" id="bank_name" value="{{$invoice->bank_name or ''}}" >
                                        <p class="text-danger bank_name_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="bsb_name">BSB name *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="bsb_name"  class="form-control" id="bsb_name" value="{{$invoice->bsb_name or ''}}" >
                                        <p class="text-danger bsb_name_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="ac_number">Account number *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="ac_number"  class="form-control" id="ac_number" value="{{$invoice->ac_number or ''}}" >
                                        <p class="text-danger ac_number_e"></p>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    @php 
                                        $img = '/public/images/logos/no-image.png'; 
                                        if(isset($invoice->photo) && $invoice->photo){
                                            $img = "/storage/app/".$invoice->photo->full_path;
                                        }
                                    @endphp
                                    <label class="col-md-2 control-label" for="">Current Logo </label>
                                    <div class="col-md-6">
                                        <img src="{{$img}}" alt="" width="150" id="current_img">
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-md-2 control-label" for="photo">Logo</label>
                                    <div class="col-md-6">
                                        <input type="file" name="logo" id="photo" data-url="{{url('common/upload-image')}}" class="fileinput btn-primary has-feedback-left" >
                                        <span class="fa fa-upload form-control-feedback left" aria-hidden="true"></span>
                                        <input type="hidden" name="photo_id" value="{{$invoice->photo_id or ''}}">
                                        <p class="text-danger logo_e"></p>
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
                                @include('template.preview.invoice')
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
<script src="{{asset('public/js/template/invoice.js?d='.time())}}"></script>
@endpush