@extends('center.modal')
@section('title', 'تعديل طلب')
@section('content')
    <form method="POST" action="{{ route('phds.edit', $phds->id) }}" novalidate  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
			<div class="form-group">
                <label for="title">عنوان الرساله</label>
                <input name="title" id="title" class="form-control" value="{{ $phds->title }}">
			</div>
            <div class="form-group">
                <label for="details">تفاصيل الرساله</label>
                <textarea name="details" id="details" class="form-control">{{ $phds->details }}</textarea>
            </div>
            <div class="form-group">
                <label for="pages">عدد الصفحات</label>
                <input name="pages" id="pages" class="form-control" value="{{ $phds->pages }}">
            </div>
            <div class="form-group">
                <label for="alngs">اللغات</label>
                <input name="alngs" id="title" class="form-control" value="{{ $phds->alngs }}">
            </div>
            <div class="form-group">
                <label for="notes">ملاحظات</label>
                <textarea name="notes" id="notes" class="form-control">{{ $phds->notes }}</textarea>
            </div>
			
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection