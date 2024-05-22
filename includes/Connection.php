<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=swift_dispatch","root", "");
} catch (Exception $e) {
    echo "Failed " . $e->getMessage();
}?>