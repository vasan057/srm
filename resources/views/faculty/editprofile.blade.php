@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
<ol class="breadcrumb">
  <li><a href="{{url('/')}}">Dashboard</a></li>
  <li><a href="{{url('/faculty/profile')}}">View profile</a></li>
  <li class="active">Edit </li>
</ol>
<form method="post" action="{{url('faculty/editprofile/'.$faculties->id)}}">
    <div class="form-group hidden">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <!--  <input type="hidden" name="_method" value="PATCH"> -->
    </div>
    <div class="form-group ">
        <label for="email" class="control-label"><b>FirstName:</b></label>
        <input type="text" name="first_name" placeholder="Please enter your firstname" class="form-control col-sm-8" value="{{ $faculties->first_name }}"/>

      <!--   <?php if ($errors->has('first_name')) :?>
        <span class="help-block">
            <strong>{{$errors->first('first_name')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
     <div class="form-group ">
        <label for="email" class="control-label"><b>LastName:</b></label>
        <input type="text" name="last_name" placeholder="Please enter your lastname" class="form-control" value="{{$faculties->last_name}}"/>

        <!-- <?php if ($errors->has('last_name')) :?>
        <span class="help-block">{{ $errors->has('last_name') ? ' has-error' : '' }}
            <strong>{{$errors->first('last_name')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
    <div class="form-group">
        <label for="email" class="control-label"><b>Email:</b></label>
        <input type="text" name="email_id" placeholder="Please enter your email here" class="form-control" value="{{$faculties->email_id}}"/>

        <!-- <?php if ($errors->has('email')) :?>
        <span class="help-block">
            <strong>{{$errors->first('email')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
    <div class="form-group">
        <label for="email" class="control-label"><b>DOB:</b></label>
        <input type="text" name="dob" placeholder="Please enter your email here" class="form-control" value="{{$faculties->dob }}"/>

       <!--  <?php if ($errors->has('dob')) :?>
        <span class="help-block">
            <strong>{{$errors->first('dob')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
     <div class="form-group">
        <label for="email" class="control-label"><b>Gender:</b></label>
        <input type="text" name="gender" placeholder="Please enter your gender here" class="form-control" value="{{$faculties->gender}}"/>

        <!-- <?php if ($errors->has('gender')) :?>
        <span class="help-block">
            <strong>{{$errors->first('gender')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
     <div class="form-group">
        <label for="email" class="control-label"><b>Blood Group:</b></label>
        <input type="text" name="blood_group" placeholder="Please enter your blood group here" class="form-control" value="{{$faculties->blood_group }}"/>

        <!-- <?php if ($errors->has('blood_group')) :?>
        <span class="help-block">
            <strong>{{$errors->first('blood_group')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
     <div class="form-group">
        <label for="email" class="control-label"><b>Address:</b></label>
        <input type="text" name="address" placeholder="Please enter your address here" class="form-control" value="{{$faculties->address }}"/>

        <!-- <?php if ($errors->has('address')) :?>
        <span class="help-block">
            <strong>{{$errors->first('address')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
    <div class="form-group">
        <label for="email" class="control-label"><b>MobileNo:</b></label>
        <input type="text" name="phone" placeholder="Please enter your phone no here" class="form-control" value="{{$faculties->phone }}" maxlength='10'/>

       <!--  <?php if ($errors->has('phone')) :?>
        <span class="help-block">
            <strong>{{$errors->first('phone')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
      <div class="form-group">
        <label for="email" class="control-label"><b>e-Name:</b></label>
        <input type="text" name="e_name" placeholder="Please enter your e_name here" class="form-control" value="{{$faculties->e_name }}"/>

       <!--  <?php if ($errors->has('e_name')) :?>
        <span class="help-block">
            <strong>{{$errors->first('e_name')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
    <div class="form-group ">
        <label for="email" class="control-label"><b>e_Rel:</b></label>
        <input type="text" name="e_rel" placeholder="Please enter your e_rel here" class="form-control" value="{{$faculties->e_rel}}"/>
<!-- 
        <?php if ($errors->has('e_rel')) :?>
        <span class="help-block">
            <strong>{{$errors->first('e_rel')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
    <div class="form-group">
        <label for="email" class="control-label"><b>e_Email:</b></label>
        <input type="text" name="e_email" placeholder="Please enter your e_email here" class="form-control" value="{{$faculties->e_email }}"/>

       <!--  <?php if ($errors->has('e_email')) :?>
        <span class="help-block">
            <strong>{{$errors->first('e_email')}}</strong>
        </span>
        <?php endif;?> -->

    </div>
     <div class="form-group">
        <label for="email" class="control-label"><b>e_Phone:</b></label>
        <input type="text" name="e_phone" placeholder="Please enter your e_phone here" class="form-control" value="{{$faculties->e_phone }}" maxlength="10" />

        <!-- <?php if ($errors->has('e_phone')) :?>
        <span class="help-block">
            <strong>{{$errors->first('e_phone')}}</strong>
        </span>
        <?php endif;?> -->

    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default"> Submit </button>
    </div>
</form>
 


@endsection
@push('script')
<script src="{{asset('public/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('public/js/faculty/create.js')}}?d={{time()}}"></script>

@endpush
@push('style')
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
@endpush