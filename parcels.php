<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var html = '<tr><td><input placeholder="In Feet" class="form-control" type="number" name="height[]" required></td><td><input placeholder="In Feet" class="form-control" type="number" name="Width[]" required></td><td><input placeholder="In Feet" class="form-control" type="number" name="Length[]" required></td><td><input placeholder="In KG" class="form-control" type="number" name="Weight[]" required></td><td><input class="btn btn-danger form-control" type="button" id="remove" value="Remove"></td></tr>';
            var x = 1;
            var max = 3;
            $("#add").click(function () {
                if (x <= max) {
                    $("#table_field").append(html);
                    x++;
                }
            });
            $("#table_field").on('click', '#remove', function () {
                $(this).closest('tr').remove();
                x--;
            });
        });
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
    <section class="container1">
        <?php
        include ("includes/header.php");
        include ("CalculateBill.php");
        if (isset($_POST['bt'])) {
            $error = "";
            $flg = 0;
            include ("includes/Connection.php");
            $height = $_POST['height'];
            $width = $_POST['Width'];
            $length = $_POST['Length'];
            $weight = $_POST['Weight'];

            $sname = $_POST['sname'];
            $saddr = $_POST['saddr'];
            $scont = $_POST['scont'];
            $rname = $_POST['rname'];
            $raddr = $_POST['raddr'];
            $rcont = $_POST['rcont'];

            $from = $_POST['from'];
            $to = $_POST['to'];
            $usrid = $_SESSION['adid'];
            $total = 0;

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (strcmp($saddr, $raddr) != 0) {
                    if (strlen($scont) == 10 && strlen($rcont) == 10) {
                        if (strcmp($scont, $rcont) != 0) {
                            if ($to != "Select" && $from != "Select") {
                                if ($from != $to) {
                                    for ($i = 0; $i < count($height); $i++)
                                        $total += calculateBill($height[$i], $width[$i], $length[$i], $weight[$i], 200);
                                    $_SESSION['bill'] = $total;
                                    $st = $conn->prepare("insert into parcelform(sname,saddr,scont,rname,raddr,rcont,frombr,tobr,bill) values('$sname','$saddr',$scont,'$rname','$raddr',$rcont,'$from','$to',$total)");
                                    if($st->execute()){
                                    }else {
                                        echo "".$conn->errorInfo();
                                    }
                                    for ($i = 0; $i < count($height); $i++) {
                                        $track = rand(11111111, 99999999);
                                        $stm = $conn->prepare("insert into parcel_info(sname,scont,rname,rcont,height,width,length,weight,cust_id,trackid,bdate,btime) values('$sname',$scont,'$rname',$rcont,$height[$i],$width[$i],$length[$i],$weight[$i],$usrid,$track,CURDATE(),CURRENT_TIMESTAMP(2))");
                                        $stm->execute();
                                    }
                                    $height = array();
                                    $width = array();
                                    $length = array();
                                    $weight = array();
                                    $price = array();
                                    $msg = "save";
                                    include ("includes/success.php");
                                } else
                                    $error = "Destination Branch and Processing Branch Cannot be Same";
                            } else
                                $error = "Plese Select Branch";
                        } else
                            $error = "Contact Number Cannot Be Same";
                    } else
                        $error = "Phone Number Must Be of 10 Digits";
                } else
                    $error = "Parcel Cannot Be sent at Same Address";
            }
        }

        ?>
    </section>
    <section class="container2">

        <div>
            <center><br>

                <form class="login-form" style="width: 80%;background-color: azure;padding: 20px;"
                    action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                    <h1 style="font-family: Arial;color:black">
                        <i class="nav-icon fas fa-boxes"></i> Book Parcel
                    </h1><br><br>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Login Failed</strong>
                        <?= $error; ?>
                        <button type="button" style="padding-left: 5px;" class="close" data-dismiss="alert"
                            aria-label="Close" style="float: right;">
                            <span aria-hidden="true">&times;</span>
                        </button><br>
                    </div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        if ($error != "") {
                            ?>
                            <style>
                                .alert {
                                    display: block;
                                }
                            </style>
                            <?php
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col">
                            <h3>Sender</h3>
                            <h5 style="float: left;font-weight: bolder;">Name</h5>
                            <input type="text" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $sname ?>" placeholder="Sender Full Name" name="sname" class="form-control"
                                    required><br>
                                <h5 style="float: left;font-weight: bolder;">Address</h5>
                                <input type="text" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $saddr ?>" placeholder="Sender Address" name="saddr" class="form-control"
                                    required><br>
                                <h5 style="float: left;font-weight: bolder;">#Contact</h5>
                                <input type="number" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $scont ?>" placeholder="Sender Contact" name="scont" class="form-control"
                                    required><br>
                            </div>
                            <div class="col">
                                <h3>Recipient</h3>
                                <h5 style="float: left;font-weight: bolder;">Name</h5>
                                <input type="text" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $rname ?>" placeholder="Reciever Full Name" name="rname" class="form-control"
                                    required><br>
                                <h5 style="float: left;font-weight: bolder;">Address</h5>
                                <input type="text" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $raddr ?>" placeholder="Reciever Address" name="raddr" class="form-control"
                                    required><br>
                                <h5 style="float: left;font-weight: bolder;">#Contact</h5>
                                <input type="Number" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $rcont ?>" placeholder="Reciever Contact" name="rcont" class="form-control"
                                    required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 style="float: left;font-weight: bolder;">Pickup Branch</h5>
                                <select name="from" class="form-control" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $from ?>">
                                    <option selected value="Select">Select Processing Branch</option>
                                    <?php
                            include ("includes/Connection.php");
                            $st = $conn->prepare("select city from branch");
                            $st->execute();
                            $rs = $st->fetchAll(PDO::FETCH_COLUMN);
                            for ($i = 0; $i < count($rs); $i++) {
                                echo "<option class=form-control value=$rs[$i]>$rs[$i]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col">
                            <h5 style="float: left;font-weight: bolder;">Pickup Branch</h5>
                            <select name="to" class="form-control" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST")
                                echo $to ?>">
                                    <option selected value="Select">Select Pickup Branch</option>
                                    <?php
                            include ("includes/Connection.php");
                            $st = $conn->prepare("select city from branch");
                            $st->execute();
                            $rs = $st->fetchAll(PDO::FETCH_COLUMN);
                            for ($i = 0; $i < count($rs); $i++) {
                                echo "<option class=form-control value=$rs[$i]>$rs[$i]</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div><br><br>

                    <div class="input-field table-responsive-sm">
                        <h3>Parcle Information(Maximum 4 Parcle can be added)</h3>
                        <table class="table table-bordered table-responsive-sm" id="table_field"
                            style="width: 100%; height:max-content">
                            <tr>
                                <th scope="row">Height</th>
                                <th scope="row">Width</th>
                                <th scope="row">Length</th>
                                <th scope="row">Weight</th>
                                <th scope="row">Add Or Remove Column</th>
                            </tr>
                            <tr>
                                <td><input placeholder="In Feet" class="form-control" type="number" name="height[]"
                                        required>
                                </td>
                                <td><input placeholder="In Feet" class="form-control" type="number" name="Width[]"
                                        required>
                                </td>
                                <td><input placeholder="In Feet" class="form-control" type="number" name="Length[]"
                                        required>
                                </td>
                                <td><input placeholder="In KG" class="form-control" type="number" name="Weight[]"
                                        required>
                                </td>
                                <td><input class="btn btn-warning form-control" type="button" name="addd" id="add"
                                        value="Add">
                                </td>
                            </tr>
                        </table>
                    </div><br>
                    <center>
                        <input type="submit" class="btn btn-success" style="width: 40%;" value="Proceed To Payment"
                            name="bt">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary"
                            style="width: 40%;"><br>
                    </center>
        </div>
        </form><br><br><br>
        </div>
        </center>
    </section>

    <section class="container3">
        <?php include ("includes/footer.php") ?>
    </section>

</body>

</html>