<?php 
    require "connection/connection.php";
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
        $getQuery = "SELECT * FROM users where id = $user_id";
        $result = mysqli_query($connection,$getQuery);
        $userData = mysqli_fetch_array($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FTS</title>
</head>
<body>
<?php if (!isset($_SESSION['user'])){
 header("location: login.php");
} ?>
                   
</body>