@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Comment Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                              
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Comment List -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Comments List</h4>

                            <div class="table-responsive">
                                <table class="table table-editable table-nowrap align-middle table-edits">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>message</th>
                                            <th>Author</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td>{{$comment->post->title}} </td>
                                                <td>{{ $comment->message }}</td>
                                                <td>{{ $comment->user->name ?? 'Anonymous' }}</td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.comments.edit', $comment->id) }}">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
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

</div>
@endsection
