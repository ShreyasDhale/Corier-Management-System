<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>

<body>
    <?php
    session_start();
    include("includes/header.php");
    include("includes/Connection.php");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $error = "";
        $trackid = $_POST['track'];
        $flg = $_POST['flag'];
        if (isset($_POST['sub'])) {
            $st = $conn->query("select trackid from parcel_info");
            $rs = $st->fetchAll(PDO::FETCH_COLUMN);
            if (in_array($trackid, $rs)) {
                if ($flg == 5) {
                    $stm = $conn->prepare("update parcel_info set flag=$flg,ddate=CURDATE(),dtime=CURRENT_TIMESTAMP(2) where trackid=$trackid");
                    $stm->execute();
                    $rs = $conn->query("select bdate,ddate,btime,dtime from parcel_info where trackid=$trackid");
                    $row = $rs->fetch();
                    $_SESSION['bdate'] = $row[0];
                    $_SESSION['ddate'] = $row[1];
                    $_SESSION['btime'] = $row[2];
                    $_SESSION['dtime'] = $row[3];
                    $msg = "update";
                    include("includes/success.php");
                } else {
                    $stm = $conn->prepare("update parcel_info set flag=$flg where trackid=$trackid");
                    $stm->execute();
                    $msg = "update";
                    include("includes/success.php");
                }
            } else
                $error = "Invalid Track Id Plese Enter Valid Track Id";
        }

    }
    ?><br><br>
    <center>
        <form class="login-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST"
            style="width: 50%; background-color: azure; padding: 20px; border-radius: 20px;">
            <h2 style="font-family: Arial;"><i class="nav-icon fas fa-boxes"></i> Update Parcel Status</h2><br>
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST")if ($error != "") { ?>
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
            <h4 style="float: left; font-family: Arial;">Enter Tracking Id To Update Status</h4><br>

            <input type="number" class="form-control" name="track" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                echo "$trackid"; ?>" required><br>
            <h4 style="float: left; font-family: Arial;">Select Status to Update</h4><br>
            <select name="flag" class="form-control" required>
                <option value="0">Item Accepted By Corier</option>
                <option value="1">Shipped</option>
                <option value="2">In Transit</option>
                <option value="3">Arrived at Destination</option>
                <option value="4">Out For Delevery</option>
                <option value="5">Delevered</option>
            </select><br>
            <input class="btn btn-success" type="submit" name="sub" value="Update" style="width: 40%;">
            <input class="btn btn-warning" type="reset" value="Clear" style="width: 40%;"><br>
            <br>

        </form><br><br>
    </center>
    <?php include("includes/footer.php"); ?>
</body>

</html>