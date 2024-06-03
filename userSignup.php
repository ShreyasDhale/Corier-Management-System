<?php
echo "<br>";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass1'];
    $addr = $_POST['addr1'];
    $addr1 = $_POST['addr2'];
    $error = "";

    include("includes/Connection.php");
    $st = $conn->prepare("select user from userlogin");
    $rs = $st->fetchAll(PDO::FETCH_COLUMN);
    if (in_array($user, $rs) != true) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
            if ($pass == $pass1) {
                $st = $conn->exec("insert into login(email,password,name,user,address,address1,contact) values('$email','$pass','$fname','$user','$addr','$addr1',$phone)");
                $msg = "save";
                include("includes/success.php");

            } else
                $error = "Password dose not match";
        } else
            $error = "Please Enter a valid Email";
    } else
        $error = "Username is already used";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://kit.fontawesome.com/354b185ae5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    @media screen and (min-width: 400px) {
        body {
            background-color: lightgray;
            width: 100%;
        }
    }

    .error {
        color: red;
        float: left;
    }

    .login {
        font-size: 13;
        font-family: cursive;
    }

    .login-form {
        width: 80%;
        margin: 50px auto;
    }

    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 20px;
    }

    .login-form h3 {
        margin: 0 0 15px;
    }

    .form-control,
    .btn {
        min-height: 38px;
        border-radius: 2px;
        padding-bottom: 10px;
    }

    .btn {
        padding-top: 10px;
        font-size: 15px;
        font-weight: bold;
    }

    .alert {
        display: none;
    }
</style>

<body>

    <div class="login-form">
        <center>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">

                <h1 style="font-family: arial;">Signup</h1>
                <h3 style="font-family: arial;">Swift Dispatch</h3>
                <img src="Images/logo2.png" style="height: 100px ;width: 100px; border-radius: 50%;"><br><br>
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
                <div class="row g-3">
                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Enter Full
                            Name</label> <input type="text" class="form-control" placeholder="eg . Shreyas Vinay Dhale"
                            name="fname" required>
                    </div>
                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Contact
                            Number</label><input type="number" onkeyup="phoneno()" id="cont" placeholder="1234567890"
                            class="form-control" name="phone" required>
                        <div id="phone" class="error"></div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Enter
                            Email</label> <input type="email" class="form-control" placeholder="abc123@gmail.com"
                            name="email" required>
                    </div>
                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Unique user
                            name</label> <input type="text" class="form-control" onkeyup="username()" id="user"
                            placeholder="shreyas@123" name="user" required>
                        <div id="usr" class="error"></div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label class="text-center col-form-label"
                            style="float: left; font-weight: bolder;">Address1</label> <input type="text"
                            class="form-control" placeholder="Bulding,City,State,Country" name="addr1" required>
                    </div>

                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Enter
                            Password</label> <input type="password" class="form-control" onkeyup="password()" id="pass"
                            name="pass" required>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label class="text-center col-form-label"
                            style="float: left; font-weight: bolder;">Address2</label> <input type="text"
                            class="form-control" placeholder="Optional" placeholder="Bulding,City,State,Country"
                            name="addr2">
                    </div>

                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Confirm
                        </label> <input type="password" class="form-control" onkeyup="password1()" id="pass1"
                            name="pass1" required>
                        <div id="pas1" class="error"></div><br>
                    </div>
                </div><br>
                <input type="submit" id="btn" class="btn btn-primary btn-block form-control"
                    style="float: left;"><br><br><br>

                <a href="index.php" style="text-decoration: none; display: block; float: left;">Login</a><br>
            </form>
        </center>
    </div>
</body>

</html>