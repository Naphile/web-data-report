<?php
session_start();
include 'dbconnect.php';
$alert = '';

if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];

	if ($role == 'Admin') {
		header("location:admin");
	} else {
		header("location:user");
	}
}


if (isset($_POST['btn-login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	// menyeleksi data user dengan username dan password yang sesuai
	$cariadmin = mysqli_query($conn, "select * from admin where adminemail='$email' and adminpassword='$password';");
	$cariuser = mysqli_query($conn, "select * from user where useremail='$email' and userpassword='$password';");

	// menghitung jumlah data yang ditemukan
	$cekadmin = mysqli_num_rows($cariadmin);
	$cekuser = mysqli_num_rows($cariuser);

	// cek apakah username dan password di temukan pada database
	if ($cekadmin > 0) {

		//jika admin
		$data = mysqli_fetch_assoc($cariadmin);

		// buat session login dan username
		$_SESSION['email'] = $data['adminemail'];
		$_SESSION['role'] = "Admin";
		header("location:admin");
	} else if ($cekuser > 0) {
		//jika user biasa
		$data = mysqli_fetch_assoc($cariuser);

		// buat session login dan username
		$_SESSION['email'] = $data['useremail'];
		$_SESSION['userid'] = $data['userid'];
		$_SESSION['role'] = "User";
		header("location:user");
	} else {
		//jika user tidak ditemukan
		echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
	}
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-144808195-1');
	</script>
	<script src="jquery.min.js"></script>
	<style>
		body {
			background-color: #fff;
		}

		@media screen and (max-width: 600px) {
			h4 {
				font-size: 85%;
			}
		}

		.back-button {
			display: inline-block;
            text-decoration: none;
		}

		.back-button:hover {
			text-decoration: none;
		}

		.button {
			all: unset;
			display: flex;
			align-items: center;
			position: relative;
			padding: 0em 1em;
			border: black solid 0.15em;
			border-radius: 0.25em;
			color: white;
			font-size: 1.5em;
			font-weight: 600;
			cursor: pointer;
			overflow: hidden;
			transition: border 300ms, color 300ms;
			user-select: none;
			margin-left: 20px;
			margin-top: 20px;
			text-align: center;
			text-decoration: none;
			background-color: #212121;
		}

		.button p {
			z-index: 1;
			margin: 0;
			text-decoration: none;
		}

		.button:hover {
			color: #212121;
		}

		.button:active {
			border-color: #212121;
		}

		.button::before {
			content: "";
			position: absolute;
			width: 9em;
			aspect-ratio: 1;
			background: #ffff;
			opacity: 50%;
			border-radius: 50%;
			transition: transform 500ms, background 300ms;
			text-decoration: none;
		}

		.button::before {
			left: 0;
			transform: translateX(-8em);
		}

		.button::after {
			right: 0;
			transform: translateX(8em);
		}

		.button:hover:before {
			transform: translateX(-1em);
		}

		.button:hover:after {
			transform: translateX(1em);
		}

		.button:active:before,
		.button:active:after {
			background: #ffff;
		}

		.container {
			background-color: red;
			width: 70%;
			border: 3px white;
			border-style: solid;
			border-radius: 30px;
			padding-left: 10%;
			padding-right: 10%;
			padding-top: 3%;
			padding-bottom: 2%;
		}

		.btn {
			width: 40%;
			background-color: #212121;
		}
	</style>
	<link rel="icon" type="image/png" href="favicon.png">
</head>

<body>

	<a href="index.php" class="back-button">
		<button class="button">
			<p>Back</p>
		</button>
	</a>

	<div align="center">




		<h1>TELKOM REPORT SYSTEM</h1>

		<br \><br \>
		<div class="container">
			<div style="color:white">
				<label>LOGIN</label><br \>
			</div>
			<form method="post">
				<div class="form-group">
					<input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password" required>
				</div>
				<button type="submit" class="btn btn-primary" name="btn-login">Login</button>
				<a class="btn btn-info text-light" href="register.php">Sign up</a>
			</form>

			<br \>
		</div>
	</div>




</body>

</html>