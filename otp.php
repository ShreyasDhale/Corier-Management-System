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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<script>
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>
<style>
	.alert {
		display: none;
	}
</style>
<?php
echo '<script>alert("OTP Sent Check your mail")</script>';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	session_start();
	$error = "";
	include("includes/Connection.php");
	$email = $_SESSION['email'];
	$rs = $conn->Query("select otp from adminlogin where email='$email'");

	$otp1 = $_POST['otp'];
	while ($otp = $rs->fetch()) {
		if ($otp1 == $otp[0]) {
			$st = $conn->prepare("update adminlogin set otp=NULL");
			$st->execute();
			header("location:resetpass.php");
		} else
			$error = "Plese Enter Valid OTP";
	}
	if ($_SERVER['REQUEST_METHOD'] == "POST")if ($error != "") { ?>
			<style>
				.alert {
					display: block;
				}
			</style>
	<?php }
}
?>

<body>
	<center>
		<div class="login-form" style="width: 700px;">
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">

				<h1 style="font-family: cursive;">Corier Management System</h1>
				<h3 style="font-family: cursive;">ADMIN-Login</h3>
				<img src="Images/logo2.png" style="height: 100px ;width: 100px; border-radius: 50%;"><br><br>
				<h2 class="text-center">Enter OTP</h2>
				<div class="form-group">
					<input type="number" name="otp" class="form-control" placeholder="OTP" required>
				</div><br>

				<div class="alert alert-danger alert-dismissible fade show">
					<strong>Login Failed</strong>
					<?= $error; ?>
					<button type="button" style="padding-left: 5px;" class="close" data-dismiss="alert"
						aria-label="Close" style="float: right;">
						<span aria-hidden="true">&times;</span>
					</button><br>
				</div>
				<div class="form-group" style="padding-top: 5px;">
					<button type="submit" class="btn btn-primary btn-block form-control">Submit OTP</button>
				</div>

			</form>
		</div>
	</center>
</body>

</html>