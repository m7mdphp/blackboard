@extends('laraback::layouts.modal')

@section('title', 'Edit Blog')
@section('content')
    <form method="POST" action="{{ route('blogs.edit', $blog->id) }}" novalidate>
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" id="name" class="form-control" value="{{ $blog->name }}">
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@yield('title')</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection