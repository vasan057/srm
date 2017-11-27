@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <!-- /top tiles -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>STUDENT FOLLOW - UP</h3>
            <p>Student activity</p>
       
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
            <tr>
             <td colspan="12">Data empty</td>
                        </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
     </div>

     <!-- Institute followup -->

     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Institute FOLLOW - UP</h3>
            <p>Institute activity</p>
       
          </div>
          <div class="x_content">
           
            <table id="datatable-ins-followup" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Contact No</th>
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
                @forelse($institutions as $institution)
                <tr>
                  <td>{{$institution->institution->institute_name or ''}}</td>
                  <td>{{$student->institution->institution->contact_no or ''}}</td>
                  <td>-</td>
                  <td>{{$institution->institution->institute_name or ''}}</td>
                  <td>{{$institution->comments or ''}}</td>
                  <td>{{ date('d-m-Y',strtotime($institution->created_at)) }}</td>
                  <th>-</th>
                  <th>-</th>
                  <th>-</th>
                  <th>{{date('d-m-Y',strtotime($institution->remind_time)) }}</th>
                </tr>
                @empty
 <tr>
             <td colspan="12">Data empty</td>
                        </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
     </div>
  </div>
@endsection
@push('script')
<script src="{{('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script type="text/javascript" src="{{('public/js/faculty/faculty-type.js')}}"></script>
<script type="text/javascript">
  $(function(){
    timeClock();
    $('#datatable-followup').dataTable({
       "order": [[ 7, 'asc'],[6,'asc']]
    });
    $('#datatable-ins-followup').dataTable({
       "order": [[ 9, 'asc'],[7,'asc']]
    });
  });
  var strDay = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  var strMonth = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
  function timeClock()
  {
      setTimeout("timeClock()", 1000);        
      now = new Date();
      $('.time-div').text(now.getHours()+" : "+ now.getMinutes());
      $('.day-div').text(strDay[now.getDay()]);
  }

</script>
@endpush
@push('style')
<link href="{{asset('/public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('/public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
@endpush