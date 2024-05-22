<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <?php
    session_start();
    $_SESSION['flg'] = 0;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $error = "";
        $flg = 0;
        $str = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $contry = $_POST['contry'];
        $contact = $_POST['contact'];
        include("includes/Connection.php");
        $st = $conn->prepare("select contact from branch");
        $st->execute();
        $rs = $st->fetchAll(PDO::FETCH_COLUMN);
        $st1 = $conn->query("select zip from branch");
        $rs1 = $st1->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($contact, $rs) == 0) {
            if (in_array($zip, $rs) == 0){
                if (strlen($contact) == 10) {
                    if (strlen($zip) == 6) {
                        $st = $conn->prepare("insert into branch(building,city,state,zip,country,contact) values('$str','$city','$state',$zip,'$contry',$contact)");
                        $st->execute();
                        $flg = 1;
                        $_SESSION['flg'] = $flg;
                        $msg = "save";
                        include("includes/success.php");
                    } else
                        $error = "<strong>Cannot Add Branch !</strong> Zip Code should be of 6 Digit";
                } else
                    $error = "<strong>Cannot Add Branch !</strong> Phone Number Must Be of 10 Digit";
            } else
                $error = "<strong>Cannot Add Branch !</strong> Zip Code Already Exists";        
        } else
            $error = "<strong>Cannot Add Branch !</strong> Phone Number Already Exists";
    }
    ?>
    <style>
        .alert {
            display: none;
        }
    </style>
</head>


<body>
    <?php include("includes/header.php"); ?>

    <center>
        <section>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") if ($error != "") { ?>
                    <style>
                        .alert {
                            display: block;
                        }
                    </style>
            <?php }
            ?><br><br>
            <form class="login-form" style="background-color: azure; width: 80%; padding: 30px; border-radius: 20px;"
                action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <h1 style="size: 50px; padding-top: 20px; font-family: Arial;">
                    <b><i class="fa-regular fa-building"></i> Add New Branch</b>
                </h1><br><br>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= $error; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col g-3">
                        <h4 style="float: left;">Street/Building</h4>
                        <input type="text" name="street" placeholder="eg.Gandhi Road/Seva Sadan" class="form-control"
                            required>
                    </div>
                    <div class="col g-3">
                        <h4 style="float: left;">City</h4>
                        <input type="text" name="city" placeholder="Mumbai/Pune" class="form-control" required>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col g-3">
                        <h4 style="float: left;">State</h4>
                        <input type="text" name="state" placeholder="Maharashtra/Kerala" class="form-control" required>
                    </div>
                    <div class="col g-3">
                        <h4 style="float: left;">Zip-Code</h4>
                        <input type="number" name="zip" placeholder="413203" class="form-control" required>
                    </div>

                </div>
                <div class="row g-3">
                    <div class="col g-3">
                        <h4 style="float: left;">Country</h4>
                        <input type="text" name="contry" placeholder="India" class="form-control" required>
                    </div>
                    <div class="col g-3">
                        <h4 style="float: left;">#Contact</h4>
                        <input type="number" name="contact" placeholder="Your Branch Contact Number"
                            class="form-control" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px;">
                    <div class="col">
                        <input type="submit" value="Add Branch" class="btn btn-success form-control">
                    </div>
                    <div class="col">
                        <input type="reset" class="btn btn-warning form-control">
                    </div>
                </div><br>
            </form>
        </section>
    </center><br><br><br>
    <?php include("includes/footer.php") ?>
</body>

</html>