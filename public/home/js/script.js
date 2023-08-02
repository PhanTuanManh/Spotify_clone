const myButton = document.getElementById("myButton");
const myDiv = document.getElementById("myDiv");

myButton.addEventListener("click", function () {
  if (myDiv.classList.contains("show")) {
    myDiv.classList.remove("show");
  } else {
    myDiv.classList.add("show");
  }
});



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










