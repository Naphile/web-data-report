<?php
session_start();
include 'dbconnect.php';
$alert = '';

if(isset($_SESSION['role'])){
	header("location:index.php");
}

if(isset($_POST['btn-daftar']))
{
 $email = mysqli_real_escape_string($conn,$_POST['email']);
 $password = mysqli_real_escape_string($conn,$_POST['password']);

 //cek apakah email sudah pernah digunakan
$lihat1 = mysqli_query($conn,"select * from user where useremail='$email'");
$lihat2 = mysqli_num_rows($lihat1);
 
if($lihat2 < 1){
    //email belum pernah digunakan
    $insert = mysqli_query($conn,"insert into user (useremail,userpassword) values ('$email','$password')");
        
        //eksekusi query
        if($insert){
            echo "<div class='alert alert-success'>Berhasil mendaftar, silakan login.</div>
            <meta http-equiv='refresh' content='2; url= login.php'/>  ";
        } else {
            //daftar gagal
            echo "<div class='alert alert-warning'>Gagal mendaftar, silakan coba lagi.</div>
            <meta http-equiv='refresh' content='2'>";
        }

    }
 else
    {
    //jika email sudah pernah digunakan
    $alert = '<strong><font color="red">Email sudah pernah digunakan</font></strong>';
    echo '<meta http-equiv="refresh" content="2">';
    }
 
};




?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-144808195-1');
	</script>
    <script src="jquery.min.js"></script>
	<style>body{background-color:#ffffff;}
	@media screen and (max-width: 600px) {
h4{font-size:85%;}
}
.container{
	background-color:red;
	width:70%;
	border: 3px white;
	border-style:solid;
	border-radius:30px;
	padding-left:10%;
	padding-right:10%;
	padding-top:3%;
	padding-bottom:2%;
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

.btn{
	width:40%;
    background-color: #212121;
}
	</style>
	<link rel="icon" 
      type="image/png" 
      href="favicon.png">
  </head>
  <body>

  <a href="login.php" class="back-button">
		<button class="button">
			<p>Back</p>
		</button>
	</a>
  
  <div align="center">
  
  
  


	<br \><br \>
			<div class="container">
					<div style="color:white">
					<h1>Buat Akun</h1><br \>
                    <label><?php echo $alert ?></label>
					</div>
                <form method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn-daftar">Daftar</button>
                </form>
			
			<br \>
        </div></div>
       
     
	
	
  </body>
</html>
