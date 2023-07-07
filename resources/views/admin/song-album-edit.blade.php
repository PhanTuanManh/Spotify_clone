@extends('layouts.master')

@section('title')
    Dashboard | Song-Album Edition
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Edit Song-Album</h4>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('song-album.update', ['id' => $albumSong->song_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="song_id">Song:</label>
                            <select name="song_id" id="song_id" class="form-control" required>
                                @foreach ($songs as $songId => $songName)
                                    <option value="{{ $songId }}"
                                        {{ $songId == $albumSong->song_id ? 'selected' : '' }}>
                                        {{ $songName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="album_id">Album:</label>
                            <select name="album_id" id="album_id" class="form-control" required>
                                @foreach ($albums as $albumId => $albumName)
                                    <option value="{{ $albumId }}"
                                        {{ $albumId == $albumSong->album_id ? 'selected' : '' }}>
                                        {{ $albumName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- ... -->
                        <!-- Add other song-related fields here -->

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
