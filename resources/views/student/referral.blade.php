@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Student Referred Commision</h3>
                    </div>
                    <div class="panel-body">  
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-inline" action="{{url('student/search-referral')}}" id="search-form">
                                    {{csrf_field()}}
                                    &nbsp;&nbsp;&nbsp;<div class="radio">
                                        <label>
                                        <input type="radio" name="ref_by" value="ref_student_id"> By Student
                                        </label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;<div class="radio">
                                        <label>
                                        <input type="radio" name="ref_by" value="facebook_url"> facebook Page
                                        </label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;<div class="radio">
                                        <label>
                                        <input type="radio" name="ref_by" value="website_url"> Website
                                        </label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;<div class="radio">
                                        <label>
                                        <input type="radio" name="ref_by" value="ref_other_id"> Others
                                        </label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;<div class="radio">
                                        <label>
                                        <input type="radio" name="ref_by" value="magazine_name"> Magazine
                                        </label>
                                    </div>
                                    <p class="text-danger ref_by_e"></p>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="form-group ref_student_id_div" style="display:none">
                                        <label for="">select student</label>
                                        <select name="name" id="" class="form-control">
                                            <option value="">Select student</option>
                                            @foreach($student as $key=>$val)
                                            <option value="{{$val}}">{{$key}}</option>
                                        @endforeach
                                        </select>
                                        <p class="text-danger name_e"></p>
                                    </div>
                                    <div class="form-group facebook_url_div" style="display:none">
                                        <label for="">select facebook</label>
                                        <select name="name" id="" class="form-control">
                                            <option value="">Select facebook</option>
                                            @foreach($face as $list)
                                                <option value="{{$list}}">{{$list}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger name_e"></p>
                                    </div>
                                    <div class="form-group website_url_div" style="display:none">
                                        <label for="">select website</label>
                                        <select name="name" id="" class="form-control">
                                            <option value="">Select website</option>
                                            @foreach($web as $list)
                                            <option value="{{$list}}">{{$list}}</option>
                                        @endforeach
                                        </select>
                                        <p class="text-danger name_e"></p>
                                    </div>
                                    <div class="form-group ref_other_id_div" style="display:none">
                                        <label for="">select</label>
                                        <select name="name" id="" class="form-control">
                                            <option value="">Select others</option>
                                            @foreach($others as $key=>$val)
                                                <option value="{{$val}}">{{$key}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger name_e"></p>
                                    </div>
                                    <div class="form-group magazine_name_div" style="display:none">
                                        <label for="">select magazine</label>
                                        <select name="name" id="" class="form-control">
                                            <option value="">Select magazine</option>
                                            @foreach($magazine as $list)
                                                <option value="{{$list}}">{{$list}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger name_e"></p>
                                    </div>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <button class="btn btn-info" id="search-btn">Search</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12" id="search-list"> </div>
        </div>
    </div>
</div>

<!-- Model -->
<div class="modal fade" tabindex="-1" role="dialog" id="ref-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Referred Commision Details</h4>
      </div>
      <div class="modal-body" id="form-modal">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="ref-btn">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push('script')
<script type="text/javascript" src="{{asset('public/js/student/referral.js')}}"></script>
@endpush