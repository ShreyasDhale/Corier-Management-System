<?php
$error = "";
include("../includes/Connection.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $trackid = $_POST['track'];
    $flg = $_POST['flg'];
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
        include("../includes/success.php");
    } else {
        $stm = $conn->prepare("update parcel_info set flag=$flg where trackid=$trackid");
        $stm->execute();
        $msg = "update";
        include("../includes/success.php");
    }
}
?>