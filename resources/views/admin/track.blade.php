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
                    <h5 class="modal-title" id="exampleModalLabel">Add Track</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('track.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group mt-4">
                            <label for="thumbnail" class="col-form-label">Thumbnail:</label>
                            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                        </div>
                        <div class="form-group mt-4">
                            <label for="album_id" class="col-form-label">Album:</label>
                            <select class="form-control" id="album_id" name="album_id">
                                <option value="">Select Album</option>
                                <!-- Thêm option trống để người dùng có thể chọn -->
                                @isset($albums)
                                    @foreach ($albums as $album)
                                        <option value="{{ $album->Album_id }}">{{ $album->Name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!-- Add other track-related fields here -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Track</button>
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
                    <h4 class="card-title">Track Management</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">ADD</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Track ID</th>
                                <th>Name</th>
                                <th>Album</th>
                                <th>Thumbnail</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                                @foreach ($tracks as $track)
                                    <tr>
                                        <td>{{ $track->Track_id }}</td>
                                        <td>{{ $track->Name }}</td>
                                        <td>{{ $track->album->Name }}</td>
                                        <td>
                                            @if ($track->Thumbnail)
                                                <img src="{{ asset('track_thumbnails/' . $track->Thumbnail) }}"
                                                    alt="{{ $track->Name }}" width="50">
                                            @else
                                                No Thumbnail
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('track.edit', ['id' => $track->Track_id]) }}"
                                                class="btn btn-success">EDIT</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('track.delete', ['id' => $track->Track_id]) }}"
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
