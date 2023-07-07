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
                    <form action="{{ route('song-album.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="song_id">Song:</label>
                            <select class="form-control" name="song_id" id="song_id">
                                <option value="">Select Song</option>
                                @if (isset($songs))
                                    @foreach ($songs as $song)
                                        <option value="{{ $song->Song_id }}">{{ $song->Name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="album_id">Album:</label>
                            <select class="form-control" name="album_id" id="album_id">
                                <option value="">Select Album</option>
                                @if (isset($albums))
                                    @foreach ($albums as $album)
                                        <option value="{{ $album->Album_id }}">{{ $album->Name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Album-Song</button>
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
                    <h4 class="card-title">Album & Song Management</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">ADD</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Song</th>
                                <th>Album</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                                @foreach ($albumSongs as $albumSong)
                                    <tr>
                                        <td>{{ $albumSong->song->Name }}</td>
                                        <td>{{ $albumSong->album->Name }}</td>
                                        <td>
                                            <a href="{{ route('song-album.edit', ['id' => $albumSong->song_id]) }}"
                                                class="btn btn-success">EDIT</a>
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('song-album.delete', ['albumId' => $albumSong->album_id, 'songId' => $albumSong->song_id]) }}"
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
