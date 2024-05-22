<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
        .login-form i:hover {
            color: violet;
        }
    </style>
    <?php
    session_start();
    include("includes/Connection.php");
    $rs = $conn->query("select count(*) from parcel_info");
    $tot = $rs->fetch();
    $rs = $conn->query("select count(*) from branch");
    $branch = $rs->fetch();
    $rs = $conn->query("select count(*) from login where isAdmin = 1");
    $admin = $rs->fetch();
    $rs = $conn->query("select count(*) from parcel_info where flag=0");
    $accepted = $rs->fetch();
    $rs = $conn->query("select count(*) from parcel_info where flag=1");
    $shipped = $rs->fetch();
    $rs = $conn->query("select count(*) from parcel_info where flag=2");
    $intransit = $rs->fetch();
    $rs = $conn->query("select count(*) from parcel_info where flag=3");
    $arrived = $rs->fetch();
    $rs = $conn->query("select count(*) from parcel_info where flag=4");
    $out = $rs->fetch();
    $rs = $conn->query("select count(*) from parcel_info where flag=5");
    $delevered = $rs->fetch();

    ?>
</head>

<body>
    <section>
        <?php include("includes/header.php"); ?>
    </section>
    <center>

        <div class="login-form" style="width: 90%; background-color: darkgray; padding: 20px; border-radius: 10px;">
            <b>
                <H1 style="font-family: Arial;"><i class="fa-solid fa-home"></i> Home</H1>
            </b>
            <div class="row g-3">
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content;">
                        <div class="card-header">Total Parcels</div>
                        <div class="card-body">
                            <i class="nav-icon fas fa-boxes fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $tot[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content;">
                        <div class="card-header">Total Staff</div>
                        <div class="card-body">
                            <i class="fa-solid fa-people-group fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $admin[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content;">
                        <div class="card-header">Total Branches</div>
                        <div class="card-body">
                            <i class="fa-regular fa-building fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $branch[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content;">
                        <div class="card-header">Item Accepted By Corier</div>
                        <div class="card-body">
                            <i class="nav-icon fas fa-boxes fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $accepted[0]; ?>
                            </h1>

                        </div>
                    </div>
                </div>
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content;">
                        <div class="card-header">Shipped</div>
                        <div class="card-body">
                            <i class="nav-icon fas fa-boxes fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $shipped[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content; ">
                        <div class="card-header">In-Transit</div>
                        <div class="card-body">
                            <i class="nav-icon fas fa-boxes fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $intransit[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content;">
                        <div class="card-header">Arrived at Destination</div>
                        <div class="card-body">
                            <i class="nav-icon fas fa-boxes fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $arrived[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content;">
                        <div class="card-header">Out For Delivery</div>
                        <div class="card-body">
                            <i class="fa-sharp fa-solid fa-truck fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $out[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col g-3">
                    <div class="card" style="width: 100%; height: max-content; ">
                        <div class="card-header">Delivered</div>
                        <div class="card-body">
                            <i class="fa-solid fa-square-check fa-6x" style="float: left;"></i>
                            <h1 style="font-size: 500%;">
                                <?= $delevered[0]; ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <section>
        <?php include("includes/footer.php"); ?>
    </section>
</body>

</html>