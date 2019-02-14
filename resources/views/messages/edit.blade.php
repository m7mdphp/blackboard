@extends('center.modal')

@section('title', 'تعديل ملزمه')
@section('content')
    <form method="POST" action="{{ route('documents.edit', $document->id) }}" novalidate  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
			<div class="form-group">
                <label for="university">اسم الجامعة</label>
                <input name="university" id="university" class="form-control" value="{{ $document->university }}">
			</div>
			<div class="form-group">
				<label for="collage">اسم الكلية</label>
                <input name="collage" id="collage" class="form-control" value="{{ $document->collage }}">
			</div>
			<div class="form-group">
				<label for="year">السنة الدراسية</label>
                <input name="year" id="year" class="form-control" value="{{ $document->year }}">
			</div>
			<div class="form-group">
				<label for="subject">اسم المادة</label>
                <input name="subject" id="subject" class="form-control" value="{{ $document->subject }}">
			</div>
			<div class="form-group">
				<label for="diary">الملزمه</label>
                <input type="file" name="diary" id="diary" class="form-control">
								<small id="emailHelp" class="form-text text-muted">لتعديل محتوى الملزمه يرجى اضافة الملزمه الجديده.</small>
			</div>
			<div class="form-group">
				<label for="coast">السعر</label>
				<div class="input-group"> 
<span class="input-group-addon">جنية مصرى</span>
                <input name="coast" id="coast" class="form-control" value="{{ $document->coast }}">
			</div></div>
			<div class="form-group">
				<label for="cover">صورة الغلاف</label>
				<img src="{{ url('') }}/uploads/{{ $document->cover }}" class="img-cover" alt="صورة الغلاف"/>
                <input type="file" name="cover" id="cover" class="form-control" style="width:80%;">
				
				<small id="emailHelp" class="form-text text-muted">لتعديل صورة غلاف الملزمه يرجى اضافة الصورة الاخرى.</small>
            </div>
        </div>
{{$document->center()->first()->name}}
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection