<!DOCTYPE html>
<html>
<head>
	<title>User Found</title>
</head>
<style>
body {
	min-height: 100vh;
	margin: 0;
	padding: 0;
	background: #0f2027;
	background: linear-gradient(135deg, #232526 0%, #0f2027 100%);
	font-family: 'Segoe UI', Arial, sans-serif;
	overflow-x: hidden;
}
#particles-js {
	position: fixed;
	width: 100vw;
	height: 100vh;
	top: 0;
	left: 0;
	z-index: 0;
}
.found-container {
	position: relative;
	z-index: 2;
	width: 430px;
	max-width: 95vw;
	margin: 60px auto;
	background: rgba(20, 30, 48, 0.85);
	border-radius: 20px;
	box-shadow: 0 0 30px 2px #00fff7, 0 0 0 4px #0ff2ff33;
	border: 2px solid #00fff7;
	padding: 38px 32px 32px 32px;
	color: #fff;
	text-align: center;
	backdrop-filter: blur(2px);
	font-size: 2rem;
}
.found-container a {
	color: #a259e6;
	font-size: 2rem;
	text-decoration: underline;
	margin-top: 18px;
	display: inline-block;
	transition: color 0.2s;
}
.found-container a:hover {
	color: #00fff7;
}
</style>
<body>
	<div id="particles-js"></div>
	<div class="found-container">
		<?php
			$conn = new mysqli("localhost","root","", "iwp");
			if($conn->connect_error)
			{
				die("<span style='color:red;'>Connection failed: ".$conn->connect_error."</span>");
			}
			$sql = "SELECT * from temp";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_row($result);
			$sql = "DELETE from temp";
			mysqli_query($conn, $sql);
			echo "Your password is: <b>".htmlspecialchars($row[0])."</b>";
		?>
		<br><br>
		<a href="user_login.php">Redirect to User Login</a>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
	<script>
	particlesJS('particles-js', {
	  "particles": {
		"number": {"value": 60, "density": {"enable": true, "value_area": 800}},
		"color": {"value": "#00fff7"},
		"shape": {"type": "polygon", "stroke": {"width": 0, "color": "#000"}, "polygon": {"nb_sides": 6}},
		"opacity": {"value": 0.3, "random": true},
		"size": {"value": 4, "random": true},
		"line_linked": {"enable": true, "distance": 150, "color": "#00fff7", "opacity": 0.2, "width": 1},
		"move": {"enable": true, "speed": 2, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false}
	  },
	  "interactivity": {
		"detect_on": "canvas",
		"events": {"onhover": {"enable": true, "mode": "repulse"}, "onclick": {"enable": true, "mode": "push"}, "resize": true},
		"modes": {"repulse": {"distance": 100, "duration": 0.4}, "push": {"particles_nb": 4}}
	  },
	  "retina_detect": true
	});
	</script>
</body>
</html>