@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start edit form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit User</h4>
                            <p class="card-title-desc">Update the user's details below:</p>

                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Name Input -->
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}"  readonly>
                                    </div>
                                </div>

                                 <!-- password Input -->
                                 <div class="row mb-3">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter new password" >
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Is Admin Checkbox -->
                                <div class="row mb-3">
                                    <label for="is_admin" class="col-sm-2 col-form-label">Is Admin</label>
                                    <div class="col-sm-10">
                                        <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin" {{ $user->is_admin == 1 ? 'checked' : '' }}>
                                    </div>
                                </div>
                               


                                <!-- Submit Button -->
                                <div class="row mb-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end edit form -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@endsection
