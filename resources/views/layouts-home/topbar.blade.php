<style>
    * {
        padding: 0;
        margin: 0;
    }

    body {
        background: linear-gradient(to bottom, #1f1f1f, #121212, #121212, #121212, #121212);
        font-family: 'Montserrat', sans-serif;
    }

    .topbar {
        display: flex;
        left: 235px;
        right: 0;
        justify-content: space-between;
        background: linear-gradient(to bottom, #232323, #1f1f1f);
        padding: 14px 30px;
        position: fixed;
        top: 0;
        min-height: 46px;
        z-index: 100;
        line-height: 46px;
    }

    .couter-fixed {
        position: relative;
        top: 0;
        right: 0;
        left: 0;
        height: 62px;
        z-index: -1;
    }

    .topbar .prev-next-buttons button {
        color: #7a7a7a;
        cursor: pointer;
        width: 34px;
        height: 34px;
        border-radius: 100%;
        font-size: 18px;
        border: 0px;
        background-color: #090909;
        margin-right: 10px;
    }

    .topbar .navbar {
        display: flex;
        align-items: center;
    }

    .topbar .navbar ul {
        list-style: none;
        line
    }

    .topbar .navbar ul li {
        display: inline-block;
        margin: 0px 8px;
        width: 70px;
    }

    .topbar .navbar ul li a {
        color: #b3b3b3;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        letter-spacing: 1px;
    }

    .topbar .navbar ul li a:hover,
    .topbar .navbar ul li a:active,
    .topbar .navbar ul li a:focus {
        color: #ffffff;
        font-size: 15px;
    }

    .topbar .navbar ul li.divider {
        color: #ffffff;
        font-size: 26px;
        margin: 0px 20px;
        width: auto;
    }

    .topbar .navbar .button1 {
        background-color: #ffffff;
        color: #000000;
        font-size: 16px;
        font-weight: 600;
        padding: 14px 30px;
        border: 0px;
        border-radius: 40px;
        cursor: pointer;
        margin-left: 8px;
    }

    .topbar .navbar .button2 {
        background-color: #ffffff;
        color: #000000;
        font-size: 16px;
        font-weight: 600;
        padding: 14px 30px;
        border: 0px;
        border-radius: 40px;
        cursor: pointer;
        margin-left: 8px;
    }

    .topbar .navbar .button1 {
        background-color: rgba(0, 0, 0, 0.1);
        color: var(--text-subdued, #6a6a6a);
    }

    .topbar .navbar .button1:hover {
        color: #f2f2f2;
        transform: scale(1.05);
    }

    .topbar .navbar .button2:hover,
    .topbar .navbar .button2:active,
    .topbar .navbar .button2:focus {
        background-color: #f2f2f2;
        transform: scale(1.05);
    }

    .user-container {
        background-color: #282828;
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
        padding: 14px 30px;
        border: 0px;
        border-radius: 23px;
        cursor: pointer;
        margin-left: 8px;
        align-items: center;
        height: 32px;
        display: flex;
        justify-content: center;
        padding: 2px;
        position: relative;
        gap: 8px;
        font-size: 14px;
    }

    .user-fame {
        display: block;
    }

    .user-icon {
        align-items: center;
        background-color: #535353;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        height: 100%;
        justify-content: center;
        width: 100%;
        border-radius: 50%;
    }


    .user-svg {
        margin-inline-end: 6px;
        height: 16;
        width: 16;
        fill: #ffffff;
        cursor: pointer;
    }

    #myDiv {
        position: absolute;
        top: 40px;
        right: 0;
        background-color: #282828;
        padding: 10px;
        border-radius: 2px;
        min-width: 200px;
        display: none;

    }

    #myDiv p {
        text-align: left;
        align-items: center;
        gap: 8px;
        padding: 12px;
        user-select: none;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: baseline;
        color: #cacaca;
    }


    #myDiv.show {
        display: block;
    }
</style>

<div class="topbar">
    <!-- Trong phần view của bạn -->
    <div class="prev-next-buttons">
        <button type="button" class="fa fas fa-chevron-left" onclick="previousPage()"></button>
        <button type="button" class="fa fas fa-chevron-right" onclick="nextPage()"></button>
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
            @php
                $allowedEmails = ['manhdeptrai@admin.com', 'haideptrai@admin.com', 'duydeptrai@admin.com'];
            @endphp

            @if (auth()->check() && in_array(auth()->user()->email, $allowedEmails))
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
                            <img src="{{ asset('user_avatar/' . auth()->user()->avatar) }}" alt="Avatar" width="100%"
                                style="border-radius: 50%">
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
                    class="Svg-sc-ytk21e-0 gQUQL eAXFT6yvz37fvS1lmt6k user-svg" viewBox="0 0 16 16" data-encore-id="icon">
                    <path d="m14 6-6 6-6-6h12z"></path>
                </svg>
                <div id="myDiv" class="hidden">
                    <p onclick="window.location.href='{{ route('profile.index', ['id' => auth()->user()->User_id]) }}'">
                        Profile</p>

                    <p style="border-top: 0.5px  solid #7e7878" onclick="window.location='{{ route('logout.perform') }}'">
                        Log out</p>
                </div>
            </button>
        </div>
    @endauth
</div>

<div class="couter-fixed">
</div>


<script>
    // Trong phần JavaScript của bạn
    function previousPage() {
        window.history.back();
    }

    function nextPage() {
        window.history.forward();
    }
</script>
