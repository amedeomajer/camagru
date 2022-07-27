<?php
	require_once('../config/setup.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Loading</title>
	<style>

	#logo {
		color: white;
		text-shadow: 0px 14px 0 #ff9cd6, 0px 28px 0 #fef591, 0px 42px 0 #fa26a0, 0px 56px 0 #52ff8f;
		-webkit-text-shadow: 0px 14px 0 #ff9cd6, 0px 28px 0 #fef591;
		font-size: 200px;
		font-weight: bolder;
		font-family: sans-serif;
	}
	body {
		background-image: linear-gradient(to right, #fa26a0 0% 25%, #05dfd7 25% 50%, #a3f7bf 50% 75%, #fff591 75% 100%);
		padding-top: 20px;
	}
	div {
		width: 100%;
	}
	</style>
</head>
<body>
	<div>
		<h1 id="logo">CAMAGRU WORKING 4 U</h1>
	</div>
	<script>
		let logo = document.getElementById("logo");
		console.log(logo);
		
		let i = 3;
		setInterval(function(){
			let colors = [ "#ff9cd6", "#fef591", "#fa26a0", "#52ff8f"];
			logo.style.textShadow  = "0px 14px 0 " + colors[i % 4] + ", 0px 28px 0 " + colors[(i + 1) % 4] +", 0px 42px 0 " + colors[(i + 2) % 4] + ", 0px 56px 0 " + colors[(i + 3) % 4];
			i--;
			if (i === 0)
				i = 4;
			console.log(i);
		}, 400);
	</script>
</body>
</html>