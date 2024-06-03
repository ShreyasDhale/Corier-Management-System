<?php
ob_start();
session_start();
include ('Config.php');
include ('../includes/Connection.php');

if (!empty($_POST)) {

    $order_id = $_SESSION['order_id'];

    $roz_id = $_POST['razorpay_order_id'];
    $roz_signature = $_POST['razorpay_signature'];
    $roz_pay_id = $_POST['razorpay_payment_id'];

    $generated_signature = hash_hmac('sha256', $order_id . "|" . $roz_pay_id, API_SECRET);

    if ($generated_signature == $roz_signature) {
        echo "Payment Success !!";

        $order_no = $_SESSION['parcels_id'];
        $uname = $_SESSION['usr'];
        $amt = $_SESSION['bill'];

        $_SESSION['parcels_id'] = 0;
        $_SESSION['bill'] = 0;

        $stm = $conn->prepare("insert into `swift_dispatch`.`payments` values($order_id,$order_no,$uname,$roz_id,$roz_signature,$roz_pay_id,$amt)");
        $stm->execute();
        $stm = $conn->prepare("update `swift_dispatch`.`parcelform` set is_paid = 1 where id = $order_no");
        $stm->execute();
        $stm = $conn->prepare("update `swift_dispatch`.`parcel_info` set is_paid = 1 where order_id = $order_no");
        $stm->execute();
        header("location:../parcels.php");
    } else {
        echo "Invalid Payment ";
    }
}