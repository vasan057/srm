@extends('auth.layouts.app')

@section('content')
<div class="container">
     <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
        <div class="text-center">
            <h2>  <img src="{{asset('public/images/logos/kandel-logo.png')}}" alt="logo"></h2>
        </div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="login-form" action="{{url('/login')}}" method="post" novalidate>
            {{csrf_field()}}
              <div class="form-group">
                <input name="staff_id" type="text" class="form-control" placeholder="Username" required="" />
                <p class=" text-danger text-left staff_id_e"></p>
              </div>
              <div class="form-group">
                <input name="password" class="form-control" type="password" class="form-control" placeholder="Password" required="" />
                <p class=" text-danger text-left password_e"></p>
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass hide" href="#signup">Lost your password?</a>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" action="{{url('password/reset')}}" id="reset-form">
           {{csrf_field()}}
              <div>
                <input type="text" name="reset_email" class="form-control" placeholder="Email" />
                <p class="reset_email_e text-danger"></p>
              </div>
                <button class="btn btn-default submit" type="submit">Reset password</button>
                <a href="#signin" class="to_register"> Log in </a>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
@endsection
@push('script')
<script src="{{asset('public/js/auth/login.js')}}"></script>
@endpush
