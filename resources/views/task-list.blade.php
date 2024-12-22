@extends('layouts.app')
@section('title','Task List Layout')

@push('styles')
<style>
    .pending-border-left{
        border-left: 3px solid #dc3545;
    }
    .success-border-left{
        border-left: 3px solid #198754;
    }
    .warning-border-left{
        border-left: 3px solid #fd7e14;
    }
    .task-box {
        background: #0a8a1f0f;
        padding: 5px 10px;
    }
    .task-box small {
        font-weight: 500;
        cursor: pointer;
    }
    .task-box p {
        font-size: 13px;
    }
    .image-box img{
        border-radius: 50%;
        border: 2px solid #dddddd;
    }
</style>
@endpush

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="mb-0 card-title">Pending
                        <button type="button" class="border-0 bg-transparent float-end add_task" onclick="showFormModal('New Task','Save',1)" title="Add Task"><i class="fa fa-plus"></i></button>
                    </h6>
                </div>
                <div class="card-body px-1">
                    @forelse ($pendings as $pendingTask)
                    <div class="task-box pending-border-left {{ $loop->first ? '' : 'mt-3' }}">
                        <small class="text-black edit_data" title="Edit Task" data-id="{{ $pendingTask->id }}">{{ $pendingTask->title }}</small>
                        <p class="mb-0"><i class="fa fa-paragraph fa-sm"></i> {{ $pendingTask->description }}</p>
                        {!! PRIORITY_LABEL[$pendingTask->priority] !!}
                        <div class="image-box mt-2">
                            <img src="{{ asset('/') }}img/man.png" width="30px" alt="">
                            <small class="float-end text-danger fw-normal"><i class="fa fa-calendar-alt fa-sm"></i> {{ date('D d M Y') }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="task-box text-center bg-white">
                        <small>- No record found. -</small>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="mb-0 card-title">In Progress
                        <button type="button" class="border-0 bg-transparent float-end add_task" onclick="showFormModal('New Task','Save',2)" title="Add Task"><i class="fa fa-plus"></i></button>
                    </h6>
                </div>
                <div class="card-body">
                    @forelse ($inProgress as $inProgressTask)
                    <div class="task-box warning-border-left {{ $loop->first ? '' : 'mt-3' }}">
                        <small class="text-black edit_data" title="Edit Task" data-id="{{ $inProgressTask->id }}">{{ $inProgressTask->title }}</small>
                        <p class="mb-0"><i class="fa fa-paragraph fa-sm"></i> {{ $inProgressTask->description }}</p>
                        {!! PRIORITY_LABEL[$inProgressTask->priority] !!}
                        <div class="image-box mt-2">
                            <img src="{{ asset('/') }}img/man.png" width="30px" alt="">
                            <small class="float-end text-danger fw-normal"><i class="fa fa-calendar-alt fa-sm"></i> {{ date('D d M Y') }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="task-box text-center bg-white">
                        <small>- No record found. -</small>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-0">
                <div class="card-header bg-white">
                    <h6 class="mb-0 card-title">Completed
                        <button type="button" class="border-0 bg-transparent float-end add_task" onclick="showFormModal('New Task','Save',3)" title="Add Task"><i class="fa fa-plus"></i></button>
                    </h6>
                </div>
                <div class="card-body">
                    @forelse ($completed as $completedTask)
                    <div class="task-box success-border-left {{ $loop->first ? '' : 'mt-3' }}">
                        <small class="text-black edit_data" title="Edit Task" data-id="{{ $completedTask->id }}">{{ $completedTask->title }}</small>
                        <p class="mb-0"><i class="fa fa-paragraph fa-sm"></i> {{ $completedTask->description }}</p>
                        {!! PRIORITY_LABEL[$completedTask->priority] !!}
                        <div class="image-box mt-2">
                            <img src="{{ asset('/') }}img/man.png" width="30px" alt="">
                            <small class="float-end text-danger fw-normal"><i class="fa fa-calendar-alt fa-sm"></i> {{ date('D d M Y') }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="task-box text-center bg-white">
                        <small>- No record found. -</small>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@include('add')
@include('store_or_update_task')

@endSection

@push('scripts')
    <script>
        $("#due_date").flatpickr({
            enableTime: false,
            noCalendar: false,
            time_24hr: false,
        });

        popup_modal = new bootstrap.Modal(document.getElementById('tast_add_modal'),{
            keyboard: false,
            backdrop: 'static'
        });

        update_popup_modal = new bootstrap.Modal(document.getElementById('store_or_update_modal'),{
            keyboard: false,
            backdrop: 'static'
        });

        // show modal
        function showFormModal(modal_title, btn_text, status_id) {
            popup_modal.show();
            $('#tast_add_form')[0].reset();
            $('#tast_add_form #update_id').val('');
            $('#tast_add_form').find('.is-invalid').removeClass('is-invalid');
            $('#tast_add_form').find('.error').remove();
            $('#tast_add_form #status').val(status_id);
            $('#tast_add_modal .modal-title').html(modal_title);
            $('#tast_add_modal #save_btn').html('<span></span> '+btn_text);
        }

        // update or create menu
        $(document).on('click','#save_btn',function(e){
            var form_name = $(this).data('form');
            var formId = form_name == 'update' ? 'store_or_update_form' : 'tast_add_form'
            var form = document.getElementById(formId);
            var formData = new FormData(form);
            $.ajax({
                url: "{{ route('app.tasks.store-or-update.board') }}",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function(){
                    $('#save_btn span').addClass('spinner-border spinner-border-sm text-primary');
                },
                complete: function(){
                    $('#save_btn span').removeClass('spinner-border spinner-border-sm text-primary');
                },
                success: function (data) {
                    $('#'+formId).find('.is-invalid').removeClass('is-invalid');
                    $('#'+formId).find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#'+formId+' #' + key).addClass('is-invalid');
                            $('#'+formId+' #' + key).parent().append(
                                '<small class="error text-danger">' + value + '</small>');
                        });
                    } else {
                        notification(data.status, data.message);
                        if (data.status == 'success') {
                            window.location.reload();
                        }
                    }
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });

        // edit task
        $(document).on('click','.edit_data',function(){
            var id = $(this).data('id');
            $('#store_or_update_form')[0].reset();
            $('#store_or_update_form').find('.is-invalid').removeClass('is-invalid');
            $('#store_or_update_form').find('.error').remove();
            if (id) {
                $.ajax({
                    url: "{{ route('app.tasks.edit') }}",
                    type: "POST",
                    data: {id: id,_token:_token},
                    dataType: "JSON",
                    success: function (data) {
                        $('#store_or_update_modal #save_btn').attr('data-form','update');
                        $('#store_or_update_form #update_id').val(data.data.id);
                        $('#store_or_update_form #title').val(data.data.title);
                        $('#store_or_update_form #description').val(data.data.description);
                        $('#store_or_update_form #priority').val(data.data.priority);
                        $('#store_or_update_form #due_date').val(data.data.due_date);
                        $('#store_or_update_form #status').val(data.data.status);
                        update_popup_modal.show();
                        $('#store_or_update_modal .modal-title').html(
                            '<span>Edit</span>');
                        $('#store_or_update_modal #save_btn').html('<span></span> Update');

                    },
                    error: function (xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
