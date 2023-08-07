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
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail:</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                            @if ($track->Thumbnail)
                                <img src="{{ asset('track_thumbnails/' . $track->Thumbnail) }}" alt="{{ $track->Name }}"
                                    width="100">
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="track_album" class="col-form-label">Artist:</label>
                            <select class="form-control" id="track_album" name="album_id[]" multiple>
                                <option value="">Select Artist</option>
                                @isset($albums)
                                    @foreach ($albums as $album)
                                        <option value="{{ $album->Album_id }}"
                                            {{ in_array($album->Album_id, $selectedAlbums) ? 'selected' : '' }}>
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
