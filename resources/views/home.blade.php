@extends('layouts.app')
@section('title','Task List')

@push('styles')
@endpush

@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped table-hover mb-0" id="task-datatable">
                    <thead>
                        <th>SL</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endSection

@push('scripts')
    <script>
        var table = new DataTable('#task-datatable', {
            processing: true,
            serverSide: true,
            responsive: true,
            order: [], // Initial no order
            bInfo: true, // Show total number of data
            bFilter: false, // Hide default search box
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100, 200],
                [5, 10, 15, 25, 50, 100, 200]
            ],
            pageLength: 15, // Rows per page
            ajax: {
                url: "{{ route('home') }}",
                type: "GET",
                dataType: "JSON",
                data: function (d) {
                    d._token     = _token;
                    d.start_date = $('input[name="start_date"]').val();
                    d.end_date   = $('input[name="end_date"]').val();
                    d.status     = $('select#status').val();
                    d.priority   = $('select#priority').val();
                },
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'title'},
                {data: 'description'},
                {data: 'priority'},
                {data: 'status'},
                {data: 'due_date'},
                {data: 'created_at'},
                {data: 'action'}
            ],
            language: {
                emptyTable: '<span class="text-danger">No Data Found</span>',
                infoEmpty: '',
                zeroRecords: '<span class="text-danger">No Data Found</span>',
                paginate: {
                    previous: "Previous",
                    next: "Next"
                },
                lengthMenu: `<div class="d-flex align-items-center w-100 justify-content-between">
                        _MENU_
                        <button type="button" class="btn btn-sm btn-danger d-none rounded-0 delete_btn ms-2 px-3" onclick="multi_delete()">Bulk Delete</button>
                    </div>`,
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 text-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 text-end'p>>",
            buttons: [
                {
                    text: '<i class="fas fa-file-download fa-sm"></i> Export',
                    className: 'btn btn-sm btn-info export_btn'
                }
            ]
        });
    </script>
@endpush
