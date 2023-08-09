<style>
    * {
        padding: 0;
        margin: 0;
    }

    body {
        font-family: 'Montserrat', sans-serif;
    }

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 196px;
        background-color: #000000;
        padding: 24px;
        z-index: 101;
    }

    .sidebar .logo img {
        width: 130px;
    }

    .sidebar .navigation ul {
        list-style: none;
        margin-top: 20px;
    }

    fa-home {
        /* CSS styles here */
        color: #ffffff;
    }

    .sidebar .navigation ul li {
        padding: 10px 0px;
    }

    .sidebar .navigation ul li:hover a,
    .sidebar .navigation ul li:hover span {
        color: #ffffff;
    }

    .sidebar .navigation ul li a {
        color: #b3b3b3;
        text-decoration: none;
        font-weight: bold;
        font-size: 13px;
    }

    .sidebar .navigation ul li a:hover,
    .sidebar .navigation ul li a:active,
    .sidebar .navigation ul li a:focus {
        color: #ffffff;
    }

    .navigation li a:hover+span.fa-home,
    .navigation li a:hover+span.fa-search {
        color: #ffffff;
    }

    .navigation li a:hover+span.fas.fa-book,
    .navigation li a:hover+span.fa-list {
        color: #ffffff;
    }

    .navigation a:hover span,
    .navigation a:hover+span {
        color: #ffffff;
    }

    .sidebar .navigation ul li a:hover .fa,
    .sidebar .navigation ul li a:active .fa,
    .sidebar .navigation ul li a:focus .fa {
        color: #b3b3b3;
    }

    .sidebar .navigation ul li .fa {
        font-size: 20px;
        margin-right: 10px;
    }

    .sidebar .navigation ul li a:hover .fa:hover,
    .sidebar .navigation ul li a:hover .fa:active,
    .sidebar .navigation ul li a:hover .fa:focus {
        color: #ffffff;
    }

    .sidebar .policies {
        position: absolute;
        bottom: 100px;
    }

    .sidebar .policies ul {
        list-style: none;
    }

    .sidebar .policies ul li {
        padding-bottom: 5px;
    }

    .sidebar .policies ul li a {
        color: #b3b3b3;
        font-weight: 500;
        text-decoration: none;
        font-size: 10px;
    }

    .sidebar .policies ul li a:hover,
    .sidebar .policies ul li a:active,
    .sidebar .policies ul li a:focus {
        text-decoration: underline;
    }

    li a.white !important {
        color: #ffffff;
    }
</style>

<div class="sidebar">
    <div class="logo">
        <a href="/">
            <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2018/11/Spotify_Logo_RGB_White.png"
                alt="Logo" />
        </a>
    </div>

    <div class="navigation">
        <ul>
            <li>
                <a href="{{ url('/') }}" class="{{ '/' == request()->path() ? 'white' : '' }}">
                    <span class="fa fa-home"></span>
                    <span>Home</span>
                </a>
            </li>

            <li>
                <a href="/search" class="{{ '/search' == request()->path() ? 'white' : '' }}">
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
