<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ref = $_POST['ref'];
    $error = "";
    include("../includes/Connection.php");
    $st = $conn->prepare("select trackid from parcel_info");
    $st->execute();
    $rs = $st->fetchAll(PDO::FETCH_COLUMN);
    if (in_array($ref, $rs) != 0) {

    } else
        $error = "Wrong Referance Code Entered";
    ?>
    <style>
        .track {
            display: none;
        }

        .acc {
            display: none;
        }

        .ship {
            display: none;
        }

        .trans {
            display: none;
        }

        .arriv {
            display: none;
        }

        .out {
            display: none;
        }

        .dele {
            display: none;
        }

        .alert {
            display: none;
        }
    </style>
    <br>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST")if ($error != "") {
        ?>
            <style>
                .alert {
                    display: block;
                }
            </style>
        <?php
    } else {
        $stm = $conn->Query("select flag from parcel_info where trackid=$ref");
        $stm->execute();
        $rst = $stm->fetchAll(PDO::FETCH_COLUMN);
        for ($i = 0; $i < count($rst); $i++) {
            if ($rst[$i] == 0) {
                ?>
                    <style>
                        .track {
                            display: block;
                        }

                        .acc {
                            display: block;
                        }

                        .ship {
                            display: none;
                        }

                        .trans {
                            display: none;
                        }

                        .arriv {
                            display: none;
                        }

                        .out {
                            display: none;
                        }

                        .dele {
                            display: none;
                        }
                    </style>
                <?php
            }
            if ($rst[$i] == 1) {
                ?>
                    <style>
                        .track {
                            display: block;
                        }

                        .acc {
                            display: block;
                        }

                        .ship {
                            display: block;
                        }

                        .trans {
                            display: none;
                        }

                        .arriv {
                            display: none;
                        }

                        .out {
                            display: none;
                        }

                        .dele {
                            display: none;
                        }
                    </style>
                <?php
            }
            if ($rst[$i] == 2) {
                ?>
                    <style>
                        .track {
                            display: block;
                        }

                        .acc {
                            display: block;
                        }

                        .ship {
                            display: block;
                        }

                        .trans {
                            display: block;
                        }

                        .arriv {
                            display: none;
                        }

                        .out {
                            display: none;
                        }

                        .dele {
                            display: none;
                        }
                    </style>
                <?php
            }
            if ($rst[$i] == 3) {
                ?>
                    <style>
                        .track {
                            display: block;
                        }

                        .acc {
                            display: block;
                        }

                        .ship {
                            display: block;
                        }

                        .trans {
                            display: block;
                        }

                        .arriv {
                            display: block;
                        }

                        .out {
                            display: none;
                        }

                        .dele {
                            display: none;
                        }
                    </style>
                <?php
            }
            if ($rst[$i] == 4) {
                ?>
                    <style>
                        .track {
                            display: block;
                        }

                        .acc {
                            display: block;
                        }

                        .ship {
                            display: block;
                        }

                        .trans {
                            display: block;
                        }

                        .arriv {
                            display: block;
                        }

                        .out {
                            display: block;
                        }

                        .dele {
                            display: none;
                        }
                    </style>
                <?php
            }
            if ($rst[$i] == 5) {
                ?>
                <style>
                        .track {
                            display: block;
                        }

                        .acc {
                            display: block;
                        }

                        .ship {
                            display: block;
                        }

                        .trans {
                            display: block;
                        }

                        .arriv {
                            display: block;
                        }

                        .out {
                            display: block;
                        }

                        .dele {
                            display: block;
                        }
                    </style>
                <?php
            }
        }

    }
    ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <strong>Cannot Track</strong>
        <?= $error; ?>
        <button type="button" style="padding-left: 5px;" class="close" data-dismiss="alert" aria-label="Close"
            style="float: right;">
            <span aria-hidden="true">&times;</span>
        </button><br>
    </div>
    <div class="track" style="text-align: left;width: 40%; background-color: #CEF5EB; padding: 20px; border-radius: 10px;">
        <div class="acc form-check">
            <i class="fa-solid fa-gifts"></i> <strong>Item Accepted By Corier</strong>
            <br><i class="fa-solid fa-arrow-down-long"></i>
        </div>
        <div class="ship form-check">
            <i class="fa-solid fa-ship"></i> <strong>Shipped</strong>
            <br><i class="fa-solid fa-arrow-down-long"></i>
        </div>
        <div class="trans form-check">
            <i class="fa-solid fa-gifts"></i> <strong>In-Transit</strong>
            <br><i class="fa-solid fa-arrow-down-long"></i>
        </div>
        <div class="arriv form-check">
            <i class="fa-solid fa-building-shield"></i> <strong>Arrived At Destination</strong>
            <br><i class="fa-solid fa-arrow-down-long"></i>
        </div>
        <div class="out form-check">
            <i class="fa-solid fa-truck-fast"></i> <strong>Out For Delivery</strong>
            <br><i class="fa-solid fa-arrow-down-long"></i>
        </div>
        <div class="dele form-check">
            <i class="fa-sharp fa-solid fa-square-check"></i> <strong>Delivered</strong>
        </div>
    </div>


    <?php
}
?>