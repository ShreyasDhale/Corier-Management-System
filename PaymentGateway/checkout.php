<?php
session_start();

require 'Config.php';
require 'vendor/autoload.php';

use Razorpay\Api\Api;


$name = $_POST['name'];
$email = $_POST['email'];
$amount = $_SESSION['bill'];

$api = new Api(API_KEY, API_SECRET);

$res = $api->order->create(
    array(
        'receipt' => '123',
        'amount' => $amount * 100,
        'currency' => 'INR',
        'notes' => array('key1' => 'value3', 'key2' => 'value2')
    )
);

if (!empty($res['id'])) {
    $_SESSION['order_id'] = $res['id'];
    ?>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <form action="<?= BASE_URL ?>success.php" method="POST">
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?= API_KEY ?>" data-amount="<?= $amount ?>"
            data-currency="INR" data-order_id="<?= $res['id'] ?>" data-buttontext="PAY RS<?= $amount ?> with RAZORPAY"
            data-description="Courier Deleavry SYSTEM" data-image="<?= COMPANY_LOGO_URL ?>" data-prefill.name="<?= $name ?>"
            data-email="<?= $email ?>" data-color="#F37254">
            </script>
        <input type="hidden" custom="Hidden Element" name="hidden" />
    </form>
    <style>
        .razorpay-payment-button {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.razorpay-payment-button').click();
        });
    </script>
    <?php
}
?>