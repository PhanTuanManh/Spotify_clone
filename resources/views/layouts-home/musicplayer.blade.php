        <style>
            * {
                padding: 0;
                margin: 0;
            }

            body {
                font-family: 'Montserrat', sans-serif;
            }

            .music-player {
                font-family: "circular std book", sans-serif;
                background-color: #222;
                font-size: 14px;
                --primary-color: #ddd;
                --secondary-color: #999;
                --green-color: #2d5;
                --padding: 0.6em;
                background-color: #181818;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                /* height: 5.8rem; */
                padding: var(--padding);
                color: var(--primary-color);
                position: fixed;
                bottom: 0;
                right: 0;
                left: 0;
                z-index: 102;
                border-top: 0.1px solid #2c2c2c;
            }

            i {
                color: var(--secondary-color);
            }

            i:hover {
                color: var(--primary-color);
            }

            #repeat-icon {
                color: var(--secondary-color);

            }

            .song-bar {
                position: absolute;
                left: var(--padding);

                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: flex-start;
                gap: 1.5rem;
                width: 25%;
            }

            .song-infos {
                display: flex;
                align-items: center;
                gap: 1em;
            }

            .image-container {
                --size: 4.5em;
                flex-shrink: 0;
                width: var(--size);
                height: var(--size);
            }

            .image-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .song-description p {
                margin: 0.2em;
            }

            .title,
            .artist {
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 1;
                overflow: hidden;
            }

            .title:hover,
            .artist:hover {
                text-decoration: underline;
            }

            .artist {
                color: var(--secondary-color);
            }

            .icons {
                display: flex;
                gap: 1em;
            }

            .progress-controller {
                width: 100%;
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                gap: 1.5em;
                color: var(--secondary-color);
            }


            .control-buttons {
                display: flex;
                align-items: center;
                gap: 2em;
            }

            .play-pause {
                display: inline-block;
                padding: 0.8em;
                background-color: var(--primary-color);
                color: #111;
                border-radius: 50%;
            }

            .play-pause:hover {
                transform: scale(1.1);
                color: #111;
            }

            .progress-container {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 1em;
            }

            .progress-container span {
                font-size: 0.7rem;
            }

            .progress-bar {
                height: 4px;
                border-radius: 10px;
                width: 30%;
                background-color: #ccc4;
                -moz-appearance: none;
                background-color: #ccc4;
                outline: none;
                cursor: pointer;
            }

            .progress {
                position: relative;
                height: 100%;
                width: 30%;
                border-radius: 10px;
                background-color: var(--secondary-color);
            }

            .progress-bar::-webkit-slider-thumb {
                -webkit-appearance: none;
                -moz-appearance: none;
                width: 15px;
                height: 15px;
                background: var(--secondary-color);
                border-radius: 100%;
                position: relative;
                z-index: 3;
            }



            .progress-bar:hover {
                background-color: var(--green-color);
            }

            .progress-bar:hover .progress {
                background-color: var(--green-color);
            }

            .progress-bar:hover .progress::after {
                content: "";
                position: absolute;
                --size: 1em;
                width: var(--size);
                height: var(--size);
                right: 0;
                border-radius: 50%;
                background-color: var(--primary-color);
                transform: translate(50%, calc(2px - 50%));
            }

            .other-features {
                position: absolute;
                right: var(--padding);
                display: flex;
                flex-direction: row;
                gap: 1em;
            }

            .volume-bar {
                display: flex;
                align-items: center;
                gap: .7em;
            }

            .volume-bar .progress-bar {
                width: 6em;
            }

            .volume-bar .progress-bar:hover .progress::after {
                --size: .8em;
            }

            #volume-icon {
                min-width: 16px;
            }
        </style>

        <div class="music-player">
            <div class="song-bar">
                <div class="song-infos now-playing">
                    <div class="image-container song-art">
                        <img src="{{ asset('image/product/1680927047_artworks-000682696024-t8xa2d-t500x500.jpg') }}"
                            alt="" />
                    </div>
                    <div class="song-description">
                        <p class="title track-name">
                            Intentions
                        </p>
                        <p class="artist track-artist">JB</p>
                    </div>
                </div>
                <div class="icons">
                    @auth
                        <i id="heart-{{ $song->id }}"
                            class="{{ $song->likes->where('User_id', auth()->user()->id)->contains('Song_id', $song->id) ? 'fas fa-heart' : 'far fa-heart' }}"
                            onclick="toggleLike({{ $song->id }})"></i>
                    @endauth
                    @guest
                        <i class="far fa-heart" onclick="window.location.href = '/login'"></i>
                    @endguest
                    <i class="fas fa-compress"></i>
                </div>
            </div>
            <div class="progress-controller">
                <div class="control-buttons">
                    <i class="fas fa-random" title="random" onclick="randomTrack()"></i>
                    <i class="fas fa-step-backward" onclick="prevTrack()"></i>
                    <i class="play-pause fas fa-play" title="play" onclick="playpauseTrack()"
                        style="line-height: 0.9;"></i>
                    <i class="fas fa-step-forward" onclick="nextTrack()"></i>
                    <i id="repeat-icon" class="fas fa-undo-alt" title="repeat" onclick="repeatTrack()"></i>
                </div>
                <div class="progress-container">
                    <span class="current-time">00:00</span>
                    <input type="range" min="0" max="1" step="0.01" value="0"
                        class="progress-bar" onchange="seekTo()" onmousedown="startSeek()" onmouseup="endSeek()"
                        name="" id="slider">
                    <span class="total-time">00:00</span>
                </div>
            </div>
            <div class="other-features">
                <i class="fas fa-list-ul"></i>
                <i class="fas fa-desktop"></i>
                <div class="volume-bar">
                    <i id="volume-icon" class="fas fa-volume-up"></i>
                    <input type="range" min="0" max="1" step="0.01" value="1"
                        class="volume-slider progress-bar" onchange="adjustVolume()" id="volume-slider">
                </div>


            </div>
        </div>




        <script>
            var currentAudio = null; // Biến lưu trữ audio đang phát
            var currentSongIndex = 0; // Chỉ số của bài hát hiện tại
            var previousPlayButton = null;

            function updatePlayer(event) {
                var player = document.querySelector('.music-player');
                var imageContainer = player.querySelector('.song-art img');
                var title = player.querySelector('.track-name');
                var artist = player.querySelector('.track-artist');
                var currentTimeElement = player.querySelector('.current-time');
                var totalTimeElement = player.querySelector('.total-time');
                var progressBar = player.querySelector('.progress-bar');

                // Lấy thông tin từ item được click
                var imageSrc = event.currentTarget.querySelector('img').src;
                var songName = event.currentTarget.querySelector('h4').textContent;
                var artistName = event.currentTarget.querySelector('p').textContent;
                var audioSource = event.currentTarget.querySelector('audio source').src;
                var audioDuration = event.currentTarget.querySelector('audio').duration;

                // Cập nhật thông tin trong music player
                imageContainer.src = imageSrc;
                title.textContent = songName;
                artist.textContent = artistName;

                // Dừng audio của item trước đó nếu có
                if (currentAudio) {
                    currentAudio.pause();
                }

                // Tạo mới audio và phát nhạc
                var audio = new Audio(audioSource);
                audio.play();

                // Cập nhật current time và total time khi metadata của audio đã sẵn sàng
                audio.addEventListener('loadedmetadata', function() {
                    currentTimeElement.textContent = formatTime(audio.currentTime);
                    totalTimeElement.textContent = formatTime(audio.duration);
                    progressBar.max = audio.duration;
                    progressBar.value = audio.currentTime;
                });

                // Cập nhật current time khi audio đang phát
                audio.addEventListener('timeupdate', function() {
                    currentTimeElement.textContent = formatTime(audio.currentTime);
                    progressBar.value = audio.currentTime;
                });

                // Lưu trữ audio đang phát để có thể dừng khi click vào item khác
                currentAudio = audio;
                progressBar.max = audio.duration;

                // Cập nhật chỉ số của bài hát hiện tại
                currentSongIndex = event.currentTarget.dataset.songIndex;

                var playButton = event.currentTarget.querySelector('.fa-play');
                if (playButton) {
                    playButton.classList.remove('fa-play');
                    playButton.classList.add('fa-pause');
                }
                document.querySelector('.play-pause').classList.remove('fa-play');
                document.querySelector('.play-pause').classList.add('fa-pause');

                // Chuyển đổi trạng thái của item trước đó thành fa-play (nếu có)
                if (previousPlayButton) {
                    previousPlayButton.classList.remove('fa-pause');
                    previousPlayButton.classList.add('fa-play');
                }

                // Lưu trạng thái của nút play/pause hiện tại cho việc chuyển đổi sau này
                previousPlayButton = playButton;

                // ... Các phần code khác
            }

            function padZero(number) {
                return number < 10 ? '0' + number : number;
            }

            function seekTo() {
                var progressBar = document.querySelector('.progress-bar');
                var currentTimeElement = document.querySelector('.current-time');
                var currentTime = parseFloat(progressBar.value);

                // Kiểm tra nếu đang tua thì không thực hiện seek
                if (isSeeking) {
                    return;
                }

                // Ngừng audio và cập nhật thời gian
                currentAudio.pause();
                currentAudio.currentTime = currentTime;
                currentTimeElement.textContent = formatTime(currentTime);

                // Tiếp tục phát audio sau khi tua xong
                currentAudio.addEventListener('seeked', function() {
                    currentAudio.play();
                });
            }

            // Sự kiện bắt đầu tua
            function startSeek() {
                isSeeking = true;
            }

            // Sự kiện kết thúc tua
            function endSeek() {
                isSeeking = false;
                seekTo(); // Cập nhật giá trị hiện tại sau khi kết thúc tua
            }

            // Hàm dừng audio
            function pauseCurrentAudio() {
                if (currentAudio) {
                    currentAudio.pause();
                }
            }


            // Hàm định dạng thời gian
            function formatTime(time) {
                var minutes = Math.floor(time / 60);
                var seconds = Math.floor(time % 60);
                return padZero(minutes) + ':' + padZero(seconds);
            }

            function playpauseTrack() {
                if (currentAudio.paused) {
                    currentAudio.play();
                    document.querySelector('.play-pause').classList.remove('fa-play');
                    document.querySelector('.play-pause').classList.add('fa-pause');
                } else {
                    currentAudio.pause();
                    document.querySelector('.play-pause').classList.remove('fa-pause');
                    document.querySelector('.play-pause').classList.add('fa-play');
                }
            }

            function nextTrack() {
                currentSongIndex = (currentSongIndex + 1) % totalSongs;
                var nextSong = document.querySelector('.item[data-song-index="' + currentSongIndex + '"]');
                updatePlayer(nextSong);
            }

            function prevTrack() {
                currentSongIndex = (currentSongIndex - 1 + totalSongs) % totalSongs;
                var prevSong = document.querySelector('.item[data-song-index="' + currentSongIndex + '"]');
                updatePlayer(prevSong);
            }

            function adjustVolume() {
                var volumeSlider = document.getElementById('volume-slider');
                var volumeIcon = document.getElementById('volume-icon');

                var volume = parseFloat(volumeSlider.value);
                currentAudio.volume = volume;

                if (volume === 0) {
                    volumeIcon.classList.remove('fa-volume-down', 'fa-volume-up');
                    volumeIcon.classList.add('fa-volume-off');
                } else if (volume < 0.7) {
                    volumeIcon.classList.remove('fa-volume-off', 'fa-volume-up');
                    volumeIcon.classList.add('fa-volume-down');
                } else {
                    volumeIcon.classList.remove('fa-volume-off', 'fa-volume-down');
                    volumeIcon.classList.add('fa-volume-up');
                }
            }

            // Lắng nghe sự kiện input khi thay đổi giá trị của thanh trượt âm lượng
            var volumeSlider = document.getElementById('volume-slider');

            audio.addEventListener('ended', function() {
                nextTrack();
            });
            //
        </script>
