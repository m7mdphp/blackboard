@extends('laraback::layouts.modal')

@section('title', 'تعديل بيانات جامعة')
@section('content')
    <form method="POST" action="{{ route('universty.edit', $universtes->id) }}" novalidate  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
			<div class="form-group">
                <label for="title">دولة الجامعة</label>
                <select  class="form-control" name="nation">
                @foreach($query as $query)
                    <option value="{{$query->id}}" class="form-control" {{$query->id == $universtes->nation ? 'selected' : '' }}>{{$query->title}}</option>
                    @endforeach
                </select>
			</div>
            <div class="form-group">
                <label for="title">اسم الجامعة</label>
                <input name="title" id="title" class="form-control" value="{{ $universtes->title }}">
            </div>
			
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection