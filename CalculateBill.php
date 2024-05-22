<?php

function calculateBill($height, $width, $length, $weight, $distance)
{
    $dimensionalWeight = ($height * $width * $length) / 5000;
    $billableWeight = max($weight, $dimensionalWeight);
    $shippingCost = ($billableWeight * $distance) / 100;
    $totalBill = $shippingCost;

    return $totalBill;
}
