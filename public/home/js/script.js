const myButton = document.getElementById("myButton");
const myDiv = document.getElementById("myDiv");

myButton.addEventListener("click", function() {
  if (myDiv.classList.contains("show")) {
    myDiv.classList.remove("show");
  } else {
    myDiv.classList.add("show");
  }
});

let now_playing = document.querySelector('.now-playing');
let track_art = document.querySelector('.track-art');
let track_name = document.querySelector('.track-name');
let track_artist = document.querySelector('.track-aritst');

let playpause_btn = document.querySelector('.playpauseTrack');
let next_btn = document.querySelector('.nextTrack');
let prev_btn = document.querySelector('.prevTrack');
