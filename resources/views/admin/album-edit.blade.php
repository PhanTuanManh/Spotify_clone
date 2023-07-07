@extends('layouts.master')

@section('title')
    Dashboard | Artist Edition
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Edit Album</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('album.update', ['id' => $album->Album_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $album->Name }}">
                        </div>
                        <div class="form-group">
                            <label for="release_date" class="col-form-label">Release Date:</label>
                            <input type="date" class="form-control" id="release_date" name="release_date"
                                value="{{ $album->Release_date }}">
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail:</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                            @if ($album->Thumbnail)
                                <img src="{{ asset('thumbnails/' . $album->Thumbnail) }}" alt="{{ $album->Name }}"
                                    width="100">
                            @endif
                        </div>
                        <!-- ... -->
                        <!-- Add other album-related fields here -->

                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/album" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
