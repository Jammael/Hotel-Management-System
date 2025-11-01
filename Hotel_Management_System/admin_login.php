<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
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
.login-container {
	position: relative;
	z-index: 2;
	width: 370px;
	max-width: 95vw;
	margin: 80px auto;
	background: rgba(20, 30, 48, 0.85);
	border-radius: 20px;
	box-shadow: 0 0 30px 2px #00fff7, 0 0 0 4px #0ff2ff33;
	border: 2px solid #00fff7;
	padding: 40px 32px 32px 32px;
	color: #fff;
	text-align: center;
	backdrop-filter: blur(2px);
}
.login-container h2 {
	font-size: 2.2rem;
	color: #00fff7;
	margin-bottom: 10px;
	letter-spacing: 1px;
}
.login-table {
	width: 100%;
	margin: 0 auto 10px auto;
}
.login-table td {
	text-align: left;
	padding: 10px 0 10px 0;
	font-size: 1.1rem;
	color: #b2f7ef;
}
.input {
	font-size: 1rem;
	width: 100%;
	padding: 10px 12px;
	margin-top: 4px;
	margin-bottom: 2px;
	border-radius: 8px;
	border: 1px solid #00fff7;
	background: rgba(255,255,255,0.08);
	color: #fff;
	outline: none;
	box-sizing: border-box;
	transition: border 0.2s, box-shadow 0.2s;
}
.input:focus {
	border: 1.5px solid #00fff7;
	box-shadow: 0 0 8px #00fff7;
	background: rgba(0,255,247,0.08);
}
.button {
	width: 100%;
	padding: 12px 0;
	background: #00fff7;
	color: #232526;
	border: none;
	border-radius: 8px;
	font-size: 1.2rem;
	font-weight: bold;
	margin-top: 18px;
	margin-bottom: 10px;
	cursor: pointer;
	box-shadow: 0 0 10px #00fff7;
	transition: background 0.2s, color 0.2s;
}
.button:hover {
	background: #232526;
	color: #00fff7;
	box-shadow: 0 0 18px #00fff7;
}
.login-links {
	display: flex;
	justify-content: space-between;
	margin-top: 10px;
	font-size: 0.98rem;
}
.login-links a {
	color: #00fff7;
	text-decoration: none;
	transition: color 0.2s;
}
.login-links a:hover {
	color: #fff;
	text-decoration: underline;
}
</style>
<body>
		<?php include_once 'pill_nav.php'; pill_nav(); ?>
		<div id="particles-js"></div>
		<div class="login-container">
			<h2>Admin Login</h2>
			<form action="admin_db.php" method="post">
			<table class="login-table">
				<tr>
					<td>User ID:</td>
					<td><input class="input" type="text" name="adminid" placeholder="Enter user ID" required></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input class="input" type="password" name="password" placeholder="Enter password" required></td>
				</tr>
				<tr>
					<td colspan="2"><input class="button" type="submit" value="Login"></td>
				</tr>
			</table>
		</form>
		<div class="login-links">
			<a href="admin_signup.php">Sign Up</a>
			<a href="admin_forgot_pwd.php">Forgot Password?</a>
		</div>
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