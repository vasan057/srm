@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
<ol class="breadcrumb">
      <li><a href="{{url('/')}}">Dashboard</a></li>
      <li><a href="{{url('/institution/create')}}">Create Student</a></li>
      <li class="active">List </li>
    </ol>
    <!-- top tiles -->
    <div class="page-content-wrap">
        <div class="row">
                 <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                     <div class="x_title">
                        <div class="col-md-6">
                           <h2>Institution <small>list</small> </h2>
                       </div>
                      <!--  <div class="col-md-6">
                           <a href="{{url('institution/create')}}" class="btn btn-success btn-xs pull-right">Add new Institute</a>
                       </div> -->
                       <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                      
                       <table id="datatable-fixed-header" class="table table-striped table-bordered">
                         <thead>
                           <tr>
                             <th>Sno.</th>
                             <th>University name</th>
                             <th>Contact No</th>
                             <th>Email ID</th>
                             <th>Course</th>
                             <th>Edit</th>
                             <th>Delete</th>
                           </tr>
                         </thead>
                         <tbody>
                         
                         @php $i = 1; @endphp
                           @forelse($institutes as $institute)
                             <tr>
                                 <td>{{$i++}}</td>
                                 <td>{{$institute->institute_name or ''}}</td>
                                 <td>{{$institute->contact_no or ''}}</td>
                                 <td>{{$institute->email_id or ''}}</td>
                                 <td>
                                    <a href="{{url('institution/'.$institute->id)}}" class="">
                                        <i class="fa fa-book"></i>
                                        <span class="badge bg-green">{{count($institute->course)}}</span>
                                      </a>
                                 </td>
                                 <td><a href="{{url('institution/'.$institute->id.'/edit')}}" class="btn btn-info btn-xs" >Edit</a></td>
                                 <td>
                                    <form action="{{url('institution/'.$institute->id)}}" method="post" onsubmit="return confirm('Please confirm to deletes')">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                                    </form>
                                </td>
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
    <!-- END PAGE CONTENT WRAPPER -->                                                
</div>            
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
    <script type="text/javascript" src="{{('public/js/faculty/faculty-type.js')}}"></script>
@endpush
@push('script')
<script type="text/javascript">
    var res = "{{$response}}";
    var del = "{{$delete}}";
    var update = "{{$update}}";
    if(res){
        new PNotify({
            title: 'Success!',
            text: 'The registration is successful.',
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
