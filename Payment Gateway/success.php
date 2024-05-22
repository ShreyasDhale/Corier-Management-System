<?php
session_start();
if (!empty($_POST)) {

    $order_id = $_SESSION['order_id'];

    $roz_id = $_POST['razorpay_signature'];
    $roz_signature = $_POST['razorpay_signature'];
    $roz_pay_id = $_POST['razorpay_payment_id'];

    $generated_signature = hash_hmac('sha256', $order_id . "|" . $roz_pay_id, API_SECRET);

    if ($generated_signature == $roz_signature) {
        echo "Payment Success !!";
    } else {
        echo "Invalid Payment ";
    }
}