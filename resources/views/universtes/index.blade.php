@extends('laraback::layouts.app')

@section('title', 'الجامعات')
@section('content')
<?php
use App\Nations;
?>
    <div class="row mb-4 align-items-center">
        <div class="col-md-auto pr-0">
            <h1 class="display-5">@yield('title')</h1>
        </div>
        <div class="col-md" style="margin-bottom: 10px;">

                <button type="button" class="btn btn-primary" data-modal="{{ route('universty.add') }}"><i class="fa fa-plus"></i><b>ااضافة جامعة</b></button>
          
        </div>
    </div>

    <table id="document_datatable" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>االدولة</th>
            <th>ااسم الجامعة</th>
            
            <th class="actions">التحكم</th>
        </tr>
        </thead>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#document_datatable').DataTable({
                ajax: '{{ route('universty.datatable') }}',
                columns: [
                    { data: 'nation' },
                    { data: 'title' },
                    {
                        render: function (data, type, full) {
                            var actions = '';

                           
                                    actions += ' <button type="button" class="btn btn-primary btn-icon" data-modal="{{ route('universty.edit', ':id') }}" title="تعديل"><i class="fa fa-fw fa-pencil"></i></button> ';
                           
                                    actions += ' <button type="button" class="btn btn-danger btn-icon" data-modal="{{ route('universty.delete', ':id') }}" title="حذف"><i class="fa fa-fw fa-trash"></i></button> ';
                         

                            return actions.replace(/:id/g, full.id);
                        }
                    }
                ]
            });
        });
    </script>
@endpush