@extends('layouts.master')

@section('title')
    Dashboard | Artist Management
@endsection

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Artist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('artist.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="descriptions" class="col-form-label">Descriptions:</label>
                            <textarea class="form-control" id="descriptions" name="descriptions" rows="4">{{ old('descriptions') }}</textarea>
                        </div>
                        <div class="form-group mt-4">
                            <label for="avatar" class="col-form-label">Avatar:</label>
                            <input type="file" class="form-control-file" id="avatar" name="avatar">
                        </div>
                        <!-- ... -->
                        <!-- Add other artist-related fields here -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Artist</button>
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
                    <h4 class="card-title"> Artist Management</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">ADD</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Artist ID</th>
                                <th>Name</th>
                                <th>Descriptions</th>
                                <th>Avatar</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                                @foreach ($artists as $artist)
                                    <tr>
                                        <td>{{ $artist->Artist_id }}</td>
                                        <td>{{ $artist->Name }}</td>
                                        <td>{{ $artist->Descriptions }}</td>
                                        <td>
                                            @if ($artist->Avatar)
                                                <img src="{{ asset('avatars/' . $artist->Avatar) }}"
                                                    alt="{{ $artist->Name }}" width="50">
                                            @else
                                                No Avatar
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('artist.edit', ['id' => $artist->Artist_id]) }}"
                                                class="btn btn-success">EDIT</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('artist.delete', ['id' => $artist->Artist_id]) }}"
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
