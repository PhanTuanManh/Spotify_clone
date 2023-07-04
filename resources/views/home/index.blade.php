<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="  {{ asset('home/css/style.css') }}">
</head>

<body>

    <div class="sidebar">
        <div class="logo">
            <a href="#">
                <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2018/11/Spotify_Logo_RGB_White.png"
                    alt="Logo" />
            </a>
        </div>

        <div class="navigation">
            <ul>
                <li>
                    <a style="color:#ffffff" href="{{ url('/') }}">
                        <span class="fa fa-home"></span>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-search"></span>
                        <span>Search</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fas fa-book"></span>
                        <span>Your Library</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="fa fa-list"></span>
                        <span>Categlory</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navigation">
            <ul>
                <li>
                    <a href="{{ url('/404') }}">
                        <span class="fa fas fa-plus-square"></span>
                        <span>Create Playlist</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/404') }}">
                        <span class="fa fas fa-heart"></span>
                        <span>Liked Songs</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- <div class="policies">
        <ul>
          <li>
            <a href="#">Cookies</a>
          </li>
          <li>
            <a href="#">Privacy</a>
          </li>
        </ul>
      </div> -->
    </div>

    <div class="main-container">
        <div class="topbar">
            <div class="prev-next-buttons">
                <button type="button" class="fa fas fa-chevron-left"></button>
                <button type="button" class="fa fas fa-chevron-right"></button>
            </div>
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
                                <a href="{{ url('/product/index') }}">Admin</a>
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
                        <div class="user-fame" style="width: 28px; height:28px; inset-inline-start: 0px;">
                            <div class="user-icon">
                                <svg role="img" height="16" width="16" aria-hidden="true" viewBox="0 0 16 16"
                                    data-encore-id="icon" class="Svg-sc-ytk21e-0 gQUQL" style="fill: #ffffff;">
                                    <path
                                        d="M6.233.371a4.388 4.388 0 0 1 5.002 1.052c.421.459.713.992.904 1.554.143.421.263 1.173.22 1.894-.078 1.322-.638 2.408-1.399 3.316l-.127.152a.75.75 0 0 0 .201 1.13l2.209 1.275a4.75 4.75 0 0 1 2.375 4.114V16H.382v-1.143a4.75 4.75 0 0 1 2.375-4.113l2.209-1.275a.75.75 0 0 0 .201-1.13l-.126-.152c-.761-.908-1.322-1.994-1.4-3.316-.043-.721.077-1.473.22-1.894a4.346 4.346 0 0 1 .904-1.554c.411-.448.91-.807 1.468-1.052zM8 1.5a2.888 2.888 0 0 0-2.13.937 2.85 2.85 0 0 0-.588 1.022c-.077.226-.175.783-.143 1.323.054.921.44 1.712 1.051 2.442l.002.001.127.153a2.25 2.25 0 0 1-.603 3.39l-2.209 1.275A3.25 3.25 0 0 0 1.902 14.5h12.196a3.25 3.25 0 0 0-1.605-2.457l-2.209-1.275a2.25 2.25 0 0 1-.603-3.39l.127-.153.002-.001c.612-.73.997-1.52 1.052-2.442.032-.54-.067-1.097-.144-1.323a2.85 2.85 0 0 0-.588-1.022A2.888 2.888 0 0 0 8 1.5z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <span class="user-name">
                            {{ auth()->user()->username }}
                        </span>
                        <svg role="img" height="16" width="16" aria-hidden="true"
                            class="Svg-sc-ytk21e-0 gQUQL eAXFT6yvz37fvS1lmt6k user-svg" viewBox="0 0 16 16"
                            data-encore-id="icon">
                            <path d="m14 6-6 6-6-6h12z"></path>
                        </svg>
                        <div id="myDiv" class="hidden">
                            <p>Profile</p>

                            <p style="border-top: 0.5px  solid #7e7878"
                                onclick="window.location='{{ route('logout.perform') }}'">Log out</p>
                        </div>
                    </button>
                </div>
            @endauth
        </div>

        @auth
            {{ auth()->user()->name }}
            <div class="text-end">
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
            </div>
        @endauth

        @guest
            <div class="text-end">
                <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
            </div>
        @endguest
        <div class="couter-fixed">

        </div>
        {{-- @foreach ($categories->slice(0, 4) as $key => $category)
        <div class="spotify-playlists">
            <div class="description">
                <h2>{{$category->category_name}}</h2>
                <p>Show all</p>

            </div>
            <div class="list">
                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Today's Top Hits</h4>
                    <p>Rema & Selena Gomez are on top of the...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>RapCaviar</h4>
                    <p>New Music from Lil Baby, Juice WRLD an...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>All out 2010s</h4>
                    <p>The biggest spmgs pf tje 2010s. Cover:...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Rock Classics</h4>
                    <p>Rock Legends & epic songs that continue t...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Chill Hits</h4>
                    <p>Kick back to the best new and recent chill...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Viva Latino</h4>
                    <p>Today's top Latin hits elevando nuestra...</p>
                </div>

            </div>
        </div>
        @endforeach --}}

        <div class="spotify-playlists">
            <div class="description">
                <h2>Focus</h2>
                <p>Show all</p>
            </div>
            <div class="list">
                @foreach ($products->slice(0, 6) as $product)
                    <div class="item">
                        <img src="{{ asset('image/product/' . $product->product_image) }}" />
                        <div class="play">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>{{ $product->product_name }}</h4>
                        <p>{{ $product->product_description }}</p>
                        <audio controls controlsList="nodownload" ontimeupdate="myAudio(this)">
                            <source src="{{ asset('audio/product/' . $product->audio) }}" type="audio/mpeg">
                        </audio>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="spotify-playlists">
            <div class="description">
                <h2>Focus</h2>
                <p>Show all</p>
            </div>
            <div class="list">
                <div class="item">
                    <img
                        src="https://cdns-images.dzcdn.net/images/cover/5e2c81ab07b72166c09950cb1e8ebba1/264x264.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Peaceful Piano</h4>
                    <p>Relax and indulge with beautiful piano pieces</p>
                </div>

                <div class="item">
                    <img
                        src="https://cdns-images.dzcdn.net/images/cover/5e2c81ab07b72166c09950cb1e8ebba1/264x264.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Deep Focus</h4>
                    <p>Keep calm and focus with ambient and pos...</p>
                </div>

                <div class="item">
                    <img
                        src="https://cdns-images.dzcdn.net/images/cover/5e2c81ab07b72166c09950cb1e8ebba1/264x264.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Instrumental Study</h4>
                    <p>Focus with soft study music in the...</p>
                </div>

                <div class="item">
                    <img
                        src="https://cdns-images.dzcdn.net/images/cover/5e2c81ab07b72166c09950cb1e8ebba1/264x264.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>chill lofi study beats</h4>
                    <p>The perfect study beats, twenty four...</p>
                </div>

                <div class="item">
                    <img
                        src="https://cdns-images.dzcdn.net/images/cover/5e2c81ab07b72166c09950cb1e8ebba1/264x264.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Coding Mode</h4>
                    <p>Dedicated to all the programmers out there.</p>
                </div>

                <div class="item">
                    <img
                        src="https://cdns-images.dzcdn.net/images/cover/5e2c81ab07b72166c09950cb1e8ebba1/264x264.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Focus Flow</h4>
                    <p>Uptempo instrumental hip hop beats.</p>
                </div>

            </div>
        </div>

        <div class="spotify-playlists">
            <div class="description">

                <h2>Mood</h2>
                <p>Show all</p>
            </div>
            <div class="list">
                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Mood Booster</h4>
                    <p>Get happy with today's dose of feel-good...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Feelin' Good</h4>
                    <p>Feel good with this positively timeless...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Dark & Stormy</h4>
                    <p>Beautifully dark, dramatic tracks.</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Feel Good Piano</h4>
                    <p>Happy vibes for an upbeat morning.</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Feelin' Myself</h4>
                    <p>The hip-hop playlist that's a whole mood...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Chill Tracks</h4>
                    <p>Softer kinda dance</p>
                </div>




            </div>
        </div>
        <div class="spotify-playlists">
            <div class="description">

                <h2>Spotify Playlists</h2>
                <p>Show all</p>
            </div>
            <div class="list">
                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Today's Top Hits</h4>
                    <p>Rema & Selena Gomez are on top of the...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>RapCaviar</h4>
                    <p>New Music from Lil Baby, Juice WRLD an...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>All out 2010s</h4>
                    <p>The biggest spmgs pf tje 2010s. Cover:...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Rock Classics</h4>
                    <p>Rock Legends & epic songs that continue t...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Chill Hits</h4>
                    <p>Kick back to the best new and recent chill...</p>
                </div>

                <div class="item">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/vi/3/32/S%C6%A1n_T%C3%B9ng_M-TP_-_C%C3%B3_ch%E1%BA%AFc_y%C3%AAu_l%C3%A0_%C4%91%C3%A2y.jpg" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Viva Latino</h4>
                    <p>Today's top Latin hits elevando nuestra...</p>
                </div>


            </div>
        </div>

        <hr>
    </div>

    <div class="music-player">
        <div class="song-bar">
            <div class="song-infos now-playing">
                <div class="image-container song-art">
                    <img src="{{asset('image/product/1680927047_artworks-000682696024-t8xa2d-t500x500.jpg')}}" alt="" /> 
                </div>
                <div class="song-description">
                    <p class="title track-name">
                        Intentions
                    </p>
                    <p class="artist track-artist">JB</p>
                </div>
            </div>
            <div class="icons">
                <i class="far fa-heart"></i>
                <i class="fas fa-compress"></i>
            </div>
        </div>
        <div class="progress-controller">
            <div class="control-buttons">
                <i class="fas fa-random" title="random" onclick="randomTrack()"></i>
                <i class="fas fa-step-backward" onclick="prevTrack()"></i>
                <i class="play-pause fas fa-play" onclick="playpauseTrack()" style="line-height: 0.9;"></i>
                <i class="fas fa-step-forward" onclick="nextTrack()"></i>
                <i class="fas fa-undo-alt" title="repeat" onclick="repeatTrack()"></i>
            </div>
            <div class="progress-container">
                <span class="current-time">0:49</span>
                <input type="range" min="1" max="100" value="0"
                    class="progress-bar volime_slider" onchange="seekTo()" name="" id="slider">
                <span class="tota-duration">3:15</span>
            </div>
        </div>
        <div class="other-features">
            <i class="fas fa-list-ul"></i>
            <i class="fas fa-desktop"></i>
            <div class="volume-bar">
                <i class="fas fa-volume-down"></i>
                <input type="range" min="1" max="100" value="99" class="progress-bar"
                    id="slider">

            </div>
        </div>
    </div>
    </div>

    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <script src="{{ asset('home/js/script.js') }}"></script>
</body>

</html>
