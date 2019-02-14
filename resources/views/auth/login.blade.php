@extends('laraback::layouts.auth')

@section('title', 'Login')
@section('form')
    @if (config('laraback.demo'))
        <p class="text-danger"><b>Warning:</b> app is currently in demo mode, some features are disabled.</p>
    @endif

  

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
					  <form role="form" method="POST" action="{{ route('login') }}" novalidate>
        {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input id="email" class="form-control" value="{{ config('laraback.demo') ? 'admin@example.com' : '' }} placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input id="password" class="form-control" value="{{ config('laraback.demo') ? 'admin123' : '' }}" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                               <input type="hidden" name="timezone" id="login_timezone">

        <button type="submit" class="btn btn-primary">@yield('title')</button>
        <a class="btn btn-link" href="{{ route('password.email') }}">Forgot Password</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

    