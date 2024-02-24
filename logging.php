<?php

require "connection/connection.php";



//Protecting Pages
if (isset($_SESSION['user'])) {
    header("location: home.php");
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $type = trim($_POST['type']);
} else {
    die('getted');
}

//fetching User from the database
//

$getQuery = "SELECT * FROM `users` where `email` = '$email' and `password` = '$password' and `usertype` = '$type';";
$result = mysqli_query($connection, $getQuery);

$userData = mysqli_fetch_array($result);
if (!$userData) {
    die('Invalid password and email combination.');
}
$user_id = $userData[0];
$_SESSION['user'] = $user_id;

$typeid = $userData[5];
$_SESSION['usertype'] = $typeid;

header("location: home.php");
?>