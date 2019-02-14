@extends('laraback::layouts.app')

@section('title', 'Blogs')
@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-auto pr-0">
            <h1 class="display-5">@yield('title')</h1>
        </div>
        <div class="col-md">
            @can('Add Blogs')
                <button type="button" class="btn btn-primary" data-modal="{{ route('blogs.add') }}"><i class="fa fa-plus"></i> Add Blog</button>
            @endcan
        </div>
    </div>

    <table id="blogs_datatable" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Name</th>
            <th class="actions">Actions</th>
        </tr>
        </thead>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#blogs_datatable').DataTable({
                ajax: '{{ route('blogs.datatable') }}',
                columns: [
                    { data: 'name' },
                    {
                        render: function (data, type, full) {
                            var actions = '';

                            if (full.id !== '1') {
                                @can('Edit Blogs')
                                    actions += ' <button type="button" class="btn btn-primary btn-icon" data-modal="{{ route('blogs.edit', ':id') }}" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></button> ';
                                @endcan
                                @can('Delete Blogs')
                                    actions += ' <button type="button" class="btn btn-danger btn-icon" data-modal="{{ route('blogs.delete', ':id') }}" title="Delete"><i class="fa fa-fw fa-trash"></i></button> ';
                                @endcan
                            }

                            return actions.replace(/:id/g, full.id);
                        }
                    }
                ]
            });
        });
    </script>
@endpush