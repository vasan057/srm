@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<!-- top tiles -->
	<div class="page-content-wrap">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" method="post" id="" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" name="edit_id" value="{{$edit_id}}">
					<div class="panel panel-default">
						<div class="x_title panel">
							<div class="col-md-6">
								<h4>Countries <small>Details</small></h4>
							</div>
							<div class="col-md-6">
								<h6 align="right">* - Mandatory Fields</h6>
							</div>
							<div class="clearfix"></div>
							<!--<h3 class="panel-title"><strong>Counselor</strong> Details</h3>-->
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-3 control-label">Country Code *</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input type="text" class="form-control" name="country_code" id="first_name" placeholder="Country Code" value="{{$fetch_country->country_code}}" />
											</div>
											<p class="text-danger first_name_e"></p>
											{!!$errors->first('country_code','<span class="form-error text-danger">:message</span>')!!}
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Country Name *</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input type="text" class="form-control" name="country_name" placeholder="Country Name" value="{{$fetch_country->country_name}}"/>
											</div>
											<p class="text-danger middle_name_e"></p>
											{!!$errors->first('country_name','<span class="form-error text-danger">:message</span>')!!}
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="col-md-4">
								<button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->
@endsection
@push('script')
<script src="{{asset('public/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('public/js/faculty/create.js')}}?d={{time()}}"></script>
@endpush
@push('style')
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush