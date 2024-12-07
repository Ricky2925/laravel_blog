@extends('layouts.admin')


@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Post</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                                <li class="breadcrumb-item active">Edit Post</li>
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

                            <h4 class="card-title">Edit Post</h4>
                            <p class="card-title-desc">Update the post details below:</p>

                            <form action="{{ route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- @method('PUT') -->

                                <!-- Title input -->
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" id="title"  required>
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Content Input (CKEditor) -->
                                <div class="row mb-3">
                                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                                    <div class="col-sm-10">
                                        <!-- CKEditor -->
                                        <textarea  class="form-control" name="content" id="content" rows="5" >123</textarea>
                                        @error('content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                              <!-- Image Input -->
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                      

                                        <!-- Upload a new image -->
                                        <input class="form-control" type="file" name="img" id="image">

                                        @error('img')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                </div> 
            </div>
            <!-- end edit form -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>


@endsection