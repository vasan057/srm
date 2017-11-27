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
                            <h2>Invoice <small>list</small> </h2>
                        </div>
                        <div class="col-md-6 ">
                            <div class="pull-right">
                                
                            <a href="{{url('invoice/download/'.$invoice->id)}}" class="btn btn-success btn-sm pull-right">Download</a>   <a id="send-invoice" href="javascript://" data-url="{{url('invoice/send/'.$invoice->id)}}" class="btn btn-success btn-sm pull-right">Send Invoice</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    
                        <table id="datatable-fixed-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Student name</th>
                                    <th>Institute name</th>
                                    <th>Course name</th>
                                    <th>From date</th>
                                    <th>To date</th>
                                    <th>Amount</th>
                                    <th>Consultancy %</th>
                                    <th>Sub Total</th>
                                    <th>GST</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @forelse($invoice->selfInstitute as $list)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->student->first_name or ''}} {{$list->student->last_name or ''}}</td>
                                        <td>{{$list->institute->institute_name or ''}}</td>
                                        <td>{{$list->suggest->course_name or ''}}</td>
                                        <td>{{ date('d-m-Y',strtotime($list->from_date))}}</td>
                                        <td>{{ date('d-m-Y',strtotime($list->to_date))}}</td>
                                        <td>{{$list->amount}}</td>
                                        <td>{{$list->consult_percentage}}</td>
                                        <td>{{$list->sub_total}}</td>
                                        <td>{{$list->gst}}</td>
                                        <td>{{$list->grand_total}}</td>
                                        <td><a href="javascript://" data-toggle="modal" data-target="#edit-invoice" data-url="{{url('invoice/'.$list->id.'/edit')}}" class="btn btn-xs btn-info edit-invoice">Edit</a></td>
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
</div>
<!-- Model section -->
<div class="modal fade" id="edit-invoice" tabindex="-1" role="dialog">
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
          <button type="button" class="btn btn-primary" id="edit-button">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection
@php 
    $response = session('success') ? 'success':'';
@endphp
@push('script')
<script src="{{url('public/js/invoice/show.js?d='.time())}}"></script>
<script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
    var res = "{{$response}}";
    if(res){
        new PNotify({
            title: 'Success!',
            text: 'The invoice details submitted is successful.',
            type: 'success'
        });
    }
</script>
@endpush
@push('style')
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
@endpush
