@extends('center.app')

@section('title', 'ملازم الطلاب')
@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-auto pr-0">
            <h1 class="display-5">@yield('title')</h1>
        </div>
        <div class="col-md" style="margin-bottom: 10px;">

                <button type="button" class="btn btn-primary" data-modal="{{ route('documents.add') }}"><i class="fa fa-plus"></i><b> اضافة جديده</b></button>
          
        </div>
    </div>

    <table id="document_datatable" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>الجامعة</th>
			<th>الكلية</th>
			<th>السنة الدراسية</th>
            <th class="actions">التحكم</th>
        </tr>
        </thead>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#document_datatable').DataTable({
                ajax: '{{ route('documents.datatable') }}',
                columns: [
                    { data: 'university' },
					{ data: 'collage' },
					{ data: 'year' },
                    {
                        render: function (data, type, full) {
                            var actions = '';

                           
                                    actions += ' <button type="button" class="btn btn-primary btn-icon" data-modal="{{ route('documents.edit', ':id') }}" title="تعديل"><i class="fa fa-fw fa-pencil"></i></button> ';
                           
                                    actions += ' <button type="button" class="btn btn-danger btn-icon" data-modal="{{ route('documents.delete', ':id') }}" title="حذف"><i class="fa fa-fw fa-trash"></i></button> ';
                         

                            return actions.replace(/:id/g, full.id);
                        }
                    }
                ]
            });
        });
    </script>
@endpush