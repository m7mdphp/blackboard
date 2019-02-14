@extends('laraback::layouts.app')

@section('title', 'الدول')
@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-auto pr-0">
            <h1 class="display-5">@yield('title')</h1>
        </div>
        <div class="col-md" style="margin-bottom: 10px;">

                <button type="button" class="btn btn-primary" data-modal="{{ route('nations.add') }}"><i class="fa fa-plus"></i><b>اضافة دولة</b></button>
          
        </div>
    </div>

    <table id="document_datatable" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>اسم الدولة</th>
            <th class="actions">التحكم</th>
        </tr>
        </thead>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#document_datatable').DataTable({
                ajax: '{{ route('nations.datatable') }}',
                columns: [
                    { data: 'title' },
                    {
                        render: function (data, type, full) {
                            var actions = '';

                           
                                    actions += ' <button type="button" class="btn btn-primary btn-icon" data-modal="{{ route('nations.edit', ':id') }}" title="تعديل"><i class="fa fa-fw fa-pencil"></i></button> ';
                           
                                    actions += ' <button type="button" class="btn btn-danger btn-icon" data-modal="{{ route('nations.delete', ':id') }}" title="حذف"><i class="fa fa-fw fa-trash"></i></button> ';
                         

                            return actions.replace(/:id/g, full.id);
                        }
                    }
                ]
            });
        });
    </script>
@endpush