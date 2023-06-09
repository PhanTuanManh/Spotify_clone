@extends('layouts.master')

@section('title')
    Dashboard | User Edition
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Edit User</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', ['id' => $users->User_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $users->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $users->email }}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                value="{{ $users->username }}">
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <input type="text" name="user_type" id="user_type" class="form-control"
                                value="{{ $users->user_type }}">
                        </div>
                        <!-- ... -->
                        <div class="form-group">
                            <label for="plan_id">Plan Name</label>
                            <select name="plan_id" id="plan_id" class="form-control">
                                @foreach ($subscriptions as $subscription)
                                    <option value="{{ $subscription->Plan_id }}"
                                        {{ $users->Plan_id == $subscription->Plan_id ? 'selected' : '' }}>
                                        {{ $subscription->Plan_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- ... -->

                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/user" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
