<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png"
        href="https://th.bing.com/th/id/R.2ebc6c77ba84d7194d4a8f6a7334571e?rik=2ffoY4RHjXWJ2w&pid=ImgRaw&r=0">
    <title>Spotify clone</title>
    <link rel="stylesheet" href="  {{ asset('home/css/style-profile.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    @include('layouts-home.sidebar')


    <div class="main-container">
        @include('layouts-home.topbar')
        <div class="spotify-playlists">
            <div class="profile-header">
                <h1>Profile edit</h1>
            </div>
            <article class="container-profile">
                <form action="{{ route('profile.update', ['id' => auth()->user()->User_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $user->email }}">
                    </div>
                    <div class="form-group mt-4">
                        <label for="avatar" class="col-form-label">Thumbnail:</label>
                        <input type="file" class="form-control-file" id="avatar" name="avatar">
                        @if ($user->avatar)
                            <img src="{{ asset('user_avatar/' . $user->avatar) }}" alt="{{ $user->name }}"
                                width="100">
                        @endif
                    </div>
                    <section class="line"></section>
                    <div class="container-button">
                        <a href="{{ route('profile.index', ['id' => auth()->user()->User_id]) }}" type="button"
                            class="button-cancel">Cancel</a>
                        <button type="submit" class="button-save">Save Profile</button>
                    </div>
                </form>
            </article>
        </div>

    </div>






    <hr>

    @include('layouts-home.footer')


    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <script src="{{ asset('home/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</body>

</html>
