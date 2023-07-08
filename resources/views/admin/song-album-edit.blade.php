@extends('layouts.master')

@section('title')
    Dashboard | Song-Album Edition
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Album-Song</h4>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('song-album.update', $albumSong) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="song_id">Song:</label>
                            <select name="song_id" id="song_id" class="form-control" required>
                                @foreach ($songs as $song)
                                    <option value="{{ $song->Song_id }}"
                                        {{ $song->Song_id == $albumSong->song_id ? 'selected' : '' }}>
                                        {{ $song->Name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="album_id">Album:</label>
                            <select name="album_id" id="album_id" class="form-control" required>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->Album_id }}"
                                        {{ $album->Album_id == $albumSong->album_id ? 'selected' : '' }}>
                                        {{ $album->Name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Add other fields for album-song here -->

                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/song-album" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
