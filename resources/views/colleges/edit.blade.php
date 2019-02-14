@extends('laraback::layouts.modal')

@section('title', 'تعديل بيانات كلية')
@section('content')
    <form method="POST" action="{{ route('colleges.edit', $colleges->id) }}" novalidate  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
			<div class="form-group">
                <label for="title">الجامعة</label>
                <select  class="form-control" name="universty">
                @foreach($query as $query)
                    <option value="{{$query->id}}" class="form-control" {{$query->id == $colleges->universty ? 'selected' : '' }}>{{$query->title}}</option>
                    @endforeach
                </select>
			</div>
            <div class="form-group">
                <label for="title">اسم الكلية</label>
                <input name="title" id="title" class="form-control" value="{{ $colleges->title }}">
            </div>
			
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection