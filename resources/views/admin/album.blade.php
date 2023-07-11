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
                    <h5 class="modal-title" id="exampleModalLabel">Add Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="release_date" class="col-form-label">Release Date:</label>
                            <input type="date" class="form-control" id="release_date" name="release_date"
                                value="{{ old('release_date') }}">
                        </div>
                        <div class="form-group mt-4">
                            <label for="thumbnail" class="col-form-label">Thumbnail:</label>
                            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                        </div>

                        <!-- ... -->
                        <!-- Add other album-related fields here -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Album</button>
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
                    <h4 class="card-title">Album Management</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">ADD</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Album ID</th>
                                <th>Name</th>
                                <th>Release Date</th>
                                <th>Thumbnail</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                                @foreach ($albums as $album)
                                    <tr>
                                        <td>{{ $album->Album_id }}</td>
                                        <td>{{ Str::limit($album->Name, 30) }}</td>
                                        <td>{{ $album->Release_date }}</td>
                                        <td>
                                            @if ($album->Thumbnail)
                                                <img src="{{ asset('album_thumbnails/' . $album->Thumbnail) }}"
                                                    alt="{{ $album->Name }}" width="50">
                                            @else
                                                No Thumbnail
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('album.edit', ['id' => $album->Album_id]) }}"
                                                class="btn btn-success">EDIT</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('album.delete', ['id' => $album->Album_id]) }}"
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
