<html>

<head>
    <title>Login</title>
</head>
<style>
    @media only screen and (max-width: 600px) {}
</style>
<script src="https://kit.fontawesome.com/354b185ae5.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css">
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
session_start();
include ("initilize.php");
include ("includes/Connection.php");

$rs = $conn->query("SELECT id FROM `current_user`");
if (!$rs) {
    die("Error executing query: " . $conn->errorCode());
}

if ($rs->rowCount() > 0) {
    while ($row = $rs->fetch()) {
        echo $row[0];
        if ($row[0] != NULL) {
            echo $row[0];
            $rs1 = $conn->query("select id,email,password,user,isAdmin from login where id = $row[0]");
            if (!$rs1) {
                die("Error executing query: " . $conn->errorCode());
            }

            if ($rs1->rowCount() > 0) {
                echo $row[0];
                while ($row = $rs1->fetch()) {
                    if ($row[4] == 1) {
                        $_SESSION['usr'] = $row[3];
                        $_SESSION['adid'] = $row[0];
                        header("location:AdminHome.php");
                        exit;
                    } else {
                        $_SESSION['usr'] = $row[3];
                        $_SESSION['adid'] = $row[0];
                        header("location:parcels.php");
                        exit;
                    }
                }
            } else {
                $error = " Invalid Email";
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $error = "";
    $user = $_POST['usr'];
    $pass = $_POST['psw'];
    setcookie('user', $user);
    setcookie('pass', $pass);

    $rs = $conn->query("select id,email,password,user,isAdmin from login where user='$user'");
    if (!$rs) {
        die("Error executing query: " . $conn->errorCode());
    }

    if ($rs->rowCount() > 0) {
        while ($row = $rs->fetch()) {
            if ($row[4] == 1) {
                if (strcmp($row[2], $pass) == 0) {
                    $_SESSION['usr'] = $row[3];
                    $_SESSION['adid'] = $row[0];

                    $insertQuery = $conn->prepare("INSERT INTO `current_user` (`id`) VALUES ($row[0]);");

                    if ($insertQuery->execute()) {
                        echo "Record inserted successfully!<br>";
                    } else {
                        echo "Error inserting record: " . $conn->errorCode() . "<br>";
                    }
                    header("location:AdminHome.php");
                    exit;
                } else {
                    $error = " Invalid Password";
                }
            } else {
                if (strcmp($row[2], $pass) == 0) {
                    $_SESSION['usr'] = $row[3];
                    $_SESSION['adid'] = $row[0];

                    $insertQuery = $conn->prepare("INSERT INTO `current_user` (`id`) VALUES ($row[0]);");

                    if ($insertQuery->execute()) {
                        echo "Record inserted successfully!<br>";
                    } else {
                        echo "Error inserting record: " . $conn->errorCode() . "<br>";
                    }
                    header("location:parcels.php");
                    exit;
                } else {
                    $error = " Invalid Password";
                }
            }
        }
    } else {
        $error = " Invalid Email";
    }
}

?>

<body>
    <center>
        <div class="login-form" style="width: 700px;">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method=POST>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") if ($error != "") { ?>
                        <style>
                            .alert {
                                display: block;
                            }
                        </style>
                <?php }
                ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Login Failed</strong>
                    <?= $error; ?>
                    <button type="button" style="padding-left: 5px;" class="close" data-dismiss="alert"
                        aria-label="Close" style="float: right;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h1 style="font-family: cursive;">Login</h1>
                <h3 style="font-family: cursive;">Corier Management System</h3>
                <img src="Images/logo2.png" style="height: 100px ;width: 100px; border-radius: 50%;"><br><br>
                <h3 class="text-center" style="float: left;">Enter User Name</h3><input type="text" class="form-control"
                    style="font-size: medium" name=usr placeholder="abc@123" required><br>
                <h3 class="text-center" style="float: left;">Enter Password</h3><input type="password"
                    style="font-size: medium" class="form-control" name=psw required><br>
                <input type="submit" class="btn btn-primary btn-block" value="Login" style="width: 100%;"> <br>
                <a href="email.php"
                    style="text-decoration: none; float: left; padding-top: 13px; font-size: 15px;">Forgot Password
                    ?</a><br><br><a href="signup.php"
                    style="text-decoration: none; float: left; font-size: 15px;">Signup ?
                </a><br>
            </form>
        </div>
    </center>
</body>

</html>