const myButton = document.getElementById("myButton");
const myDiv = document.getElementById("myDiv");

myButton.addEventListener("click", function () {
  if (myDiv.classList.contains("show")) {
    myDiv.classList.remove("show");
  } else {
    myDiv.classList.add("show");
  }
});

var prevButton = document.querySelector('.prev-button');
var nextButton = document.querySelector('.next-button');

prevButton.addEventListener('click', function () {
  // Xử lý điều hướng về trang trước đó
  // Code của bạn để chuyển về trang trước đây

  // Ví dụ: Sử dụng hàm history.back() để quay lại trang trước đó
  history.back();
});

nextButton.addEventListener('click', function () {
  // Xử lý điều hướng tới trang tiếp theo
  // Code của bạn để chuyển tới trang tiếp theo đây

  // Ví dụ: Sử dụng hàm history.forward() để chuyển tới trang tiếp theo
  history.forward();
});


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
  audio.addEventListener('loadedmetadata', function () {
    currentTimeElement.textContent = formatTime(audio.currentTime);
    totalTimeElement.textContent = formatTime(audio.duration);
    progressBar.max = audio.duration;
    progressBar.value = audio.currentTime;
  });

  // Cập nhật current time khi audio đang phát
  audio.addEventListener('timeupdate', function () {
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
  currentAudio.addEventListener('seeked', function () {
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


//





// 
// 
src = "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"

function toggleLike(songId) {
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



var repeatIcon = document.getElementById('repeat-icon');
var audio = document.getElementById('audio-player'); // Thay thế 'audio-player' bằng ID của thẻ audio trong mã HTML

function repeatTrack() {
  if (audio.loop) {
    audio.loop = false; // Tắt chế độ lặp lại
    repeatIcon.style.color = '#999'; // Đặt màu về mặc định
  } else {
    audio.loop = true; // Bật chế độ lặp lại
    repeatIcon.style.color = '#1db954'; // Đặt màu mới
  }
}






