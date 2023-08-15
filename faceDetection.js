const video = document.getElementById('videoElement');


function startVideo() {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      video.srcObject = stream;
    })
    .catch(console.error);
}

window.addEventListener('load', startVideo);
