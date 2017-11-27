@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  @if (session('success'))
    <div class="alert alert-success">
     {{ session('success') }}
        </div>
                    @endif
  <!-- top tiles -->
   <div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">{{App\Model\Student::count()}}</div>
                  <h3>Total</h3>
                  <p><a href="{{url('/student')}}">Registered Student</a></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">{{$ins_followups->count()}}</div>
                  <h3>Institution Followup</h3>
                  <p><a href="javascript://" data-id="#institute-list" class="scroll-target">Institution activity</a></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{App\Model\StudentFollowup::where('flag',false)->count()}}</div>
                  <h3>Student Followup</h3>
                  <p><a href="javascript://"  data-id="#student-list" class="scroll-target">Student activity</a></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats"  style="background-color: #285e8e;">
          <div class="icon"><i class="fa fa-check-square-o"></i></div>
          <div class="count time-div">{{date('H : i')}}</div>
          <h3 class="day-div">{{date('l')}}</h3>
          <p class='date-div'>{{date('M d, Y')}}</p>
      </div>
     
      </div>
    </div>
    <!-- Graphical representaion -->
    <div class="row ">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="chart-heading">Weekly Summary </h2>
            <div class="filter">
              <div id="reportrange" class="pull-right" >
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span>October 2, 2017 - October 31, 2017</span> <b class="caret"></b>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content" style="display: block;">

            <div class="row" >
             <div id="chart-graph" style="height:250px"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small>Quick View</small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="">
              <ul class="to_do">
                <li>
                  <p> <a href="javascript://" class="input-href" data-source="student">Registered Students</a> </p>
                </li>
                <li>
                  <p><a href="javascript://" class="input-href" data-source="student-followup">Students Followups</a></p>
                </li>
                <li>
                  <p><a href="javascript://" class="input-href" data-source="institution">Institution</a></p>
                </li>
                <li>
                  <p><a href="javascript://" class="input-href" data-source="instituion-followup">Institution Followups</a></p>
                </li>
                <!-- <li>
                  <p><a href="javascript://" class="input-href" data-source="invoice-followup">Invoice Followups</a></p>
                </li> -->
               
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End graphical representation -->
        <!-- /top tiles -->
    <div class="row panel_div" id="student-list">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="col-md-6">
              <h3>STUDENT FOLLOW - UP</h3>
              <p>Student activity</p>
            </div>
            
            <div class="col-md-6">
              <div class="clearfix">&nbsp;</div>
              <ul class="nav navbar-right panel_toolbox">
                <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
              </ul>
            </div>
       
          </div>
          <div class="x_content">
           
            <table id="datatable-followup" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Course</th>
                  <th>University</th>
                  <th>Status</th>
                  <th>Notes</th>
                  <th>Last Visit</th>
                  <th>Remind Date</th>
                </tr>
              </thead>
              <tbody>
                @forelse($students as $student)
                <tr>
                  <td>{{$student->student->first_name or ''}} {{$student->student->last_name or ''}}</td>
                  <td>{{$student->student->phone or ''}}</td>
                  <td>-</td>
                  <td>-</td>
                  <td>{{$student->comments or ''}}</td>
                  <td>Pending</td>
                  <th>{{date('d-m-Y',strtotime($student->updated_at))}}</th>
                  <th>{{date('d-m-Y',strtotime($student->remind_time))}}</th>
                </tr>
                @empty

                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
     </div>

     <!-- Institute followup -->

     <div class="row panel_div" id="institute-list">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="col-md-6">
              <h3>Institute FOLLOW - UP</h3>
            <p>Institute activity</p>
            </div>
            
            <div class="col-md-6">
              <div class="clearfix">&nbsp;</div>
              <ul class="nav navbar-right panel_toolbox">
                <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
              </ul>
            </div>
       
          </div>
          <div class="x_content">
           
            <table id="datatable-ins-followup" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>University</th>
                  <th>Stage</th>
                  <th>Applied Date</th>
                  <th>COE Receiving Date</th>
                  <th>Delayed Days</th>
                  <th>Action</th>
                  <th>Remind Date</th>
                </tr>
              </thead>
              <tbody>
                @forelse($ins_followups as $ins_followup)
                 @php 
                      $from = Carbon\Carbon::parse($ins_followup->coe_receiving_date);
                      $now = Carbon\Carbon::now();
                    @endphp
                <tr>
                  <td>{{$ins_followup->institution->institute_name or ''}}</td>
                  <td>{{$ins_followup->institution->contact_no or ''}}</td>
                  <td>{{$ins_followup->institution->email_id or ''}}</td>
                  <td>{{$ins_followup->course_name or ''}}</td>
                  <td>{{$ins_followup->institution->institute_name or ''}}</td>
                  <td>{{$ins_followup->comments or ''}}</td>
                  <td>{{ date('d-m-Y',strtotime($ins_followup->created_at)) }}</td>
                  <th>{{$from->format('d-m-Y')}}</th>
                  <td>
                      {{ $from->diffForHumans($now) }}
                  </td>
                  <th><a href="javascript://" data-id="{{$ins_followup->id}}" data-toggle="modal" data-target="#remind-mail" data-ins="{{$ins_followup->institution->institute_name}}" data-email="{{$ins_followup->institution->email_id or ''}}" data-due="{{$from->diffForHumans($now)}}" data-recieving="{{$from->format('d-m-Y')}}"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></th>
                  <th>{{date('d-m-Y',strtotime($ins_followup->remind_time)) }}</th>
                </tr>
                @empty

                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
     </div>
  </div>
  <!-- modal -->
  <!-- Model section -->
<div class="modal fade" id="remind-mail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Remind mail for <span></span> </h4>
        </div>
        <div class="modal-body" id="edit-body">
          @include('template/preview.coe-reminder')
        </div>
        <form action="{{url('institute')}}" method="post">
          {{csrf_field()}}
          <input type="hidden" name="followup_id">
          <input type="hidden" name="email">
          <input type="hidden" name="ins">
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="edit-button">Send Mail</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- Hidden form -->
  <form action="{{url('chart')}}" id="hidden-form">
    {{csrf_field()}}
    <input type="hidden" class="from" name="from" value="10-01-2014">
    <input type="hidden" class="to" name="to" value="{{date('d-m-Y')}}">
    <input type="hidden" class="type" name="type" value="student">
  </form>
@endsection
@push('script')
<script src="{{asset('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('public/vendors/Chart.js/dist/Chart.min.js')}}" type="text/rocketscript"></script>
    <!-- jQuery Sparklines -->
    <script src="{{ asset('public/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}" type="text/rocketscript"></script>
    <!-- Flot -->
    <script src="{{ asset('public/vendors/Flot/jquery.flot.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/vendors/Flot/jquery.flot.time.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/vendors/Flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('public/vendors/flot-spline/js/jquery.flot.spline.min.js')}}" type="text/javascript"></script>
    <!-- DateJS -->
    <script src="{{ asset('public/vendors/DateJS/build/date.js')}}" type="text/javascript"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('public/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{url('public/js/home/index.js?d='.time())}}"></script>
@endpush
@push('style')
<link href="{{asset('/public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<link href="{{asset('/public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
@endpush