@extends('layouts.master')

@section('title')
    Dashboard | Album & Artist Management
@endsection

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Artist & Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('artist-album.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="artist_id">Artist:</label>
                            <select class="form-control" name="artist_id" id="artist_id">
                                <option value="">Select Artist</option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->Artist_id }}">{{ $artist->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="album_id">Album:</label>
                            <select class="form-control" name="album_id" id="album_id">
                                <option value="">Select Album</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->Album_id }}">{{ $album->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Album-Artist</button>
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
                    <h4 class="card-title">Artist & Album Management</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">ADD</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Artist</th>
                                <th>Album</th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                                @foreach ($albumArtists as $albumArtist)
                                    <tr>
                                        <td>{{ $albumArtist->artists->Name }}</td>
                                        <td>{{ Str::limit($albumArtist->albums->Name, 30) }}</td>
                                        <td>
                                            <form
                                                action="{{ route('artist-album.delete', ['albumId' => $albumArtist->album_id, 'artistId' => $albumArtist->artist_id]) }}"
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
