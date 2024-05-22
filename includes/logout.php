<?php
include ("Connection.php");
$stm = $conn->prepare("DELETE FROM `current_user`;");
$stm->execute();
if ($stm->execute()) {
    echo "Record inserted successfully!<br>";
} else {
    echo "Error inserting record: " . $conn->errorCode() . "<br>";
}
session_unset();
session_destroy();
exit();
