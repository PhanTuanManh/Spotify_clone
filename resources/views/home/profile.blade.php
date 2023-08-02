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
                <h1>Account overview</h1>
            </div>
            <article>
                <section>
                    <h3>Profile</h3>
                    <table>
                        <tr>
                            <td>
                                @if ($user->avatar)
                                    <img src="{{ asset('user_avatar/' . $user->avatar) }}" alt="{{ $user->name }}"
                                        width="200"
                                        style="border-radius: 50%; box-shadow: rgba(17, 17, 26, 0.05) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>
                </section>
                <div class="container-edit">
                    <a href="{{ route('profile.edit', ['id' => auth()->user()->User_id]) }}" class="profile-edit">Edit
                        profile</a>
                </div>
            </article>
            <h4></h4>
        </div>
    </div>





    <hr>


    @include('layouts-home.footer')


    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <script src="{{ asset('home/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</body>

</html>
