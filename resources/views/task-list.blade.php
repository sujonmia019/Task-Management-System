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
                        <button type="button" class="border-0 bg-transparent float-end" title="Add Task"><i class="fa fa-plus"></i></button>
                    </h6>
                </div>
                <div class="card-body px-1">
                    @forelse ($pendings as $pendingTask)
                    <div class="task-box pending-border-left {{ $loop->first ? '' : 'mt-3' }}">
                        <small class="text-black">{{ $pendingTask->title }}</small>
                        <p class="mb-0"><i class="fa fa-paragraph fa-sm"></i> {{ $pendingTask->description }}</p>
                        <div class="image-box mt-3">
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
                        <button type="button" class="border-0 bg-transparent float-end" title="Add Task"><i class="fa fa-plus"></i></button>
                    </h6>
                </div>
                <div class="card-body">
                    @forelse ($inProgress as $inProgressTask)
                    <div class="task-box warning-border-left {{ $loop->first ? '' : 'mt-3' }}">
                        <small class="text-black">{{ $inProgressTask->title }}</small>
                        <p class="mb-0"><i class="fa fa-paragraph fa-sm"></i> {{ $inProgressTask->description }}</p>
                        <div class="image-box mt-3">
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
                        <button type="button" class="border-0 bg-transparent float-end" title="Add Task"><i class="fa fa-plus"></i></button>
                    </h6>
                </div>
                <div class="card-body">
                    @forelse ($completed as $completedTask)
                    <div class="task-box success-border-left {{ $loop->first ? '' : 'mt-3' }}">
                        <small class="text-black">{{ $completedTask->title }}</small>
                        <p class="mb-0"><i class="fa fa-paragraph fa-sm"></i> {{ $completedTask->description }}</p>
                        <div class="image-box mt-3">
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
@endSection

@push('scripts')

@endpush
