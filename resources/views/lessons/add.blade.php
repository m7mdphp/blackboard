@extends('laraback::layouts.modal')
@section('title', 'اضافة مادة')
@section('content')
    <form method="POST" action="{{ route('lessons.add') }}" novalidate  enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="title">الكلية</label>
                <select  class="form-control" name="college">
                    @foreach($query as $query)
                    <option value="{{$query->id}}" class="form-control">{{$query->title}}</option>
                    @endforeach
                </select>
			</div>
             <div class="form-group">
                <label for="title">المادة</label>
                <input name="title" id="title" class="form-control">
            </div>
			
</div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
@endsection