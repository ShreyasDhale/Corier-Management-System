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

        #track {
            display: none;
        }

        .alert {
            display: none;
        }
        .empty{
            background-color: red;
            padding: 20px;
            margin: 20px;
            position: relative;
            align-content: center;
            width: 30%;
            border-radius: 20px;
            color: white;
            font-size: 20px;
            font-weight: bolder;
            font-family: sans-serif;
        }
    </style>
    <script>
        function delet(track) {
            if (confirm("Are You Sure You Want to delete parcel with Track Id " + track)) {
                var ar;
                if (window.XMLHttpRequest)
                    ar = new XMLHttpRequest();
                else
                    ar = new ActiveXObject("Microsoft.XMLHTTP");
                ar.onreadystatechange = function () {
                    if (ar.readyState == 4 && ar.status == 200)
                        document.getElementById("ans").innerHTML = ar.responseText;
                }
                ar.open("POST", "ajax/cancel.php", true);
                ar.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                ar.send("track=" + track);
            }
        }
        function track(track1) {
            document.getElementById("track").style.display = "block";
            var ar;
            if (window.XMLHttpRequest)
                ar = new XMLHttpRequest();
            else
                ar = new ActiveXObject("Microsoft.XMLHTTP");
            ar.onreadystatechange = function () {
                if (ar.readyState == 4 && ar.status == 200)
                    document.getElementById("ans").innerHTML = ar.responseText;
            }
            ar.open("POST", "ajax/track.php", true);
            ar.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ar.send("ref=" + track1);

        }
    </script>
</head>

<body>

    <?php
    session_start();
    include ("includes/header.php");
    include ("includes/Connection.php");
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
            <div style="background-color: azure; width: 90%; padding: 20px">
                <h1 style=" font-family: Arial; color: black;">
                    <b><i class="nav-icon fas fa-boxes"></i> Your Parcels</b>
                </h1>
                <br>
                <div class="table-responsive-sm">
                    <table class="table table-striped table-hover table-bordered" style="width: 95%;padding-top: 10px ;">
                        <thead>
                            <tr class=table-primary>
                                <th>Parcel Id</th>
                                <th>Sender Name</th>
                                <th>Recipient Name</th>
                                <th>Booked On</th>
                                <th>Booked At</th>
                                <th>Delavary Status</th>
                                <th>Tracking Id</th>
                                <th>Cancel</th>
                                <th>Track</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_SESSION['adid'];
                            $rs = $conn->query("select id,sname,rname,cust_id,bdate,btime,trackid,flag from parcel_info where cust_id=$id");
                            $stat = "";
                            if (!$rs) {
                                print_r($conn->errorInfo());
                            } else {
                                while ($row = $rs->fetch()) {
                                    ?>
                                    <tr class=table-secondary>
                                        <td>
                                            <?= $row[0]; ?>
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
                                        <td>
                                            <?= $row[6]; ?>
                                        </td>
                                        <td align="center"><button class="btn btn-danger" value="<?= $row[6] ?>"
                                                onclick="delet(this.value)"><i class="fa-solid fa-trash-can "></i></button>
                                        </td>
                                        <td align="center"><a href="#track"><button class="btn btn-warning" value="<?= $row[6] ?>"
                                                    onclick="track(this.value)"><i
                                                        class="fa-brands fa-searchengin "></i></button></a></td>
                                    </tr>
                                    <?php
                                }
                            }
    } else
        echo "<center><div class = 'empty'>No Parcels Found &#x1F601;</div></center>";
    echo "</tbody></table></div>";
    ?>

            </div><br><br>
            <div id="track">
                <form
                    style="width: 50%; background-color: azure;padding-bottom: 20px;margin: 20px; height: max-content;">
                    <br>
                    <h5 style="font-family: Arial;"><i class="fa-solid fa-clock"></i> Track History</h5>
                    <div id="ans"></div>
                </form>
            </div>
    </center>
    <?php include ("includes/footer.php"); ?>
</body>

</html>