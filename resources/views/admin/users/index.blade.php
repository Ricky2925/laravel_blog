@extends('layouts.admin')
@section('content')
<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">User Management</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.users.create')}}">Add User</a></li>
                                            
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Datatable Editable</h4>
        
                                        <div class="table-responsive">
                                            <table class="table table-editable table-nowrap align-middle table-edits">
                                                <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                        {{ $user->is_admin == 1 ? 'Admin' : 'User' }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm edit-btn" title="Edit" href="{{ route('admin.users.edit', $user->id) }}">
                                                                <i class="fas fa-pencil-alt"></i> Edit
                                                            </a>
                                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">
                                                                    <i class="fas fa-trash-alt"></i> Delete
                                                                </button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                
@endsection
