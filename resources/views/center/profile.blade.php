@extends('center.app')

@section('title', 'تعديل الملف الشخصى')
@section('content')
    <h1 class="display-5 mb-4">@yield('title')</h1>

    <form method="POST" action="{{ route('center.profile') }}" novalidate>
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">الاسم بالكامل</label>
            <input name="name" id="name" class="form-control" value="{{ auth()->guard('center')->user()->name }}">
        </div>

        <div class="form-group">
            <label for="email">البريد الالكترونى</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ auth()->guard('center')->user()->email }}">
        </div>



        <button type="submit" class="btn btn-primary">@yield('title')</button>
    </form>
@endsection