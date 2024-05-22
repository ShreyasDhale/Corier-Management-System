<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #update {
            display: none;
        }

        .alert {
            display: none;
        }
    </style>
    <script>
        function display(track) {
            document.getElementById("update").style.display = "block";
            document.getElementById("track").value = track;
        }
        function update(track, flg) {
            var ar;
            if (window.XMLHttpRequest)
                ar = new XMLHttpRequest();
            else
                ar = new ActiveXObject("Microsoft.XMLHTTP");
            ar.onreadystatechange = function () {
                if (ar.readyState == 4 && ar.status == 200)
                    document.getElementById("ans").innerHTML = ar.responseText;
            }
            ar.open("POST", "ajax/update.php", true);
            ar.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ar.send("flg=" + flg + "&track=" + track);
        }
    </script>
</head>

<body>

    <?php
    include("includes/header.php");
    include("includes/Connection.php");
    function status($flg)
    {
        $f = $flg;
        if ($f == 0)
            echo "<font color=red>Item Accepter By Corier</font>";
        else if ($f == 1)
            echo "<font color=red>Shipped</font>";
        else if ($f == 2)
            echo "<font color=red>In-Transit</font>";
        else if ($f == 3)
            echo "<font color=red>Arrived At Destination</font>";
        else if ($f == 4)
            echo "<font color=red>Out For Delivery</font>";
        else if ($f == 5)
            echo "<font color=green>Delevered</font>";
    }
    $rs1 = $conn->query("select id,trackid from parcel_info");
    if ($rs1->rowCount() > 0) { ?>

        <center>
            <div style="background-color: azure; width: 96%; padding: 10px">
                <h1 style=" font-family: Arial; color: black;">
                    <b><i class="nav-icon fas fa-boxes"></i> Booked Parcels By Customers</b>
                </h1>
                <br>
                <div class="table-responsive-sm">
                    <table class="table table-striped table-hover table-bordered" style="width: 99%;padding-top: 10px ;">
                        <thead>
                            <tr class=table-primary>
                                <th>Parcel Id</th>
                                <th>User Name</th>
                                <th>Sender Contact</th>
                                <th>Reciever Contact</th>
                                <th>Booked On</th>
                                <th>Booked At</th>
                                <th>Delavary Status</th>
                                <th>Update Status By Referance Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rs = $conn->query("select id,scont,rcont,cust_id,bdate,btime,trackid,flag from parcel_info");
                            $stat = "";
                            while ($row = $rs->fetch()) {
                                ?>
                                <tr class=table-secondary>
                                    <td>
                                        <?= $row[0]; ?>
                                    </td>
                                    <td>
                                        <?php $st=$conn->query("select user from login where id=$row[3]"); 
                                            $name=$st->fetch();
                                            echo $name[0]; 
                                        ?>
                                    </td>
                                    <td>
                                        <?= $row[1]; ?>
                                    </td>
                                    <td>
                                        <?= $row[2]; ?>
                                    </td>
                                    <td>
                                        <?= $row[4]; ?>
                                    </td>
                                    <td>
                                        <?= $row[5]; ?>
                                    </td>
                                    <td>
                                        <strong>
                                            <?php status($row[7]); ?>
                                        </strong>
                                    </td>
                                    <td align="center"><i class="fa-sharp fa-solid fa-pen-to-square "></i> Update <a href="#update"><input
                                            type="button" class="btn btn-success" value="<?= $row[6] ?>" name=ref
                                            onclick="display(this.value)"></a></td>
                                </tr>
                                <?php
                            }
    } else
        echo "No Parcels Found";
    echo "</tbody></table></div>";
    ?>
            </div>
    </center><br><br><br>
    <section id=update>
        <center>
            <div>
                <form class="login-form" style="width: 50%; background-color: azure; padding: 20px;">
                    <h2 style="font-family: Arial;"><i class="nav-icon fas fa-boxes"></i> Update Parcel Status</h2><br>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST") if ($error != "") { ?>
                            <style>
                                .alert {
                                    display: block;
                                }
                            </style>
                    <?php } ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $error; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="float: right;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <h4 style="float: left; font-family: Arial;">Referance Id</h4><br>

                    <input type="number" class="form-control" id="track" name="track" disabled><br>
                    <h4 style="float: left; font-family: Arial;">Select Status to Update</h4><br>
                    <select name="flag" class="form-select" id="flg" class="form-control" required>
                        <option value="0">Item Accepted By Corier</option>
                        <option value="1">Shipped</option>
                        <option value="2">In Transit</option>
                        <option value="3">Arrived at Destination</option>
                        <option value="4">Out For Delevery</option>
                        <option value="5">Delevered</option>
                    </select><br><div id="ans"></div>
                    <input class="btn btn-success" type="button" name="sub" onclick="update(track.value,flg.value)"
                        value="Update" style="width: 40%;">
                    <input class="btn btn-warning" type="reset" value="Clear" style="width: 40%;"><br>
                    <br>

                </form><br><br>
            </div>
        </center>
    </section>
    <?php include("includes/footer.php"); ?>
</body>

</html>