@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <ol class="breadcrumb">
  <li><a href="{{url('/')}}">Dashboard</a></li>
  <li class="active">List </li>
</ol>
    <!-- top tiles -->
    <div class="page-content-wrap">
     <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                     <div class="col-md-6">
                        <h2>Counselor Type <small>list</small> </h2>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#create-modal">Add New Type</button>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>SNo.</th>
                          <th>Type Name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      @php $i = 1; @endphp
                        @forelse($types as $type)
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$type->type_name or ''}}</td>
                              <td><a href="javascript://" data-toggle="modal" data-target="#edit-modal" class="btn btn-info" data-value="{{$type->type_name or ''}}" data-url="{{url('faculty-type/'.$type->id)}}">Edit</a></td>
                              <td><a href="{{url('faculty-type/delete/'.$type->id)}}" onclick="return confirm('Please confirm to deletes')" class="btn btn-danger">Delete</a></td>
                          </tr>
                        @empty
                          <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


<!-- END PAGE CONTENT -->

{{--  Modal EDit --}}

<div class="modal fade bs-example-modal-md" id="create-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Add Faculty Type</h4>
      </div>
      <form action="{{url('/faculty-type')}}" class="form-horizontal" id="faculty-type-edit-form">
        <div class="modal-body">
          <div class="form-group">
              <label class="col-md-3 control-label">Faculty type *</label>
              <div class="col-md-9">
                  <div class="input-group"> 
                      <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                      <input type="text" class="form-control" name="type_name" id="type_name" placeholder="Faculty type" />
                  </div>
                  <p class="text-danger type_name_e"></p>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

{{--  Modal EDit --}}

<div class="modal fade bs-example-modal-md" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="Edit-modal-title">Edit Faculty</h4>
      </div>
      <form action="{{url('/faculty-type')}}" class="form-horizontal" id="faculty-type-edit-form">
      {{ method_field('PUT') }}
        <div class="modal-body">
          <div class="form-group">
              <label class="col-md-3 control-label">Faculty type *</label>
              <div class="col-md-9">
                  <div class="input-group"> 
                      <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                      <input type="text" class="form-control" name="type_name" placeholder="Faculty type" />
                  </div>
                  <p class="text-danger type_name_e"></p>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
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