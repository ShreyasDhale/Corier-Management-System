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
        //window.confirm("Are You Sure You Want To Delete Branch");
    </script>
    <style>
        .alert {
            display: none;
        }
    </style>
</head>

<body>
    <?php
    include("includes/header.php");
    include("includes/Connection.php");
    $error = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['check'])) {
            $arr = $_POST['check'];
            for ($i = 0; $i < count($arr); $i++) {
                $st = $conn->prepare("delete from branch where id=$arr[$i]");
                $st->execute();
            }
            $msg = "delete";
            include("includes/success.php");
        } else
            $error = "No Branch Selected";

    }
    ?><br><br>
    <center>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="login-form" style="width: 80%; background-color: azure; padding: 20px;border-radius: 20px;">
            <br><b>
                <h1 name="new_parcle" style="font-family: Arial;"><i class="fa-solid fa-city"></i> List/Delete Branch</h1>
            </b><br>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST")if ($error != "") { ?>
                    <style>
                        .alert {
                            display: block;
                        }
                    </style>
            <?php }
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $error; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table table-bordered table-striped">
                <?php

                $rs = $conn->query("select id,building,city,zip,contact from branch");
                if ($rs->rowCount() > 0) {
                    echo "<tr class=table-primary>
                        <th>Branch Id</th>
                        <th>Building</th>
                        <th>City</th>
                        <th>Zip-code</th>
                        <th>Contact</th>
                        <th>Select Branch To Delete</th>
                    </tr>";
                    while ($row = $rs->fetch()) {
                        echo "<tr>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            <td>$row[2]</td>
                            <td>$row[3]</td>
                            <td>$row[4]</td>
                            <td><input class=form-check-input type=checkbox id=flexCheckDefault$row[0] name=check[] value=$row[0]>&nbsp<label class=form-check-label for=flexCheckDefault$row[0]>Delete</label></td>
                        </tr>";
                    }
                }

                ?>
            </table>
            <div class="row" style="padding-top: 10px;">
                <div class="col">
                    <input type="submit" value="Delete" confirm="Want to submit?" class="btn btn-warning form-control">
                </div>
                <div class="col">
                    <input type="reset" class="btn btn-danger form-control">
                </div>
            </div><br>
            
    </center>
    </table>
    </form><br><br><br>
    <?php include("includes/footer.php")?>
</body>

</html>