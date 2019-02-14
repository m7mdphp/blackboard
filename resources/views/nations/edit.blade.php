@extends('laraback::layouts.modal')

@section('title', 'تعديل دولة')
@section('content')
    <form method="POST" action="{{ route('nations.edit', $nation->id) }}" novalidate  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
			<div class="form-group">
                <label for="title">اسم الدولة</label>
                <input name="title" id="title" class="form-control" value="{{ $nation->title }}">
			</div>
			
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection