/* -------------------- Global Vars -------------------- */
var camera = 0;

/* -------------------- DOM Elements -------------------- */
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const startCameraButton = document.getElementById('startCameraButton');
const takePictureButton = document.getElementById('takePicture-button');
const clearButton = document.getElementById('clear-button');
const width = canvas.width;
const height = canvas.height;

/* -------------------- Get media stream and start camera -------------------- */
startCameraButton.addEventListener('click', function() {
    if (camera === 0) {
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
    }
    /*else {
		
    } */
});

/* -------------------- To reproduce image in canvas -------------------- */
video.addEventListener("canplay", function setCanvas() {
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, width, height);
    setTimeout(setCanvas, 0);
    startCameraButton.innerHTML = 'Désactiver la webcam';
    startCameraButton.style.borderColor = '#CC1414';
    startCameraButton.style.backgroundColor = '#CC1414';
});

/* -------------------- To take picture -------------------- */
takePictureButton.addEventListener('click', function() {
    if (camera === 1) {
        const imgURL = canvas.toDataURL('Image/png');
        let id = Math.random().toString();
        let divImg = document.createElement('div');
        let saveButton = document.createElement('button');
        let img = document.createElement('img');
        divImg.setAttribute('id', id);
        divImg.setAttribute('class', 'takenImage');
        saveButton.setAttribute('onclick', 'savePicture(id)');
        saveButton.setAttribute('id', id);
        saveButton.setAttribute('class', 'btn');
        saveButton.innerHTML = 'Sauvegarder';
        img.setAttribute('src', imgURL);
        img.setAttribute('id', id);
        img.setAttribute('class', id);
        divImg.appendChild(img);
        divImg.appendChild(saveButton);
        photos.appendChild(divImg);
    }
});

/* -------------------- To clear all taken pictures -------------------- */
clearButton.addEventListener('click', function() {
    photos.innerHTML = '';
});

/* -------------------- To save picture -------------------- */
function savePicture(id) {
    xhr = new XMLHttpRequest;
    let picture = document.getElementsByClassName(id);
    console.log(picture);
    let data = new FormData;
    data.append('picture', picture.src);

    xhr.onreadystatechange = function() {
        if (xhr.readyStatus === 4) {
            if (xhr.status === 200) {
                let element = document.getElementById(id);
                element.parentElement.removeChild(element);
            }
        }
    };
    xhr.open('POST', '../../Controller/Admin/Pictures/get_picture.php');
    xhr.send(data);
}