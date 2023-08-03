<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png"
        href="https://th.bing.com/th/id/R.2ebc6c77ba84d7194d4a8f6a7334571e?rik=2ffoY4RHjXWJ2w&pid=ImgRaw&r=0">
    <title>Spotify clone</title>
    <link rel="stylesheet" href="  {{ asset('home/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    @include('layouts-home.sidebar')

    <div class="main-container">
        @include('layouts-home.topbar')

        @yield('content')



        <hr>
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

        const scrollThreshold = 60; // Thay đổi giá trị này thành số pixel mà bạn muốn

        window.addEventListener('scroll', () => {
            if (window.scrollY > scrollThreshold) {
                document.body.classList.add('scroll-down');
            } else {
                document.body.classList.remove('scroll-down');
            }
        });


        window.getRandomColor = function() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        };

        const randomColor = window.getRandomColor();
        document.body.style.background =
            `linear-gradient(to bottom, ${randomColor} 0%, #121212 8%, #121212 100%)`;
    </script>

</body>

</html>
