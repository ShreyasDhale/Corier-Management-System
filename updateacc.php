<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="script.js"></script>

    <style>
        .alert {
            display: none;
        }
    </style>
</head>

<body>
    <?php include("includes/header.php"); ?><br><br>
    <?php
    include("includes/Connection.php");
    $usr = $_SESSION['usr'];
    $error = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $phone = $_POST['cont'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if ($pass1 == $pass2){
            $st=$conn->prepare("update adminlogin set contact='$phone',email='$email',password='$pass1' where user='$usr'");
            $st->execute();
            $msg="update";
            include("includes/success.php");
        }
        else
            $error = "Password Dose Not Match";
    }
    ?>
    <center>
        <form class="login-form" style="background-color: azure; width: 50%; padding: 20px;"
            action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <h2 style="font-family: Arial;"><i class="fa-solid fa-user-pen"></i><strong> Account Settings</strong></h2>
            <br>
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST") if ($error != "") { ?>
                    <style>
                        .alert {
                            display: block;
                        }
                    </style>
            <?php } ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $error; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h4 style="float: left;">Username</h4>
            <input type="text" class="form-control" value="<?= $usr ?>" disabled><br>
            <input type="number" class="form-control" id="cont" onkeyup="phoneno()" name="cont"
                placeholder="Contact Number" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                    echo $phone ?>" required>
                <div id="phone" style="float: left; color:red"></div><br>
                <input type="email" class="form-control" placeholder="E-mail" name="email" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                    echo $email ?>" required><br>
                <input type="Password" class="form-control" id="pass" onkeyup="password()" name="pass1"
                    placeholder="Update Password" required>
                <div id="pas" style="float: left; color:red"></div><br>
                <input type="Password" class="form-control" id="pass1" onkeyup="password1()" name="pass2"
                    placeholder="Confirm Password" required>
                <div id="pas1" style="float: left; color:red"></div><br>
                <input type="submit" class="btn btn-success" id="btn" value="Update" style="width: 100px;">
                <input type="reset" class="btn btn-danger" value="Clear" style="width: 100px;">
            </form>
        </center><br><br>
    <?php include("includes/footer.php"); ?>
</body>

</html>