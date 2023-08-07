<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png"
        href="https://th.bing.com/th/id/R.2ebc6c77ba84d7194d4a8f6a7334571e?rik=2ffoY4RHjXWJ2w&pid=ImgRaw&r=0">
    <title>Spotify clone</title>
    <link rel="stylesheet" href="  {{ asset('home/css/style-search.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    @include('layouts-home.sidebar')

    <div class="main-container">
        <div class="topbar">
            <form action="{{ url('song.result') }}" method="GET" role="search">
                <div class="prev-next-buttons">
                    <div class="search-container">
                        <input type="text" name="search" value="" placeholder="Search..."
                            class="search-input">
                        <a href="#" class="search-btn">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </form>
            @guest
                <div class="navbar">
                    <ul>
                        <li>
                            <a href="{{ url('/404') }}">Premium</a>

                        </li>
                        <li>
                            <a href="{{ url('/404') }}">Download</a>
                        </li>
                        <li class="divider">|</li>
                        {{-- <li>
                        <a href="{{ url('/register') }}">Sign Up</a>
                    </li> --}}
                    </ul>
                    <button type="button" class="button1" onclick="window.location.href='{{ url('/register') }}'">Sign
                        up</button>
                    <button type="button" class="button2" onclick="window.location.href='{{ url('/login') }}'">Log
                        in</button>
                </div>
            @endguest
            @auth
                <div class="navbar">
                    @if (auth()->user()->email == 'manhdeptrai@admin.com')
                        <ul>
                            <li>
                                <a href="{{ url('/admin') }}">Admin</a>
                            </li>
                        @else
                            <ul>
                                <li>
                                    <a href="{{ url('/404') }}">Premium</a>
                                </li>
                                <li>
                                    <a href="{{ url('/404') }}">Download</a>
                                </li>
                    @endif
                    <li class="divider">|</li>
                    </ul>
                    <!-- <li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a href="#">Sign Up</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </li> -->
                    <!-- <button type="button" class="button1">Sign up</button> -->
                    <button class="user-container" id="myButton">
                        <div class="user-fame" style="width: 28px; height: 28px; inset-inline-start: 0px;">
                            <div class="user-icon">
                                @if (auth()->user()->avatar)
                                    <img src="{{ asset('user_avatar/' . auth()->user()->avatar) }}" alt="Avatar"
                                        width="100%" style="border-radius: 50%">
                                @else
                                    <svg role="img" height="16" width="16" aria-hidden="true" viewBox="0 0 16 16"
                                        data-encore-id="icon" class="Svg-sc-ytk21e-0 gQUQL" style="fill: #ffffff;">
                                        <path
                                            d="M6.233.371a4.388 4.388 0 0 1 5.002 1.052c.421.459.713.992.904 1.554.143.421.263 1.173.22 1.894-.078 1.322-.638 2.408-1.399 3.316l-.127.152a.75.75 0 0 0 .201 1.13l2.209 1.275a4.75 4.75 0 0 1 2.375 4.114V16H.382v-1.143a4.75 4.75 0 0 1 2.375-4.113l2.209-1.275a.75.75 0 0 0 .201-1.13l-.126-.152c-.761-.908-1.322-1.994-1.4-3.316-.043-.721.077-1.473.22-1.894a4.346 4.346 0 0 1 .904-1.554c.411-.448.91-.807 1.468-1.052zM8 1.5a2.888 2.888 0 0 0-2.13.937 2.85 2.85 0 0 0-.588 1.022c-.077.226-.175.783-.143 1.323.054.921.44 1.712 1.051 2.442l.002.001.127.153a2.25 2.25 0 0 1-.603 3.39l-2.209 1.275A3.25 3.25 0 0 0 1.902 14.5h12.196a3.25 3.25 0 0 0-1.605-2.457l-2.209-1.275a2.25 2.25 0 0 1-.603-3.39l.127-.153.002-.001c.612-.73.997-1.52 1.052-2.442.032-.54-.067-1.097-.144-1.323a2.85 2.85 0 0 0-.588-1.022A2.888 2.888 0 0 0 8 1.5z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                        </div>

                        @auth
                            <span class="user-name">
                                {{ auth()->user()->username }}
                            </span>
                        @endauth

                        <svg role="img" height="16" width="16" aria-hidden="true"
                            class="Svg-sc-ytk21e-0 gQUQL eAXFT6yvz37fvS1lmt6k user-svg" viewBox="0 0 16 16"
                            data-encore-id="icon">
                            <path d="m14 6-6 6-6-6h12z"></path>
                        </svg>
                        <div id="myDiv" class="hidden">
                            <p
                                onclick="window.location.href='{{ route('profile.index', ['id' => auth()->user()->User_id]) }}'">
                                Profile</p>

                            <p style="border-top: 0.5px  solid #7e7878"
                                onclick="window.location='{{ route('logout.perform') }}'">Log out</p>
                        </div>
                    </button>
                </div>
            @endauth
        </div>

        @guest
            <div class="text-end">
                <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
            </div>
        @endguest
        <div class="couter-fixed">

        </div>

        @include('layouts-home.search-song')
    </div>

    @include('layouts-home.musicplayer')
    </div>

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <script src="{{ asset('home/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function toggleLike(songId) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

            axios.post(`/toggle-like/${songId}`)
                .then(response => {
                    if (response.data.isLiked) {
                        // Nếu đã like, chuyển đổi thành fas fa-heart
                        document.getElementById(`heart-${songId}`).classList.replace('far', 'fas');
                    } else {
                        // Nếu đã unlike, chuyển đổi thành far fa-heart
                        document.getElementById(`heart-${songId}`).classList.replace('fas', 'far');
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    </script>

</body>

</html>