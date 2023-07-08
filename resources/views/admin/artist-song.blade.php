@extends('layouts.master')

@section('title')
    Dashboard | Song & Artist Management
@endsection

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Song & Artist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('artist-song.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="song_id">Song:</label>
                            <select class="form-control" name="song_id" id="song_id">
                                <option value="">Select Song</option>
                                @foreach ($songs as $song)
                                    <option value="{{ $song->Song_id }}">{{ $song->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Song-Artist</button>
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
                    <h4 class="card-title">Song & Artist Management</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">ADD</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Artist</th>
                                <th>Song</th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                                @foreach ($songArtists as $songArtist)
                                    <tr>
                                        <td>{{ $songArtist->artist->Name }}</td>
                                        <td>{{ $songArtist->song->Name }}</td>
                                        <td>
                                            <form
                                                action="{{ route('artist-song.delete', ['songId' => $songArtist->song_id, 'artistId' => $songArtist->artist_id]) }}"
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
