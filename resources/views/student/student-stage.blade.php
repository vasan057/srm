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

        <div class="panel panel-default">
               <div class="x_panel">
                  <div class="x_title">
                      <div class="col-md-6">
                    <h3>Student Document Details <small>- {{$student->first_name or ''}} {{$student->last_name or ''}}</small></h3>
                      </div>
                      <div class="col-md-6">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                      </div>
                    <div class="clearfix"></div>
                  </div>
               <!-- Check all checked values and disable based on priority -->
               @php 
                    $is_drown = $student->stage->student_withdrawn ? 'disabled':'';
                    // prev available then main disabled
                    $is_st_en = $student->stage->student_enquired ? 'disabled' : '';
                    $is_do_re = $student->stage->document_received ? 'disabled' : '';
                    $is_aw_pe_do = $student->stage->awaiting_pending_documents ? 'disabled' :'';
                    $is_of_le_ap = $student->stage->offer_letter_applied ? 'disabled' :'';
                    $is_co_of_le_ap = $student->stage->conditional_offer_letter_applied ? 'disabled' : '';
                    $is_fu_of_re = $student->stage->full_offer_received ? 'disabled' : '';
                    $is_co_ap = $student->stage->coe_applied ? 'disabled' : '';
                    $is_co_re = $student->stage->coe_received ? 'disabled' : '';

                    // next available then main disabled
                    $st_en = $student->stage->student_enquired ? '' : 'disabled';
                    $do_re = $student->stage->document_received ? '' : 'disabled';
                    $aw_pe_do = $student->stage->awaiting_pending_documents ? '' :'disabled';
                    $of_le_ap = $student->stage->offer_letter_applied ? '' :'disabled';
                    $co_of_le_ap = $student->stage->conditional_offer_letter_applied ? '' : 'disabled';
                    $fu_of_re = $student->stage->full_offer_received ? '' : 'disabled';
                    $co_ap = $student->stage->coe_applied ? '' : 'disabled';
                    $co_re = $student->stage->coe_received ? '' : 'disabled';
               @endphp
            
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Document Details</th>
                            <th>Check it</th>
                            <th>Comments</th>
                            <!-- <th>View</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr role='row' class='odd'>
                            <td class='sorting_1'>1</td>
                            <td>Student enquired</td>
                            <td>
                                <input type="checkbox" data-type="1" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group chk " name="student_enquired" @if($student->stage->student_enquired) checked @endif {{$is_do_re}} {{$is_drown}}/>
                            </td>
                            <td> 
                                <a class="btn btn-success btn-xs view-details"  data-type="1" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>

                        <tr role='row' class='odd'>
                            <td class='sorting_1'>2</td>
                            <td>Document received</td>
                            <td><input type="checkbox" data-type="2" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group chk1 " name="document_received" @if($student->stage->document_received) checked @endif {{$st_en}} {{$is_aw_pe_do}}/>
                            </td>
                            <td> 
                                <a class="btn btn-success btn-xs view-details" data-type="2" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>

                        <tr role='row' class='odd'>
                            <td class='sorting_1'>3</td>
                            <td>Awaiting pending documents</td>
                            <td><input type="checkbox" data-type="3" data-url="{{url('student/stage/'.$student->id.'/edit')}}"  class="check-doc group chk2 " name="awaiting_pending_documents" @if($student->stage->awaiting_pending_documents) checked @endif {{$is_co_ap}} {{$do_re}} />
                            </td>
                            <td> 
                                <a class="btn btn-success btn-xs view-details" data-type="3" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>
                        <tr role='row' class='odd'>
                            <td class='sorting_1'>4</td>
                            <td>COE applied

                                @forelse($student->suggest as $suggest)
                                <div class="radio">
                                    <label >
                                        <input type="radio" name="suggest_id" value="{{$suggest->id}}" @if($suggest->id == $student->stage->suggest_id) checked @endif>
                                        {{$suggest->institute_name}} - {{$suggest->course_type}} ({{$suggest->course_name}})
                                    </label>
                                </div>
                                @empty
                                <br>
                                <a href="{{url('student/suggest/'.$student->id)}}">Click here</a> to add suggest
                                @endforelse
                               
                               <!--  <select data-token="{{csrf_token()}}" style="width:220px;" data-url="{{url('/student/stage/update-institute/'.$student->id)}}" class="form-control select" id="drop" name="institute_id">
                                    <option>Select</option>
                                    @foreach($student->suggest as $suggest)
                                    <option value="{{$suggest->institute_id or ''}}" @if(isset($student->stage) && $student->stage->institute_id == $suggest->institute_id) selected @endif>{{$suggest->institute_name or ''}}</option>
                                    @endforeach

                                </select> -->

                            </td>
                            <td><input type="checkbox" data-type="7" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group group1" class="group" name="coe_applied" @if($student->stage->coe_applied) checked @endif {{$is_of_le_ap}} {{$aw_pe_do}}/>
                            </td>
                            <td> 
                                <a class="btn btn-success btn-xs view-details" data-type="7" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>
                        <tr role='row' class='odd'>
                            <td class='sorting_1'>5</td>
                            <td>Offer letter applied/application launched</td>
                            <td><input type="checkbox" data-type="4" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group chk3 " name="offer_letter_applied" @if($student->stage->offer_letter_applied) checked @endif {{$co_ap}} {{$is_co_of_le_ap}}/>
                            </td>
                            <td> 
                                <a class="btn btn-success btn-xs view-details" data-type="4" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>
                        <tr role='row' class='odd'>
                            <td class='sorting_1'>6</td>
                            <td>Conditional offer letter received</td>
                            <td><input type="checkbox" data-type="5" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group chk4 " name="conditional_offer_letter_applied" @if($student->stage->conditional_offer_letter_applied) checked @endif  {{$of_le_ap}} {{$is_fu_of_re}}/>
                            </td>
                            <td> 
                                <a class="btn btn-success btn-xs view-details" data-type="5" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>

                        <tr role='row' class='odd'>
                            <td class='sorting_1'>7</td>
                            <td>Full offer received</td>
                            <td><input type="checkbox" data-type="6" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group chk5" name="full_offer_received" @if($student->stage->full_offer_received) checked @endif {{$co_of_le_ap}} {{$is_co_re}}/>
                            </td> 
                            <td> 
                                <a class="btn btn-success btn-xs view-details" data-type="6" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>

                        

                        <tr role='row' class='odd'>
                            <td class='sorting_1'>8</td>
                            <td>COE received</td>
                            <td><input type="checkbox" data-type="8" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group chk6" name="coe_received" @if($student->stage->coe_received) checked @endif {{$fu_of_re}}/>
                            </td>
                            <td> 
                                <a class="btn btn-success btn-xs view-details" data-type="8" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes</a>
                            </td>
                        </tr>

                        <tr role='row' class='odd'>
                            <td class='sorting_1'>9</td>
                            <td>Student withdrawn</td>
                    <input type="hidden" class="chk7">
                    <td><input type="checkbox" data-type="9" data-url="{{url('student/stage/'.$student->id.'/edit')}}" class="check-doc group chk7fff" name="student_withdrawn" @if($student->stage->student_withdrawn) checked disabled @endif  />
                    </td>
                    <td>
                        <a class="btn btn-success btn-xs view-details" data-type="9" data-url="{{url('student/stage/'.$student->id.'/edit')}}">View Notes
                        </a>
                    </td>
                    </tr>


                    </tbody>

                </table>
                &nbsp;&nbsp;&nbsp;

                <div class="form-group">
                    <a href="{{url('student')}}" class="btn btn-primary pull-right">Submit</a>
                </div>
               
            </div>
        </div> 
    </div> 

</div>
<!-- END PAGE CONTENT WRAPPER -->   
<!-- MOdel -->
<div class="modal fade" id="stage-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body" >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="stage-button">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection
@push('script')
<script src="{{asset('public/js/student/student-stage.js?d='.time())}}"></script>
@endpush