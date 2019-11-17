/* -------------------- Global Vars -------------------- */
var camera = 0;

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
const context = canvas.getContext('2d');
const width = canvas.width;
const height = canvas.height;

cleanCanvas.style.display = 'none';
takePictureDiv.style.display = 'none';
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

/*
//----------------add filtre--------------------//
function addFilter(idFilter){
	filterTab.push(idFilter);
}
​
​
//---------------superpose filtre---------------------//
function drawFilter() 
{
		filterTab.forEach(function(filter)
		{
			ctx.drawImage(document.getElementById(filter), 0, 0, width, height);
		})
​
}
//----------------del filtre--------------------//
​
function deleteFilter() 
{
	if (filterTab != null)
	{
		filterTab.pop();
​
	}
	if (camm == 0 && fifi == 0)
	{
		// clearRect supprimant tout contenu précédemment dessiné
		ctx.clearRect(0, 0, width,height);
	}
}


var arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];

for( var i = 0; i < arr.length; i++){ 
   if ( arr[i] === 5) {
     arr.splice(i, 1); 
   }
}
*/


/* -------------------- To reproduce image in canvas -------------------- */
video.addEventListener("canplay", function setCanvas() {
    if (camera === 1) {
        context.drawImage(video, 0, 0, width, height);
        setTimeout(setCanvas, 0);
        startCameraButton.classList.remove('green-btn');
        startCameraButton.classList.add('red-btn');
        startCameraButton.innerHTML = 'Désactiver la webcam';
        takePictureDiv.style.display = 'block';
        formUpldImg.style.display = 'none';
        cleanCanvas.style.display = 'none';
    } else {
        startCameraButton.classList.remove('red-btn');
        startCameraButton.classList.add('green-btn');
        startCameraButton.innerHTML = 'Activer la webcam';
        context.font = "30px Arial";
        context.textAlign = "center";
        context.fillStyle = "#333";
        context.fillText("Activer la caméra ou", width / 2, height / 2);
        context.fillText("télécharger une image.", (width / 2), (height / 2) + 30);
        takePictureDiv.style.display = 'none';
    }
});

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

/* -------------------- When an image was upload -------------------- */
uploadImg.addEventListener('change', function(e) {
    let type = this.files[0].type;
    console.log(type);
    if (type == "image/png" || type == "image/gif" || type == "image/jpeg") {
        let upldImg = new Image;
        upldImg.onload = function() { context.drawImage(this, 0, 0, width, height); };
        upldImg.src = URL.createObjectURL(this.files[0]);
        takePictureDiv.style.display = 'block';
        cleanCanvas.style.display = 'block';
    } else {
        alert('Seul les images au format .png, .jpg - .jpeg, et .gif sont acceptés');
    }
    
})

/* -------------------- To clean canvas -------------------- */
cleanCanvas.addEventListener('click', function() {
    context.clearRect(0, 0, width, height);
    context.font = "30px Arial";
    context.textAlign = "center";
    context.fillStyle = "#333";
    context.fillText("Activer la caméra ou", width / 2, height / 2);
    context.fillText("télécharger une image.", (width / 2), (height / 2) + 30);
    takePictureDiv.style.display = 'none';
    cleanCanvas.style.display = 'none';
})

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
    console.log(id)
    xhr = new XMLHttpRequest;
    let picture = document.getElementsByClassName(id);
    picture = picture[0];
    let data = new FormData;
    data.append('picture', picture.src);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                deletePicture(id);
            } else
                console.log('error');
        }
    };

    xhr.open('POST', '../../Controller/Admin/Pictures/get_picture.php', true);
    xhr.send(data);
}