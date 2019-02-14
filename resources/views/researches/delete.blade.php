@extends('center.modal')

@section('title', 'الابحاث العلمية')
@section('content')
    <div class="modal-body">
        <p>تأكيد الحذف</p>
    </div>

    <div class="modal-footer">
        <form method="POST" action="{{ route('researches.delete', $researches->id) }}" novalidate>
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" style="float:right;">نعم</button>
        </form>

        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float:right; margin-right:15px;">لا</button>
    </div>
@endsection