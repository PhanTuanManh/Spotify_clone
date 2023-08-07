<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png"
        href="https://th.bing.com/th/id/R.2ebc6c77ba84d7194d4a8f6a7334571e?rik=2ffoY4RHjXWJ2w&pid=ImgRaw&r=0">
    <title>Spotify clone</title>
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
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
    </script>
    @guest
        <script>
            var canOpenAd = true; // Biến để kiểm tra xem đã chuyển hướng tới trang quảng cáo sau 5 giây chưa

            function handleFirstClick(event) {
                // Lưu trữ thông tin trong sessionStorage của trình duyệt
                if (!sessionStorage.getItem('visited')) {
                    // Nếu chưa có giá trị visited, đây là lần đầu tiên
                    sessionStorage.setItem('visited', 'true');
                    // Mở tab mới và điều hướng tới link mà bạn muốn sau khi click lần đầu tiên
                    window.open('https://shope.ee/5KidLnpxZ2', '_blank');
                    event.preventDefault(); // Ngăn chặn chuyển hướng ban đầu (nếu có)
                } else {
                    // Nếu đã có giá trị visited và có thể mở quảng cáo, sau 5 giây chuyển hướng tới trang quảng cáo mới
                    if (canOpenAd) {
                        setTimeout(function() {
                            canOpenAd = true; // Cho phép mở quảng cáo mới sau 5 giây tiếp theo
                        }, 600000); // 5000 miliseconds = 5 giây
                        window.open('https://shope.ee/5KidLnpxZ2',
                            '_blank'); // Thay thế bằng đường dẫn trang quảng cáo thật
                        canOpenAd = false; // Ngăn chặn mở quảng cáo trong 5 giây tiếp theo
                    }
                }
            }

            // Gán sự kiện click cho toàn bộ trang
            document.addEventListener('click', handleFirstClick);
        </script>
    @endguest

    @auth
        @if (auth()->user()->user_type === 'user')
            <script>
                var canOpenAd = true; // Biến để kiểm tra xem đã chuyển hướng tới trang quảng cáo sau 5 giây chưa

                function handleFirstClick(event) {
                    // Lưu trữ thông tin trong sessionStorage của trình duyệt
                    if (!sessionStorage.getItem('visited')) {
                        // Nếu chưa có giá trị visited, đây là lần đầu tiên
                        sessionStorage.setItem('visited', 'true');
                        // Mở tab mới và điều hướng tới link mà bạn muốn sau khi click lần đầu tiên
                        window.open('https://shope.ee/5KidLnpxZ2', '_blank');
                        event.preventDefault(); // Ngăn chặn chuyển hướng ban đầu (nếu có)
                    } else {
                        // Nếu đã có giá trị visited và có thể mở quảng cáo, sau 5 giây chuyển hướng tới trang quảng cáo mới
                        if (canOpenAd) {
                            setTimeout(function() {
                                canOpenAd = true; // Cho phép mở quảng cáo mới sau 5 giây tiếp theo
                            }, 600000); // 5000 miliseconds = 5 giây
                            window.open('https://shope.ee/5KidLnpxZ2',
                                '_blank'); // Thay thế bằng đường dẫn trang quảng cáo thật
                            canOpenAd = false; // Ngăn chặn mở quảng cáo trong 5 giây tiếp theo
                        }
                    }
                }

                // Gán sự kiện click cho toàn bộ trang
                document.addEventListener('click', handleFirstClick);
            </script>
        @endif
    @endauth
</body>

</html>
