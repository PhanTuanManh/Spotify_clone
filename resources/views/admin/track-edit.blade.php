@extends('layouts.master')

@section('title')
    Dashboard | Song Edition
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Song</h4>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('track.update', ['id' => $track->Track_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $track->Name }}">
                        </div>
                        <div class="form-group mt-4">
                            <label for="thumbnail" class="col-form-label">Thumbnail:</label>
                            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                            @if ($track->Thumbnail)
                                <img src="{{ asset('track_thumbnails/' . $track->Thumbnail) }}" alt="{{ $track->Name }}"
                                    width="100">
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="album_id" class="col-form-label">Album:</label>
                            <select class="form-control" id="album_id" name="album_id">
                                <option value="">Select Album</option>
                                <!-- Thêm option trống để người dùng có thể chọn -->
                                @isset($albums)
                                    @foreach ($albums as $album)
                                        <option value="{{ $album->Album_id }}"
                                            {{ $album->Album_id == $track->Album_id ? 'selected' : '' }}>
                                            {{ $album->Name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!-- Add other track-related fields here -->

                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/track" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
