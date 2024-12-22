@extends('layouts.app')
@section('title','Profile')

@push('styles')
<style>

</style>
@endpush

@section('content')
<div class="container my-4">
    <div class="card rounded-0">
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link rounded-0 border-0 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link rounded-0 border-0" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password" aria-selected="false">Password</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <form id="profile_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0 shadow-none" value="{{ $user->name }}">
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0 shadow-none" value="{{ $user->email }}">
                                </div>
                                <div class="mb-2">
                                    <label for="gender" class="required">Gender</label>
                                    <select" name="gender" id="gender" class="form-control form-control-sm rounded-0 shadow-none">
                                        <option value="">Select Gender</option>
                                        @foreach (GENDER as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">

                </div>
            </div>
        </div>
    </div>
</div>

@endSection

@push('scripts')

@endpush
