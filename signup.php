<?php
include ("Includes/header.php");

echo "<br>";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $sal = $_POST['sal'];
    $phone = $_POST['cont'];
    $br = $_POST['br'];
    $error = "";

    include ("includes/Connection.php");
    $st = $conn->query("select user from staff");
    $rs = $st->fetchAll(PDO::FETCH_COLUMN);
    if (in_array($user, $rs) != true) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
            if ($sal > 2000) {
                try {
                    $st = $conn->prepare("insert into `staff`(email,name,cont,user,branch_id,Salary) values('$email','$fname','$phone','$user','$br',$sal)");
                    $st->execute();
                    $msg = "save";
                    include ("includes/success.php");
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else
                $error = "Minimum Salary is Rs 2000";
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

                <h1 style="font-family: arial;"><i class="fa-solid fa-users"></i> Add Staff</h1>
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
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Enter
                            Email</label> <input type="email" class="form-control" placeholder="abc123@gmail.com"
                            name="email" required>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Select
                            Branch To Be Assigned</label>
                        <select name="br" class="form-select">
                            <option value="Select">Select Branch Here</option>
                            <?php
                            include ("includes/Connection.php");
                            $st = $conn->prepare("select city from branch");
                            $st->execute();
                            $rs = $st->fetchAll(PDO::FETCH_COLUMN);
                            for ($i = 0; $i < count($rs); $i++) {

                                echo "<option value=$rs[$i]>$rs[$i]</option>";

                            }
                            ?>
                        </select>
                    </div>

                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Contact
                            Number</label> <input type="number" class="form-control" onkeyup="phoneno()" id="cont"
                            name="cont" required>
                        <div id="phone" style="color: red;float: left;"></div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label class="text-center col-form-label" style="float: left; font-weight: bolder;">Unique user
                            name</label> <input type="text" class="form-control" onkeyup="username()" id="user"
                            placeholder="shreyas@123" name="user" required>
                        <div id="usr" class="error"></div>
                    </div>
                    <div class="col">
                        <label class="text-center col-form-label"
                            style="float: left; font-weight: bolder;">Salary</label> <input type="number"
                            class="form-control" placeholder="Optional" placeholder="Bulding,City,State,Country"
                            name="sal">
                    </div>
                </div><br>
                <input type="submit" id="btn" class="btn btn-primary btn-block form-control"
                    style="float: left;"><br><br><br>
            </form>
        </center>
    </div>
</body>

</html>