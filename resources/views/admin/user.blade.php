@extends('layouts.master')

@section('title')
    Dashboard | Sources
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Simple Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>
                                    User ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    User Type
                                </th>
                                <th>
                                    Plan ID
                                </th>
                                <th>
                                    EDIT
                                </th>
                                <th>
                                    DELETE
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->User_id }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->username }}
                                        </td>
                                        <td>
                                            {{ $user->user_type }}
                                        </td>
                                        <td>
                                            {{ $user->Plan_id }}
                                        </td>
                                        <td>
                                            <a href="/user-edit/{{ $user->User_id }}" class="btn btn-success">EDIT</a>

                                        </td>
                                        <td>
                                            <form action="/user-delete/{{ $user->User_id }}" method="POST">
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
