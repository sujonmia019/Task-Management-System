@extends('layouts.app')
@section('title','Task List')

@push('styles')
<style>
    #dt-length-0 {
        border-radius: 0 !important;
    }
    #task-datatable_info {
        font-size: 14px;
    }
</style>
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

@include('store_or_update_task')

@endSection

@push('scripts')
    <script>
        // autoUpdateInput: false,
        // locale: daterangeLocale,
        // linkedCalendars: false,
        // startDate: start,
        // endDate: end,
        // showDropdowns: true,
        // ranges: daterangeConfig

        var popup_modal;
        var table;

        table = new DataTable('#task-datatable', {
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
                url: "{{ route('app.tasks.index') }}",
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
                lengthMenu: `_MENU_`,
            },
            dom: "<'row mb-3'<'col-12'l><'col-12 text-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-3 align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 text-end'p>>",
        });

        // custom field datatable
        $('.dt-length label').append(`
            <div class="d-flex align-items-center">
                <input type="text" id="daterange" class="form-control form-control-sm rounded-0 shadow-none me-2" style="min-width:200px;" placeholder="Due Date">
                <select class="form-control form-control-sm rounded-0 shadow-none" id="filter_status" style="min-width:200px;">
                    <option value="">Select Status</option>
                    @foreach (STATUS as $key=>$value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <select class="form-control form-control-sm rounded-0 shadow-none" id="filter_priority" style="min-width:200px;">
                    <option value="">Select Priority</option>
                    @foreach (PRIORITY as $key=>$value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-sm btn-primary rounded-0 shadow-none" id="filter">Filter</button>
                <button type="button" class="btn btn-sm btn-danger rounded-0 shadow-none mx-2" id="reset">Reset</button>
                <a href="{{ route('app.tasks.list.layout') }}" class="btn btn-sm btn-success rounded-0 shadow-none" id="reset" title="Task Board"><i class="fa fa-list"></i></a>
            </div>
        `);

        $("#due_date").flatpickr({
            enableTime: true,
            noCalendar: false,
            time_24hr: false,
        });

        popup_modal = new bootstrap.Modal(document.getElementById('store_or_update_modal'),{
            keyboard: false,
            backdrop: 'static'
        });

        // show modal
        function showFormModal(modal_title, btn_text) {
            popup_modal.show();
            $('#store_or_update_form')[0].reset();
            $('#store_or_update_form #update_id').val('');
            $('#store_or_update_form').find('.is-invalid').removeClass('is-invalid');
            $('#store_or_update_form').find('.error').remove();
            $('#store_or_update_modal .modal-title').html(modal_title);
            $('#store_or_update_modal #save_btn').html('<span></span> '+btn_text);
        }

        // update or create menu
        $(document).on('click','#save_btn',function(e){
            var form = document.getElementById('store_or_update_form');
            var formData = new FormData(form);
            var method;
            var update_id = $('#update_id').val();
            if(update_id){
                method = 'update';
            }else{
                method = 'add';
            }
            $.ajax({
                url: "{{ route('app.tasks.store-or-update') }}",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function(){
                    $('#save_btn span').addClass('spinner-border spinner-border-sm text-light');
                },
                complete: function(){
                    $('#save_btn span').removeClass('spinner-border spinner-border-sm text-light');
                },
                success: function (data) {
                    $('#store_or_update_form').find('.is-invalid').removeClass('is-invalid');
                    $('#store_or_update_form').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#store_or_update_form #' + key).addClass('is-invalid');
                            $('#store_or_update_form #' + key).parent().append(
                                '<small class="error text-danger">' + value + '</small>');
                        });
                    } else {
                        notification(data.status, data.message);
                        if (data.status == 'success') {
                            if (method == 'update') {
                                table.ajax.reload(null, false);
                            } else {
                                table.ajax.reload();
                            }
                            popup_modal.hide();
                        }
                    }
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });
    </script>
@endpush
