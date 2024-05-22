<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script src="https://kit.fontawesome.com/354b185ae5.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
		.alert {
			display: none;
		}
	</style>
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>

</head>

<body>
	<center>
		<div class="login-form" style="width: 700px;">
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">

				<h1 style="font-family: cursive;">Corier Management System</h1>
				<h3 style="font-family: cursive;">Reset Password using OTP</h3>
				<img src="Images/logo2.png" style="height: 100px ;width: 100px; border-radius: 50%;"><br><br>
				<h2 class="text-center" style="float: left;">Log in</h2><br><br>

				<div class="form-group first_box">
					<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
				</div><br>

				<div class="alert alert-danger alert-dismissible fade show">
					<strong>Login Failed</strong>
					<?= $error; ?>
					<button type="button" style="padding-left: 5px;" class="close" data-dismiss="alert"
						aria-label="Close" style="float: right;">
						<span aria-hidden="true">&times;</span>
					</button><br>
				</div>

				<div class="form-group first_box" style="padding-top: 5px;">
					<button type="submit" class="btn btn-primary btn-block form-control">Send OTP</button>
				</div>

				<?php
				session_start();
				$error = "";
				use PHPMailer\PHPMailer\PHPMailer;
				use PHPMailer\PHPMailer\Exception;

				require 'vendor/phpmailer/phpmailer/src/Exception.php';
				require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
				require 'vendor/phpmailer/phpmailer/src/SMTP.php';

				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					include("includes/Connection.php");
					$otp = rand(100000, 999999);
					$_SESSION['otp'] = $otp;
					$email = $_POST['email'];
					$rs = $conn->Query("select id,email,password from adminlogin where email='$email'");
					$row = $rs->fetch();
					$_SESSION['old_pass']=$row[2];
					$st = $conn->prepare("update adminlogin set otp=$otp where email='$email'");
					$st->execute();
					if ($rs->rowCount() > 0) {

						$mail = new PHPMailer();
						$mail->SMTPDebug = 3;
						$mail->isSMTP();
						$mail->SMTPAuth = true;
						$mail->SMTPSecure = 'tls';
						$mail->Host = "smtp.gmail.com";
						$mail->Port = 587;
						$mail->IsHTML(true);
						$mail->Username = "shreyasdhale100@gmail.com";
						$mail->Password = "xegcgckigjsptvoo";
						$mail->SetFrom("shreyasdhale100@gmail.com");
						$mail->Subject = "Login OTP for Courier Management System";
						$mail->Body = "<b>Your OTP for Login is<b> <h1>" . $otp . "</h1></b>";
						$mail->AddAddress("$email");
						header("location:otp.php");
						$_SESSION['old_pass'] = $row[1];
						$_SESSION['id'] = $row[0];
						if (!$mail->Send()) {
							header("location:email.php");
							echo "error";
						}
					} else {
						$error = "Admin Not Found Plese Enter Valid Email";
					}
					$_SESSION['email'] = $email;
				}
				if ($_SERVER['REQUEST_METHOD'] == "POST")if ($error != "") { ?>
						<style>
							.alert {
								display: block;
							}
						</style>
				<?php }
				?>
			</form>
		</div>
	</center>
</body>

</html>