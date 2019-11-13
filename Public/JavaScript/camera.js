/* -------------------- Global Vars -------------------- */
var camera = 0;

/* -------------------- DOM Elements -------------------- */
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const startCameraButton = document.getElementById('startCameraButton');
const takePictureButton = document.getElementById('takePicture-button');
const clearButton = document.getElementById('clear-button');
const context = canvas.getContext('2d');
const width = canvas.width;
const height = canvas.height;


context.font = "30px Arial";
context.textAlign = "center";
context.fillStyle = "#333";
context.fillText("Activer la caméra ou", width / 2, height / 2);
context.fillText("télécharger une image.", (width / 2), (height / 2) + 30);

/* -------------------- Get media stream and start camera -------------------- */
startCameraButton.addEventListener('click', function () {
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(function (stream) {

            if (camera === 0) {
                // Link to the video source
                video.srcObject = stream;
                // Play video
                video.play();
                camera = 1;
            } else {
                let tracks = stream.getTracks();
                tracks.forEach(function (track) {
                    track.stop();
                })
                video.srcObject = null;
                context.clearRect(0, 0, width, height);
                camera = 0;
            }
        })
        .catch(function() {
            context.font = "30px Arial";
            context.textAlign = "center";
            context.fillStyle = "#333";
            context.fillText("L'activation de la webcam a échoué,", width / 2, height / 2);
            context.fillText("veuillez télécharger une image.", (width / 2), (height / 2) + 30);
        });
});

/* -------------------- To reproduce image in canvas -------------------- */
video.addEventListener("canplay", function setCanvas() {
    if (camera === 1) {
        context.drawImage(video, 0, 0, width, height);
        setTimeout(setCanvas, 0);
        startCameraButton.innerHTML = 'Désactiver la webcam';
        startCameraButton.style.borderColor = '#CC1414';
        startCameraButton.style.backgroundColor = '#CC1414';
    } else {
        startCameraButton.innerHTML = 'Activer la webcam';
        startCameraButton.style.borderColor = '#3D913C';
        startCameraButton.style.backgroundColor = '#3D913C';
        context.font = "30px Arial";
        context.textAlign = "center";
        context.fillStyle = "#333";
        context.fillText("Activer la caméra ou", width / 2, height / 2);
        context.fillText("télécharger une image.", (width / 2), (height / 2) + 30);
    }
});

/* -------------------- To take picture -------------------- */
takePictureButton.addEventListener('click', function () {
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
clearButton.addEventListener('click', function () {
    photos.innerHTML = '';
});

/* -------------------- To save picture -------------------- */
function savePicture(id) {
    console.log(id)
    xhr = new XMLHttpRequest;
    let picture = document.getElementsByClassName(id);
    picture = picture[0];
    let data = new FormData;
    data.append('picture', picture.src);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let element = document.getElementById(id);
                element.parentElement.removeChild(element);
            } else
                console.log('error');
        }
    };

    xhr.open('POST', '../../Controller/Admin/Pictures/get_picture.php', true);
    xhr.send(data);
}