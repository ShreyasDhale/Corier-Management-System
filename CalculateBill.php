<?php

function calculateBill($height, $width, $length, $weight, $distance)
{
    $heightCm = $height * 30.48;
    $widthCm = $width * 30.48;
    $lengthCm = $length * 30.48;

    $dimensionalWeight = ($heightCm * $widthCm * $lengthCm) / 7000;
    
    $billableWeight = max($weight, $dimensionalWeight);
    
    $shippingCost = ($billableWeight * $distance) / 100;
    $totalBill = $shippingCost;

    return ceil($totalBill);
}

