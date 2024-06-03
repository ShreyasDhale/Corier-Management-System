<?php
session_start();
$_SESSION['usr'] = array();
session_unset();
exit();
