@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="page-content-wrap">
        <div class="row">
                 <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                     <div class="x_title">
                        <div class="col-md-6">
                           <h2>Institution Course <small>list</small> </h2>
                       </div>
                       
                       <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                      
                       <table id="datatable-fixed-header" class="table table-striped table-bordered">
                         <thead>
                           <tr>
                             <th>Sno.</th>
                             <th>Course name</th>
                             <th>Course type</th>
                             <th>Duration (weeks)</th>
                             <th>Campus</th>
                             <th>Edit</th>
                             <th>Delete</th>
                           </tr>
                         </thead>
                         <tbody>
                         
                         @php $i = 1; @endphp
                           @forelse($courses as $course)
                             <tr>
                                 <td>{{$i++}}</td>
                                 <td>{{$course->course_name or ''}}</td>
                                 <td>{{$course->course_type or ''}}</td>
                                 <td>{{$course->course_duration or 'NA'}}</td>
                                 <td>{{$course->campus or 'NA'}}</td>
                                 <td><a href="{{url('institution-course/'.$course->id.'/edit')}}" class="btn btn-info btn-xs" >Edit</a></td>
                                 <td>
                                    @if($course->course_type != '1')
                                        @if($course->id != Auth::user()->id)
                                        <form action="{{url('institution-course/'.$course->id)}}" method="post" onsubmit="return confirm('Please confirm to deletes')">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                            <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                                        </form>
                                        @endif
                                    @endif
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
$update = session('update') ? 'success':'';
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
