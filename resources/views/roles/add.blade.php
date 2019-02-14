@extends('laraback::layouts.modal')

@section('title', 'Add Role')
@section('content')
    <form method="POST" action="{{ route('roles.add') }}" novalidate>
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <div class="mb-2">
                    <button type="button" class="btn btn-primary btn-sm" data-check-all="permissions[]"><i class="fa fa-check-square"></i> Check All</button>
                    <button type="button" class="btn btn-primary btn-sm" data-uncheck-all="permissions[]"><i class="fa fa-square"></i> Uncheck All</button>
                </div>
                <ul class="list-group list-group-hover">
                    @foreach ($group_permissions as $group => $permissions)
                        <li class="list-group-item">
                            <div class="mt-1 mb-2">{{ $group }}</div>
                            @foreach ($permissions as $permission)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="permissions[]" class="form-check-input" value="{{ $permission->id }}"> {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@yield('title')</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection