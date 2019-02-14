@extends('teacher.auth')

@section('title', 'اعادة تهيئة كلمة المرور')
@section('form')
    <form method="POST" action="{{ route('teacher.password.reset') }}" novalidate>
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">البريد الالكترونى</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">كلمة المرور الجديده</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">تأكيد كلمة المرور الجديده</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">@yield('title')</button>
    </form>
@endsection