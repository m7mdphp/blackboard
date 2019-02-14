@extends('laraback::layouts.modal')
@section('title', 'اضافة دولة')
@section('content')
    <form method="POST" action="{{ route('nations.add') }}" novalidate  enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="title">اسم الدولة</label>
                <input name="title" id="title" class="form-control">
			</div>
			
</div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection