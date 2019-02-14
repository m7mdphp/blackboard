@extends('center.auth')
@section('title', 'تسجيل دخول لوحة التحكم')
@section('form')

  

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><b>تسجيل دخول لوحة التحكم</b></h3>
                    </div>
                    <div class="panel-body">
					  <form role="form" method="POST" action="{{ route('center.login') }}" novalidate>
        {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input id="email" class="form-control" value="{{ config('laraback.demo') ? 'admin@example.com' : '' }}" placeholder="البريد الالكترونى" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input id="password" class="form-control" value="{{ config('laraback.demo') ? 'admin123' : '' }}" placeholder="كلمة المرور" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me" style="margin-right: -20px;"><b>تذكرنى</b>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                               <input type="hidden" name="timezone" id="login_timezone">

        <button type="submit" class="btn btn-primary"><b>دخول</b></button>
        <a class="btn btn-link" href="{{ route('center.password.email') }}"><b>اعادة تهيئة كلمة المرور</b></a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

    