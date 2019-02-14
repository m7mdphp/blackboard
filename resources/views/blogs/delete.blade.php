@extends('laraback::layouts.modal')

@section('title', 'Delete Blogs')
@section('content')
    <div class="modal-body">
        <p>Are you sure you want to delete this blog?</p>
    </div>

    <div class="modal-footer">
        <form method="POST" action="{{ route('blogs.delete', $blog->id) }}" novalidate>
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Yes</button>
        </form>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
@endsection