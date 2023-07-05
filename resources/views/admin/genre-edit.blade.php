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
                    <form action="{{ route('genre.update', ['id' => $genre->Genre_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $genre->Name }}">
                        </div>
                        <div class="form-group">
                            <label for="descriptions" class="col-form-label">Descriptions:</label>
                            <textarea class="form-control" id="descriptions" name="descriptions" rows="4">{{ $genre->Description }}</textarea>
                        </div>
                        <!-- Add other genre-related fields here -->

                        <div class="modal-footer">
                            <button her class="btn btn-success">Save</button>
                            <a href="/genre" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
