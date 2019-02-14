@extends('laraback::layouts.modal')

@section('title', 'Add Blog')
@section('content')
    <form method="POST" action="{{ route('blogs.add') }}" novalidate>
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" id="name" class="form-control">
            </div>

            
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@yield('title')</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection