/* -------------------- Global Vars -------------------- */
var camera = 0;
var imageUploaded = 0;
var filterTab = [];
var imgUpldFilters = '';

/* -------------------- DOM Elements -------------------- */
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const startCameraButton = document.getElementById('startCameraButton');
const takePictureButton = document.getElementById('takePicture-button');
const clearButton = document.getElementById('clear-button');
const takePictureDiv = document.getElementById('div-button');
const uploadImg = document.getElementById('upload-img');
const cleanCanvas = document.getElementById('clean-canvas');
const formUpldImg = document.getElementById('form-upld-img');
const clearFilters = document.getElementById('clear-filters');
const context = canvas.getContext('2d');
const width = canvas.width;
const height = canvas.height;
cleanCanvas.style.display = 'none';
takePictureDiv.style.display = 'none';
clearFilters.style.display = 'none';
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
                video.play();
                camera = 1;
                imageUploaded = 0;
                clearFilter();
            } else {
                let tracks = stream.getTracks();
                tracks.forEach(function (track) {
                    track.stop();
                })
                video.srcObject = null;
                context.clearRect(0, 0, width, height);
                formUpldImg.style.display = 'inline-flex';
                camera = 0;
            }
        })
        .catch(function() {
            context.clearRect(0, 0, width, height);
            context.font = "30px Arial";
            context.textAlign = "center";
            context.fillStyle = "#333";
            context.fillText("L'activation de la webcam a échoué,", width / 2, height / 2);
            context.fillText("veuillez télécharger une image.", (width / 2), (height / 2) + 30);
        });
});

/* -------------------- To reproduce video image in canvas -------------------- */
video.addEventListener("canplay", function setCanvas() {
    if (camera === 1) {
        context.drawImage(video, 0, 0, width, height);
        drawFilter();
        startCameraButton.classList.remove('green-btn');
        startCameraButton.classList.add('red-btn');
        startCameraButton.innerHTML = 'Désactiver la webcam';
        clearFilters.style.display = 'block';
        takePictureDiv.style.display = 'block';
        formUpldImg.style.display = 'none';
        cleanCanvas.style.display = 'none';
        setTimeout(setCanvas, 30);
        uploadImg.value = "";
    } else {
        clearFilter();
        startCameraButton.classList.remove('red-btn');
        startCameraButton.classList.add('green-btn');
        startCameraButton.innerHTML = 'Activer la webcam';
        context.font = "30px Arial";
        context.textAlign = "center";
        context.fillStyle = "#333";
        context.fillText("Activer la caméra ou", width / 2, height / 2);
        context.fillText("télécharger une image.", (width / 2), (height / 2) + 30);
        takePictureDiv.style.display = 'none';
        clearFilters.style.display = 'none';
        uploadImg.value = "";
    }
});

/* -------------------- When an image was upload -------------------- */
uploadImg.addEventListener('change', function(e) {
    let type = this.files[0].type;
    if (type == "image/png" || type == "image/gif" || type == "image/jpeg") {
        clearFilter();
        // uploadImg.value = "";
        let upldImg = new Image;
        upldImg.onload = function() { context.drawImage(this, 0, 0, width, height); };
        upldImg.src = URL.createObjectURL(this.files[0]);
        imgUpldFilters = upldImg;
        clearFilters.style.display = 'block';
        takePictureDiv.style.display = 'block';
        cleanCanvas.style.display = 'block';
        imageUploaded = 1;
    } else {
        alert('Seul les images au format .png, .jpg - .jpeg, et .gif sont acceptés');
    }
    
})

/* -------------------- To add id filter to the array -------------------- */
function addFilter(idFilter) {
    if (camera == 1 || imageUploaded == 1) {
        let deleted = 0;
        for (i = 0; i < filterTab.length; i++) {
            if (filterTab[i] == idFilter) {
                filterTab.splice(i, 1);
                deleted = 1;
            }
        }
        if (deleted == 0) {
            filterTab.push(idFilter);
        } else {
            deleted = 0;
        }
        if (imageUploaded == 1) {
            context.clearRect(0, 0, width, height);
            context.drawImage(imgUpldFilters, 0, 0, width, height);
            for (i = 0; i < filterTab.length + 1; i++) {
                drawFilter(filterTab[i]);
            }
        }
    }
}

/* -------------------- To superpose filter to the canvas -------------------- */
function drawFilter() {
    filterTab.forEach(function(filter) {
        context.drawImage(document.getElementById(filter), 0, 0, width, height);
    });
}

/* -------------------- To delete all the filter from the canvas -------------------- */
function clearFilter() {
    filterTab = [];
}

/* -------------------- To take picture -------------------- */
takePictureButton.addEventListener('click', function () {
        const imgURL = canvas.toDataURL('Image/png');
        let id = Math.random().toString();
        let divImg = document.createElement('div');
        let saveButton = document.createElement('button');
        let deleteButton = document.createElement('button');
        let img = document.createElement('img');
        let hr = document.createElement('hr');
        divImg.setAttribute('id', id);
        divImg.setAttribute('class', 'takenImage');
        saveButton.setAttribute('onclick', 'savePicture(id)');
        saveButton.setAttribute('id', id);
        saveButton.setAttribute('class', 'green-btn');
        saveButton.innerHTML = 'Sauvegarder';
        deleteButton.setAttribute('onclick', 'deletePicture(id)');
        deleteButton.setAttribute('id', id);
        deleteButton.setAttribute('class', 'red-btn');
        deleteButton.innerHTML = 'Supprimer';
        img.setAttribute('src', imgURL);
        img.setAttribute('id', id);
        img.setAttribute('class', id);
        divImg.appendChild(img);
        divImg.appendChild(hr);
        divImg.appendChild(saveButton);
        divImg.appendChild(deleteButton);
        photos.insertBefore(divImg, photos.childNodes[0]);
});

/* -------------------- To remove all filters -------------------- */
clearFilters.addEventListener('click', function clearFilters() {
    clearFilter();
    if (imageUploaded == 1) {
        context.clearRect(0, 0, width, height);
        context.drawImage(imgUpldFilters, 0, 0, width, height);
    }
});

/* -------------------- To clean canvas -------------------- */
cleanCanvas.addEventListener('click', function() {
    context.clearRect(0, 0, width, height);
    clearFilter();
    uploadImg.value = "";
    imgUpldFilters = '';
    context.font = "30px Arial";
    context.textAlign = "center";
    context.fillStyle = "#333";
    context.fillText("Activer la caméra ou", width / 2, height / 2);
    context.fillText("télécharger une image.", (width / 2), (height / 2) + 30);
    clearFilters.style.display = 'none';
    takePictureDiv.style.display = 'none';
    cleanCanvas.style.display = 'none';
    imageUploaded = 0;
});

/* -------------------- To clear all taken pictures -------------------- */
clearButton.addEventListener('click', function () {
    photos.innerHTML = '';
});

/* -------------------- To delete picture -------------------- */
function deletePicture(id) {
    let element = document.getElementById(id);
    element.parentElement.removeChild(element);
}


/* -------------------- To save picture -------------------- */
function savePicture(id) {
    xhr = new XMLHttpRequest;
    let picture = document.getElementsByClassName(id);
    picture = picture[0];
    let data = new FormData;
    console.log(picture.src);
    data.append('picture', picture.src);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                deletePicture(id);
            } 
        }
    };

    xhr.open('POST', '../../Controller/Admin/Pictures/get_picture.php', true);
    xhr.send(data);
}