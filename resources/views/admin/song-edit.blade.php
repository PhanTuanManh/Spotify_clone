@extends('layouts.master')

@section('title')
    Dashboard | Song Edition
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Edit Song</h4>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('song.update', ['id' => $song->Song_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $song->Name }}">
                        </div>
                        <div class="form-group">
                            <label for="lyrics">Lyrics:</label>
                            <textarea name="lyrics" id="lyrics" class="form-control" rows="4">{{ $song->Lyrics }}</textarea>
                        </div>
                        <div class="form-group mt-4">
                            <label for="song_artist" class="col-form-label">Artist:</label>
                            <select class="form-control" id="song_artist" name="artist_id[]" multiple>
                                <option value="">Select Artist</option>
                                <!-- Thêm option trống để người dùng có thể chọn -->
                                @isset($artists)
                                    @foreach ($artists as $artist)
                                        <option value="{{ $artist->Artist_id }}"
                                            {{ in_array($artist->Artist_id, $selectedArtists) ? 'selected' : '' }}>
                                            {{ $artist->Name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="song_img">Song Image:</label>
                            <input type="file" name="song_img" id="song_img" class="form-control-file">
                            @if ($song->Song_IMG)
                                <img src="{{ asset('song_images/' . $song->Song_IMG) }}" alt="{{ $song->Name }}"
                                    width="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="song_audio">Song Audio:</label>
                            <input type="file" name="song_audio" id="song_audio" class="form-control-file">
                            @if ($song->Song_Audio)
                                <audio controls>
                                    <source src="{{ asset('song_audio/' . $song->Song_Audio) }}" class="form-control"
                                        id="audio" placeholder="Audio" value="" name="song_audio">
                                    Your browser does not support the audio element.
                                </audio>
                                <input type="text" id="song_audio_value" name="song_audio_value"
                                    value="{{ $song->Song_Audio }}" readonly>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="descriptions">Descriptions:</label>
                            <textarea name="descriptions" id="descriptions" class="form-control" rows="4">{{ $song->Descriptions }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="genre_id">Genre:</label>
                            <select name="genre_id" id="genre_id" class="form-control">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->Genre_id }}"
                                        {{ $genre->Genre_id == $song->Genre_id ? 'selected' : '' }}>
                                        {{ $genre->Name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- ... -->
                        <!-- Add other song-related fields here -->

                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/song" class="btn btn-danger">Cancel</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
