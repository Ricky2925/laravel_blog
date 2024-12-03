@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Comment</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                
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

                            <h4 class="card-title">Edit Comment</h4>

                            <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Comment Message -->
                                <div class="row mb-3">
                                    <label for="message" class="col-sm-2 col-form-label">Message</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="message" id="message" rows="5" required>{{ $comment->message }}</textarea>
                                        @error('message')
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
                </div> <!-- end col -->
            </div>
            <!-- end edit form -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@endsection
