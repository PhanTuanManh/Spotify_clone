@extends('layouts.master')

@section('title')
    Dashboard | Song Management
@endsection

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Song</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('song.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="lyrics" class="col-form-label">Lyrics:</label>
                            <textarea class="form-control" id="lyrics" name="lyrics" rows="4">{{ old('lyrics') }}</textarea>
                        </div>
                        <div class="form-group mt-4">
                            <label for="song_img" class="col-form-label">Song Image:</label>
                            <input type="file" class="form-control-file" id="song_img" name="song_img">
                        </div>
                        <div class="form-group mt-4">
                            <label for="song_audio" class="col-form-label">Song Audio:</label>
                            <input type="file" id="song_audio" name="song_audio" accept="audio/*">
                            @if (isset($song) && $song->Song_Audio)
                                <audio controls>
                                    <source src="{{ asset('song_audio/' . $song->Song_Audio) }}" class="form-control"
                                        id="audio" placeholder="Audio" value="" name="song_audio">
                                    Your browser does not support the audio element.
                                </audio>
                                <input type="text" id="song_audio_value" name="song_audio_value"
                                    value="{{ $song->Song_Audio }}" readonly>
                            @endif
                        </div>

                        <div class="form-group mt-4">
                            <label for="descriptions" class="col-form-label">Descriptions:</label>
                            <textarea class="form-control" id="descriptions" name="descriptions" rows="4">{{ old('descriptions') }}</textarea>
                        </div>
                        <div class="form-group mt-4">
                            <label for="genre_id" class="col-form-label">Genre:</label>
                            <select class="form-control" id="genre_id" name="genre_id">
                                <option value="">Select Genre</option>
                                <!-- Thêm option trống để người dùng có thể chọn -->
                                @isset($genres)
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->Genre_id }}">{{ $genre->Name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>




                        <!-- ... -->
                        <!-- Add other song-related fields here -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Song</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Song Management</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">ADD</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                {{-- <th>Song ID</th> --}}
                                <th>Name</th>
                                <th>Genre</th>
                                <th>Lyrics</th>
                                <th>Song Image</th>
                                <th>Song Audio</th>
                                <th>Descriptions</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                                @foreach ($songs as $song)
                                    <tr>
                                        {{-- <td>{{ $song->Song_id }}</td> --}}
                                        <td>{{ $song->Name }}</td>
                                        <td>{{ $song->genre->Name }}</td>
                                        <td>{{ Str::limit($song->Lyrics, 50) }}</td>
                                        <td>
                                            @if ($song->Song_IMG)
                                                <img src="{{ asset('song_images/' . $song->Song_IMG) }}"
                                                    alt="{{ $song->Name }}" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            @if ($song->Song_Audio)
                                                <audio controls>
                                                    <source src="{{ asset('song_audio/' . $song->Song_Audio) }}"
                                                        type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            @else
                                                No Audio
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($song->Descriptions, 20) }}</td>
                                        <td>
                                            <a href="{{ route('song.edit', ['id' => $song->Song_id]) }}"
                                                class="btn btn-success">EDIT</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('song.delete', ['id' => $song->Song_id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
