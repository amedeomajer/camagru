const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");
const resetPasswordForm = document.getElementById("reset-password");
const activateForm = document.getElementById("activate-form");

const loginBtn = document.getElementById("loginBtn");
const registerBtn = document.getElementById("registerBtn");
const resetPassword = document.getElementById("forgot-password");
const activateSubmit = document.getElementById("activate");

loginBtn.addEventListener("click", function() {
    registerForm.style.display = "none";
    resetPasswordForm.style.display = "none";
    loginForm.style.display = "flex";
});

registerBtn.addEventListener("click", function() {
    loginForm.style.display = "none";
    resetPasswordForm.style.display = "none";
    registerForm.style.display = "flex";
});

resetPassword.addEventListener("click", function() {
    loginForm.style.display = "none";
    registerForm.style.display = "none";
    resetPasswordForm.style.display = "flex";
});

function confirmRegistration() {
    loginForm.style.display = "none";
    registerForm.style.display = "none";
    resetPasswordForm.style.display = "none";
}
// ################## GALLERY ################
let stop_scroll = 0;
let index = 0;
let xhr = new XMLHttpRequest();
xhr.open('GET', 'index.gallery.php?load_index='+index, true);
xhr.onload = function() {
	document.getElementById('gallery').innerHTML += this.response;
}
xhr.send();
index = index + 4;

window.onscroll = function() {
	if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight * 0.99) {
		let xhr = new XMLHttpRequest();
		xhr.open('GET', 'index.gallery.php?load_index='+index, true);

		if (stop_scroll == 0){
			xhr.onload = function() {
				let a = this.response;
				a = a.replace(/<\!--.+?-->/sg,"");
				var regExp = /[a-zA-Z]/g;
				if(regExp.test(a)) {
					document.getElementById('gallery').innerHTML += a;
				}
				else stop_scroll = 1;
			}
			xhr.send();
			index = index + 4;
		}
	}
}