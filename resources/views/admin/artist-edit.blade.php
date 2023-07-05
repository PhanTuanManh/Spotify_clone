@extends('layouts.master')

@section('title')
    Dashboard | Artist Edition
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Edit Artist</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('artist.update', ['id' => $artist->Artist_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $artist->Name }}">
                        </div>
                        <div class="form-group">
                            <label for="descriptions">Descriptions:</label>
                            <textarea name="descriptions" id="descriptions" class="form-control" rows="4">{{ $artist->Descriptions }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar:</label>
                            <input type="file" name="avatar" id="avatar" class="form-control-file">
                            @if ($artist->Avatar)
                                <img src="{{ asset('avatars/' . $artist->Avatar) }}" alt="{{ $artist->Name }}"
                                    width="100">
                            @endif
                        </div>
                        <!-- ... -->
                        <!-- Add other artist-related fields here -->

                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/artist" class="btn btn-danger">Cancel</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
