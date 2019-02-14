<!DOCTYPE html>
<html lang="en">
<head>
  <title>الصفحة الرئيسيه</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>لوحة التحكم</h2>
  <div class="col-xs-3">
  <div class="list-group">
    <a href="#" class="list-group-item active">الادارة العامة</a>
         @if(auth()->check())
 <a href="{{ route('index') }}" class="list-group-item">لوحة التحكم</a>
@else
<a href="{{ route('login') }}" class="list-group-item">تسجيل الدخول</a>
@endif
   
  </div>
</div>
 <div class="col-xs-3">
  <div class="list-group">
    <a href="#" class="list-group-item active">المستخدمين</a>
     @if(auth()->guard('student')->check())
 <a href="{{ route('student.index') }}" class="list-group-item">لوحة التحكم</a>
@else
<a href="{{ route('student.login') }}" class="list-group-item">تسجيل الدخول</a>
@endif
  </div>
</div>
 <div class="col-xs-3">
  <div class="list-group">
    <a href="#" class="list-group-item active">المدرسين</a>
         @if(auth()->guard('teacher')->check())
 <a href="{{ route('teacher.index') }}" class="list-group-item">لوحة التحكم</a>
@else
<a href="{{ route('teacher.login') }}" class="list-group-item">تسجيل الدخول</a>
@endif
  </div>
</div>
 <div class="col-xs-3">
  <div class="list-group">
    <a href="#" class="list-group-item active">المراكز</a>
         @if(auth()->guard('center')->check())
 <a href="{{ route('center.index') }}" class="list-group-item">لوحة التحكم</a>
@else
<a href="{{ route('center.login') }}" class="list-group-item">تسجيل الدخول</a>
@endif
  </div>
</div>
</div>

</body>
</html>


