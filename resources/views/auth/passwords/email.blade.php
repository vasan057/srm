@extends('auth.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email_id') ? ' has-error' : '' }}">
                            <label for="email_id" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email_id" type="email" class="form-control" name="email_id" value="{{ old('email_id') }}" required>

                                @if ($errors->has('email_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
