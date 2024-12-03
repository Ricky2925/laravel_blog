@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Post Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.posts.create')}}">Add Post</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start post list table -->
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
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>PushTime</th>
                                            <th>UpdateTime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>admin</td>
                                                <td>{{$post->published_at}}</td>
                                                <td>{{$post->updated_at}}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm edit-btn" title="Edit" href="{{ route('admin.posts.edit', $post->id) }}">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash"></i> Delete
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
            <!-- end post list table -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@endsection
