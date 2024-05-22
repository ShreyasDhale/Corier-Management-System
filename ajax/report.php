<style>
    .alert {
        display: none;
    }
</style>
<?php
session_start();
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
if (isset($_POST['btn'])) {
    $tot = 0;
    $error = "";
    $from = $_POST['from'];
    $to = $_POST['to'];
    $flg = $_POST['track'];
    if (strcmp($flg, "select") != 0) {
        include("../includes/connection.php");
        $st = $conn->query("select parcel_info.id,parcel_info.bdate,parcelform.sname,parcelform.rname,parcel_info.price,parcel_info.flag from parcelform,parcel_info where parcel_info.cust_id=parcelform.id and parcel_info.flag=$flg and parcel_info.bdate between '$from' and '$to'");
        if ($st->rowCount() > 0) {
            ?>
            <table class="table table-responsive tabble-striped" border=1 cellspacing=0 style="padding=5px">
                <tr class="table-primary">
                    <th> # </th>
                    <th>Booked On</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Price</th>
                    <th>Delivery Status</th>
                </tr>
                <?php
                while ($row = $st->fetch()) {
                    ?>
                    <tr>
                        <td>
                            <b>
                                <?= $row[0]; ?>
                            </b>
                        </td>
                        <td>
                            <?= $row[1]; ?>
                        </td>
                        <td>
                            <?= $row[2]; ?>
                        </td>
                        <td>
                            <?= $row[3]; ?>
                        </td>
                        <td>
                            <strong>
                                <i class="fa-sharp fa-solid fa-indian-rupee-sign" style="padding-top: 5px;"></i>
                                <?php echo $row[4];
                                $tot += $row[4]; ?>
                            </strong>
                        </td>
                        <td>
                            <strong>
                                <?php status($row[5]); ?>
                            </strong>
                        </td>
                    </tr>
                    <?php
                }?>
                <tr>
                    <th colspan=4 align="center"> Total Earnings Are</th>
                    <th colspan=2 align="left"><i class="fa-sharp fa-solid fa-indian-rupee-sign" style="padding-top: 5px;"></i> <?= $tot;?></th>
                </tr>
                <?php
        } else
            $error = "No Items Found";
    } else
        $error = "Plese Select Item Status";

    if ($error != "") { ?>
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
    <?php } elseif (isset($_POST['btn2'])) {

} ?>