@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3>Countries</h3>
          @if(session('success'))
          	<div class="alert alert-success">{{session('success')}}</div>
          @endif
        </div>
        <div class="x_content">
          
           <table id="datatable-fixed-header" class="table table-striped table-bordered">
            <thead>
              <tr>
              	<th>S.no</th>
                <th>country_code</th>
                <th>country_name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($countries as $value)
              <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->country_code}}</td>
                <td>{{$value->country_name}}</td>
                <td> 
                  <a href="{{url('edit-countries').'/'.$value->id}}" data-id = "{{$value->id}}" class="text-muted btn btn-primary edit_country"><i class="fa fa-edit"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
            	<tr>
	                <th>S.no</th>
	                <th>country_code</th>
	                <th>country_name</th>
	                <th>Action</th>
	            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div></div>
  @endsection
@push('style')
<link href="{{asset('/public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('/public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
@endpush
@push('script')
    <script src="{{('public/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
@endpush