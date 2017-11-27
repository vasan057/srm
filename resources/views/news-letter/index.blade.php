@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
<ol class="breadcrumb">
      <li><a href="{{url('/')}}">Dashboard</a></li>
      <li class="active">Details </li>
    </ol>
    <!-- top tiles -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('news-letter')}}" class="form-horizontal" method="post" id="newsletter-form">
                    <div class="panel panel-default">
                        <div class="x_title">
                            <div class="col-md-6">
                                <h3>Newsletter <small>Details</small></h3>
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
                                    <label class="col-md-2 control-label" for="subject">Send to *</label>
                                    <div class="col-md-6">
                                        <input id="send_to" name="email" type="text" class="tags form-control" value="" data-url="{{url('common/auto-contact')}}"  placeholder="Email(s)" />
                                        <p class="text-danger email_e"></p>
                                    </div>
                                </div> <div class="form-group ">
                                    <label class="col-md-2 control-label" for="subject">Subject *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="subject"  class="form-control" id="subject" value="{{$newsletter->subject or ''}}" >
                                        <p class="text-danger subject_e"></p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-2 control-label" for="header_text">Header Text *</label>
                                    <div class="col-md-6">
                                        <input type="text" name="header_text"  class="form-control" id="header_text" value="{{$newsletter->header_text or ''}}" >
                                        <p class="text-danger header_text_e"></p>
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="col-md-2 control-label" for="body">Body *</label>
                                    <div class="col-md-6">
                                        <textarea name="body" id="body" class="body form-control" rows="5">{{$newsletter->body or ''}}</textarea>
                                        <p class="text-danger body_e"></p>
                                    </div>
                                 </div>
                                 
                                 <div class="form-group">
                                        <div class="col-md-6 col-md-offset-2">
                                            <button type="submit" class="btn btn-info " id="institute-form-submit">Submit</button>
                                             <a href="{{url('news-letter')}}"  class="btn btn-danger pull-left">Cancel</a>
                                        </div>
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
                                @include('template.preview.newsletter')
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
<script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/vendors/jquery.tagsinput/src/jquery.tagsinput.js?d='.time())}}"></script>

<script src="{{asset('public/js/newsletter/index.js?d='.time())}}"></script>
@endpush
@push('style')
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/jquery.tagsinput/src/jquery.tagsinput.css?d='.time())}}">
@endpush