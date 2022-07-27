let pictureExist = false;
let stickerOn = 0;
// elements
let video = document.getElementById("videoElement");
let canvas = document.getElementById("canvas");
let stickerPreview = document.getElementById("sticker-preview");
let stickerPreview2 = document.getElementById("sticker-preview2");
let uploadButton = document.getElementById("upload");
let cameraHideAndShow = document.getElementById("camera-icon");
let selfieContainer = document.getElementById("selfie-container");
let clearCanvasBtn = document.getElementById("clear-canvas");
let uploadFileContainer = document.getElementById("upload-file-container");
let UploadFileContainerHideAndShow = document.getElementById("show-hide-upload-file-container");
let shutter = document.getElementById("shutter");
// stickers
let everyday69sticker = document.getElementById("everyday69");
let boomerSticker = document.getElementById("boomer");
let gid95sticker = document.getElementById("gid95");
let tutanSticker = document.getElementById("tutan");
let upAndDownSticker = document.getElementById("up-and-down");

// stickers path array
const stickersPaths = new Array(
	"../img/stickers/everyday69.png",
	"../img/stickers/boomer.png",
	"../img/stickers/getting-it-done.png",
	"../img/stickers/tutankhamon.png",
	"../img/stickers/up_and_down.png"
);



cameraHideAndShow.addEventListener("click", function() {
	if (navigator.mediaDevices.getUserMedia) {
		navigator.mediaDevices
			.getUserMedia({ video: true })
			.then(function(stream) {
				video.srcObject = stream;
			})
			.catch(function(err0r) {
				alert("Can't access webcam!");
			});
	}
	var textareaList = document.getElementsByTagName("textarea");
	for (var i = 0; i < textareaList.length; i++) {
		textareaList[i].value = "";
	}
	if (selfieContainer.style.display == "flex") {
		selfieContainer.style.display = "none";
		clearCanvas();
	} else {
		uploadFileContainer.style.display = "none";
		selfieContainer.style.display = "flex";
	}
});

shutter.addEventListener("click", function() {
	canvas.getContext("2d").drawImage(video, 0, 0, 400, 300);
	let img = canvas.toDataURL("image/png");
	document.getElementById("base64").value = img;
	pictureExist = true;
	if (stickerOn === 1 || stickerOn == 2) {
		uploadButton.style.display = "block";
		shutter.style.display = "none";
	}
	clearCanvasBtn.style.display = "block";
});

clearCanvasBtn.addEventListener("click", () => clearCanvas());

function clearCanvas() {
	var textareaList = document.getElementsByTagName("textarea");
	for (var i = 0; i < textareaList.length; i++) {
		textareaList[i].value = "";
	}
	document.getElementById("sticker1").value = "";
	document.getElementById("sticker2").value = "";
	stickerPreview.style.backgroundImage = "none";
	stickerPreview2.style.backgroundImage = "none";
	context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
	clearCanvasBtn.style.display = "none";
	uploadButton.style.display = "none";
	shutter.style.display = "none";
	pictureExist = false;
};

everyday69sticker.addEventListener("click", () => addSticker(0));
boomerSticker.addEventListener("click", () => addSticker(1));
gid95sticker.addEventListener("click", () => addSticker(2));
tutanSticker.addEventListener("click", () => addSticker(3));
upAndDownSticker.addEventListener("click", () => addSticker(4));

function addSticker(i) {
	stickerOn++;
	if(uploadButton.style.display != "block")
		shutter.style.display = "block";
	if (stickerOn === 3) stickerOn = 1;
	if (stickerOn === 2) {
		stickerPreview.style.backgroundImage = "url(" + stickersPaths[i] + ")";
		document.getElementById("sticker2").value = stickersPaths[i];
		if (pictureExist === true) uploadButton.style.display = "block";
	} else if (stickerOn === 1) {
		stickerPreview2.style.backgroundImage = "url(" + stickersPaths[i] + ")";
		document.getElementById("sticker1").value = stickersPaths[i];
		if (pictureExist === true) {
			uploadButton.style.display = "block";
			shutter.style.display = "none";
		}
	}
}

// ########################  UPLOAD FILE ################### //

let everyday69sticker_2 = document.getElementById("everyday69_2");
let boomerSticker_2 = document.getElementById("boomer_2");
let gid95sticker_2 = document.getElementById("gid95_2");
let tutanSticker_2 = document.getElementById("tutan_2");
let upAndDownSticker_2 = document.getElementById("up-and-down_2");
let stickerPreview_upload = document.getElementById("sticker-preview_upload");
let stickerPreview2_upload = document.getElementById("sticker-preview2_upload");
let fileUploadButton = document.getElementById("upload-file-button");
let stickerOn_2 = 0;

everyday69sticker_2.addEventListener("click", () => addSticker_2(0));
boomerSticker_2.addEventListener("click", () => addSticker_2(1));
gid95sticker_2.addEventListener("click", () => addSticker_2(2));
tutanSticker_2.addEventListener("click", () => addSticker_2(3));
upAndDownSticker_2.addEventListener("click", () => addSticker_2(4));

fileUploadButton.addEventListener("click", function() {
	let uploaImage = document.getElementById("img-file-preview");
	canvas.getContext("2d").drawImage(uploaImage, 0, 0, 400, 300);
	let img = canvas.toDataURL("image/png");
	document.getElementById("base64_2").value = img;
});

function addSticker_2(i) {
	stickerOn_2++;
	if (stickerOn_2 === 3) stickerOn_2 = 1;
	if (stickerOn_2 === 2) {
		stickerPreview_upload.style.backgroundImage = "url(" + stickersPaths[i] + ")";
		document.getElementById("sticker2_2").value = stickersPaths[i];
	} else if (stickerOn_2 === 1) {
		stickerPreview2_upload.style.backgroundImage = "url(" + stickersPaths[i] + ")";
		document.getElementById("sticker1_2").value = stickersPaths[i];
	}
}

UploadFileContainerHideAndShow.addEventListener("click", function() {
	var textareaList = document.getElementsByTagName("textarea");
	for (var i = 0; i < textareaList.length; i++) {
		textareaList[i].value = "";
	}
	if (uploadFileContainer.style.display === "flex") {
		uploadFileContainer.style.display = "none";
	} else {
		clearCanvas();
		selfieContainer.style.display = "none";
		uploadFileContainer.style.display = "flex";
	}
});

function showPreview(event) {
	if (event.target.files.length > 0) {
		let src = URL.createObjectURL(event.target.files[0]);
		let preview = document.getElementById("img-file-preview");
		preview.src = src;
	}
}