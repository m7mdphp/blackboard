@extends('student.app')

@section('title', 'تغيير كلمة المرور')
@section('content')
    <h1 class="display-5 mb-4">@yield('title')</h1>

    <form method="POST" action="{{ route('student.password.change') }}" novalidate>
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="current_password">كلمة المرور الحالية</label>
            <input type="password" name="current_password" id="current_password" class="form-control">
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