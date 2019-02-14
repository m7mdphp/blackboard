@extends('center.modal')
@section('title', 'اضافة طلب')
@section('content')
    <form method="POST" action="{{ route('phds.add') }}" novalidate  enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="title">عنوان الرساله</label>
                <input name="title" id="title" class="form-control">
			</div>
            <div class="form-group">
                <label for="details">تفاصيل الرساله</label>
                <textarea name="details" id="title" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="pages">عدد الصفحات </label>
                <input name="pages" id="pages" class="form-control">
            </div>
            <div class="form-group">
                <label for="alngs">اللغات</label>
                <input name="alngs" id="alngs" class="form-control">
            </div>
            <div class="form-group">
                <label for="notes">ملاحظات</label>
                <textarea name="notes" id="notes" class="form-control"></textarea>
            </div>
			
</div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>طلب</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection