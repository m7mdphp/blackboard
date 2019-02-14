@extends('center.modal')

@section('title', 'اضافة ملزمه')
@section('content')
    <form method="POST" action="{{ route('documents.add') }}" novalidate  enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="university">اسم الجامعة</label>
                <input name="university" id="university" class="form-control">
			</div>
			<div class="form-group">
				<label for="collage">اسم الكلية</label>
                <input name="collage" id="collage" class="form-control">
			</div>
			<div class="form-group">
				<label for="year">السنة الدراسية</label>
                <input name="year" id="year" class="form-control">
			</div>
			<div class="form-group">
				<label for="subject">اسم المادة</label>
                <input name="subject" id="subject" class="form-control">
			</div>
			<div class="form-group">
				<label for="diary">الملزمه</label>
                <input type="file" name="diary" id="diary" class="form-control">
			</div>
			<div class="form-group">
				<label for="coast">السعر</label>
				<div class="input-group"> 
<span class="input-group-addon">جنية مصرى</span>
                <input name="coast" id="coast" class="form-control">
			</div></div>
			<div class="form-group">
				<label for="cover">صورة الغلاف</label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>

            
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection