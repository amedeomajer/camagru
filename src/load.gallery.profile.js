// ###################### LOAD GALLERY ####################

let index = 0;

let xhr = new XMLHttpRequest();
xhr.open('GET', 'gallery.profile.php?load_index='+index, true);
xhr.onload = function() {
	document.getElementById('test').innerHTML += this.response;
}
xhr.send();
index = index + 4;

window.onscroll = function() {
	if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
		let xhr = new XMLHttpRequest();
		xhr.open('GET', 'gallery.profile.php?load_index='+index, true);
		
		xhr.onload = function() {
			let a = this.response;
			a = a.replace(/<\!--.+?-->/sg,"");
			var regExp = /[a-zA-Z]/g;
			if(regExp.test(a)) {
				document.getElementById('test').innerHTML += a;
			}
		}
		xhr.send();
		index = index + 4;
	}
}