<?php

function init_database()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "swift_dispatch";

    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
    }

    $sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql_create_db) === TRUE) {
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }
    $conn->close();

    $conn = new mysqli($servername, $username, $password, $dbname);

    create_LOGIN($conn);
    create_BRANCH($conn);
    create_PARCEL_FORM($conn);
    create_PARCEL_INFO($conn);
    create_STAFF($conn);
    create_PAYMENT($conn);

    insertDATA($conn);

}
function insertDATA($conn)
{
    $count = 1;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
    }

    // Check if record already exists
    $id = 1;
    $checkQuery = $conn->prepare("SELECT COUNT(*) FROM login WHERE id = ?");
    $checkQuery->bind_param("s", $id);
    $checkQuery->execute();
    $checkQuery->bind_result($count);
    $checkQuery->fetch();
    $checkQuery->close();

    if ($count == 0) {
        // Insert the record
        $insertQuery = $conn->prepare("INSERT INTO `login` (`id`, `email`, `password`, `name`, `user`, `address`, `address1`, `contact`, `otp`, `isAdmin`) VALUES
        (1, 'admin@gmail.com', 'Shreyas@123', 'Admin Name', 'Admin@123', 'Address', NULL, 1234567890, NULL, 1),
        (2, 'shreyasdhale100@gmail.com', 'Amit@123', 'Amit Khomne', 'Amit@123', 'sdsad', '', 9403461153, NULL, 0),
        (3, 'shreyasdhale100@gmail.com', 'Ketan@123', 'Mane Ajay', 'Ketan@123', 'sdsad', '', 9403461153, NULL, 1),
        (4, 'shreyasdhale100@gmail.com', 'Nikita@123', 'Mane Ajay', 'Nikita@123', 'sdsad', '', 9403461153, NULL, 0),
        (5, 'shreyasdhale100@gmail.com', 'Shreyas@123', 'Mane Ajay', 'Shreyas@123', 'sdsad', '', 9403461153, NULL, 0);");

        if ($insertQuery->execute()) {
        } else {
            echo "key1 : Error inserting record: " . $conn->error . "<br>";
        }

        $insertQuery = $conn->prepare("INSERT INTO `branch` (`id`, `building`, `city`, `state`, `zip`, `country`, `contact`) VALUES
        (1, 'Balaji Nagar,Pune', 'Pune', 'Maharashtra', 323232, 'India', 1111111111),
        (2, 'Balaji Nagar,Pune', 'Mumbai', 'Maharashtra', 323233, 'India', 1111111121);");

        if ($insertQuery->execute()) {
        } else {
            echo "key2 : Error inserting record: " . $conn->error . "<br>";
        }
        $insertQuery->close();
    } else {
    }

    $conn->close();
}
function create_LOGIN($conn)
{
    $sql_create_table = "CREATE TABLE IF NOT EXISTS `Swift_Dispatch`.`login` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `email` varchar(45) NOT NULL,
        `password` varchar(45) NOT NULL,
        `name` varchar(45) NOT NULL,
        `user` varchar(45) NOT NULL,
        `address` varchar(45) NOT NULL,
        `address1` varchar(45) DEFAULT NULL,
        `contact` bigint(11) NOT NULL,
        `otp` int(11) DEFAULT NULL,
        `isAdmin` int(11) DEFAULT 0
      ) ENGINE=InnoDB";

    if ($conn->query($sql_create_table) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}
function create_BRANCH($conn)
{
    $sql_create_table = "CREATE TABLE IF NOT EXISTS `Swift_Dispatch`.`branch` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `building` varchar(45) NOT NULL,
        `city` varchar(45) NOT NULL,
        `state` varchar(45) NOT NULL,
        `zip` int(11) NOT NULL,
        `country` varchar(45) NOT NULL,
        `contact` bigint(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($sql_create_table) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}
function create_PARCEL_FORM($conn)
{
    $sql_create_table = "CREATE TABLE IF NOT EXISTS `Swift_Dispatch`.`parcelform` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `sname` varchar(45) NOT NULL,
        `saddr` varchar(70) NOT NULL,
        `scont` bigint(11) NOT NULL,
        `rname` varchar(45) NOT NULL,
        `raddr` varchar(70) NOT NULL,
        `rcont` bigint(11) NOT NULL,
        `frombr` varchar(45) NOT NULL,
        `tobr` varchar(45) NOT NULL,
        `bill` int(11) NOT NULL,
        `is_paid` int DEFAULT 0
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($sql_create_table) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}
function create_PARCEL_INFO($conn)
{
    $sql_create_table = "CREATE TABLE IF NOT EXISTS `Swift_Dispatch`.`parcel_info` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `sname` varchar(45) NOT NULL,
        `scont` varchar(70) NOT NULL,
        `rcont` bigint(11) NOT NULL,
        `rname` varchar(45) NOT NULL,
        `trackid` int(11) NOT NULL,
        `height` float NOT NULL,
        `width` float NOT NULL,
        `length` float NOT NULL,
        `weight` float NOT NULL,
        `flag` int(11) DEFAULT 0,
        `cust_id` int(11) DEFAULT NULL,
        `bdate` date NOT NULL,
        `ddate` date DEFAULT NULL,
        `btime` time NOT NULL,
        `dtime` time DEFAULT NULL,
        `price` int NOT NULL,
        `order_id` int NOT NULL,
        `is_paid` int DEFAULT 0
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($sql_create_table) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}
function create_STAFF($conn)
{
    $sql_create_table = "CREATE TABLE IF NOT EXISTS `Swift_Dispatch`.`staff` (
        `id` int(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `email` varchar(50) NOT NULL,
        `name` varchar(50) NOT NULL,
        `password` varchar(50) NOT NULL,
        `user` varchar(50) NOT NULL,
        `branch_id` varchar(50) NOT NULL,
        `Salary` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ";

    if ($conn->query($sql_create_table) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}

function create_PAYMENT($conn)
{
    $sql_create_table = "CREATE TABLE IF NOT EXISTS `Swift_Dispatch`.`payments` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `order_id` int(11) NOT NULL,
        `order_no` int(11) NOT NULL,
        `username` varchar(60) NOT NULL,
        `roz_id` varchar(60) NOT NULL,
        `roz_signature` varchar(60) NOT NULL,
        `roz_pay_id` varchar(60) NOT NULL,
        `amount` int(11) NOT NULL

      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($sql_create_table) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}

init_database();

?>
<html>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
</form>

</html>