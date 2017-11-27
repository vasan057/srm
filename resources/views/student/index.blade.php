@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Dashboard</a></li>
      <li><a href="{{url('/student/create')}}">Create Student</a></li>
      <li class="active">List </li>
    </ol>
<!-- top tiles -->
<div class="page-content-wrap">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <div class="col-md-6">
                  <h3>Student <small>List</small></h3>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
                  <table id="datatable-fixed-header" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>SNo.</th>
                           <th>Student Id</th>
                           <th>Name</th>
                           <th>Contact No</th>
                           <th>Email Id</th>
                           <th>Attended By</th>
                           <th>Fees</th>
                           <th>Suggest</th>
                           <th>Stage</th>
                           <th>Edit</th>
                           <th>Followup</th>
                           <th>Status</th>
                           <th>Delete</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i = 1+(($students->currentPage()-1)*$students->perPage());@endphp
                        @forelse($students as $student)
                        @php $is_withdrawn = (isset($student->stage->student_withdrawn) && $student->stage->student_withdrawn)? true:false; 
                          $is_disable = $is_withdrawn ? 'disabled' : '';
                        @endphp
                        <tr>
                           <td>{{$i++}}</td>
                           <td>{{$student->username}}</td>
                           <td>{{$student->first_name}}</td>
                           <td>{{$student->phone}}</td>
                           <td>{{$student->email_id}}</td>
                           <td>{{$student->assignTo->first_name or ''}} {{$student->assignTo->last_name or ''}}</td>
                           <td><a href="{{url('/student/fees/'.$student->id)}}" class="{{$is_disable or ''}} btn btn-info btn-xs "><i class="fa fa-dollar "></i></a></td>
                           <td><a href="{{url('/student/suggest/'.$student->id)}}" class="{{$is_disable or ''}} btn btn-info btn-xs"><i class="fa fa-mortar-board"></i></a></td>
                           <td><a href="{{url('/student/stage/'.$student->id)}}" class="{{$is_disable or ''}} btn btn-info btn-xs"><i class="fa fa-signal"></i></a></td>
                           <td><a href="{{url('/student/'.$student->id.'/edit')}}" class="{{$is_disable or ''}} btn btn-info btn-xs"><i class="fa fa-pencil"></i></a></td>
                           <td><a data-target="#followup-modal" data-toggle="modal" href="#" data-url="{{url('/student/followup/'.$student->id.'/edit')}}" class="btn btn-info btn-xs {{$is_disable or ''}}"><i class="fa fa-arrows-v"></i></a></td>
                           <td>@if($is_withdrawn) <span class="text-danger">With drown</span> 
                                <a href="{{url('student/back-to-add/'.$student->id)}}">[Back&nbsp;to&nbsp;Add]</a>
                            @else <span class="text-success">active</span> @endif</td>
                           <td><a href="{{url('/student/'.$student->id)}}" onclick="return deleteStudent(this);" class="btn btn-info btn-xs"><i class="fa fa-trash-o"></i></a></td>
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
   <!-- END PAGE CONTENT WRAPPER -->                                                
</div>
<!-- Model block -->
<div class="modal fade" id="followup-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body" id="edit-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save-button">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- End Model block -->
<!-- END PAGE CONTENT -->
@endsection
@php 
$response = session('success') ? 'success':'';
$update = isset($_GET['update']) ? $_GET['update']:'';
$delete = session('delete') ? 'delete':'';
@endphp
@push('style')
<link href="{{asset('/public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('/public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
@endpush
@push('script')
<script src="{{('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('public/js/student/index.js?d='.time())}}"></script>
<script type="text/javascript">
   var res = "{{$response}}";
   var del = "{{$delete}}";
   var update = "{{$update}}";
   if(res){
     console.log(res);
       new PNotify({
           title: 'Success!',
           text: 'The student details submitted is successful.',
           type: 'success'
       });
   }
   if(del){
       new PNotify({
           title: 'Success!',
           text: 'Deleted successfully',
           type: 'success'
       });
   }
   if(update){
       new PNotify({
           title: 'Success!',
           text: 'updated successfully',
           type: 'success'
       });
   }
   
</script>
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
<style>
  #ui-datepicker-div{
    z-index: 1050!important;
  }
</style>
@endpush