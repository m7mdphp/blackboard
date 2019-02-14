@extends('center.modal')
@section('title', 'تعديل طلب')
@section('content')
    <form method="POST" action="{{ route('researches.edit', $researches->id) }}" novalidate  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
			<div class="form-group">
                <label for="title">اسم الدولة</label>
                <input name="title" id="title" class="form-control" value="{{ $researches->title }}">
			</div>
            <div class="form-group">
                <label for="details">تفاصيل البحث</label>
                <textarea name="details" id="details" class="form-control">{{ $researches->details }}</textarea>
            </div>
            <div class="form-group">
                <label for="pages">عدد الصفحات</label>
                <input name="pages" id="pages" class="form-control" value="{{ $researches->pages }}">
            </div>
            <div class="form-group">
                <label for="alngs">اللغات</label>
                <input name="alngs" id="title" class="form-control" value="{{ $researches->alngs }}">
            </div>
            <div class="form-group">
                <label for="notes">ملاحظات</label>
                <textarea name="notes" id="notes" class="form-control">{{ $researches->notes }}</textarea>
            </div>
			
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection