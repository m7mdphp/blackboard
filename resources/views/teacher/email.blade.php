@extends('teacher.auth')

@section('title', 'ارسال رابط تهيئة كلمة المرور للبريد الالكترونى')
@section('form')
    <form method="POST" action="{{ route('teacher.password.email') }}" novalidate>
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">البريد الالكترونى</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">@yield('title')</button>
    </form>
@endsection