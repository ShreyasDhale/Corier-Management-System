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
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    $error = "";
    include("includes/Connection.php");
    $oldpass = $_SESSION['old_pass'];
    $email = $_SESSION['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 != $oldpass) {
        if ($pass1 == $pass2) {
            $st = $conn->prepare("update adminlogin set password='$pass1' where email='$email'");
            $st->execute();
            $msg = "update";
            include("includes/success.php");
        } else
            $error = "Password Dosent Match";
    } else
        $error = "Your Old Password Cannot be your New Password";
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

                <h1 style="font-family: cursive;">Swift Dispatch</h1>
                <h3 style="font-family: cursive;">ADMIN-Login</h3>
                <img src="Images/logo2.png" style="height: 100px ;width: 100px; border-radius: 50%;"><br><br>
                <h2 class="text-center">Create New Password</h2>
                <div class="form-group">
                    <input type="password" name="pass1" class="form-control" placeholder="New Password" required>
                </div><br>
                <h2 class="text-center">Confirm New Password</h2>
                <div class="form-group">
                    <input type="password" name="pass2" class="form-control" placeholder="New Password Confirm"
                        required>
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
                    <button type="submit" class="btn btn-primary btn-block form-control">Reset</button>
                </div>
                <a href="login.php" style="float: left;text-decoration: none;margin-top: 6px;font-weight: bolder;">Login</a><br>

            </form>
        </div>
    </center>
</body>

</html>