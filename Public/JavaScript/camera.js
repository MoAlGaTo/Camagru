/* -------------------- Global Vars -------------------- */
let streaming = false,
    camera = 0;

/* -------------------- DOM Elements -------------------- */
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const takePictureButton = document.getElementById('takePicture-button');
const clearButton = document.getElementById('clear-button');
const width = canvas.width;
const height = canvas.height;

/* -------------------- Get media stream -------------------- */
navigator.mediaDevices.getUserMedia({ video: true, audio: false })
    .then(function(stream) {
        // Link to the video source
        video.srcObject = stream;
        // Play video
        video.play();
        camera = 1;
    })
    .catch(function(err) {
        console.log(`Error: ${err}`);
    });

/* -------------------- Reproduce image in canvas -------------------- */
video.addEventListener("canplay", function setCanvas() {
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, width, height);
    setTimeout(setCanvas, 0)
});

/* -------------------- To take picture -------------------- */
takePictureButton.addEventListener('click', function() {
    if (camera === 1) {
        const imgURL = canvas.toDataURL('Image/png');
        let id = Math.random().toString();
        let divImg = document.createElement('div');
        let saveButton = document.createElement('button');
        let img = document.createElement('img');
        divImg.setAttribute('class', 'takenImage');
        saveButton.setAttribute('class', 'btn');
        saveButton.innerHTML = 'Sauvegarder';
        saveButton.setAttribute('onclick', 'savepicture()');
        img.setAttribute('src', imgURL);
        img.setAttribute('id', id);
        img.setAttribute('name', 'picture');
        divImg.appendChild(img);
        divImg.appendChild(saveButton);
        photos.appendChild(divImg);
    }
});

/* -------------------- To clear all taken pictures -------------------- */
clearButton.addEventListener('click', function() {
    photos.innerHTML = '';
});