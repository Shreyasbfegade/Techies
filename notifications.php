<?php

require "connection/connection.php";
require "init.php";

if (!isset($_SESSION['user'])) {
    header("location: index.php");
} 
else if($_SESSION['usertype']==3){
    $user_id = $_SESSION['user'];
    $getQuery = "SELECT * FROM `notifications`order by created_at desc";
    $result = mysqli_query($connection, $getQuery);

    $notifcationsData = mysqli_fetch_all($result);
}
else {
    $user_id = $_SESSION['user'];
    $getQuery = "SELECT * FROM `notifications` where `user_id` = '$user_id' order by created_at desc";
    $result = mysqli_query($connection, $getQuery);

    $notifcationsData = mysqli_fetch_all($result);
  
}
$welcome = 'Welcome to Notifications  <i class="fa-regular fa-bell"></i>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .container {
            margin: 0px 0px 0px -25px;
        }

        .Wel {
            margin-left: 317px;
        }
        .theader {
            background: #dadada !important;
            padding-bottom: 1rem !important;
            padding-top: 1rem !important;
            padding-left: 28rem !important;
            font-size: 1.25rem !important;
            font-weight: 400 !important;
        }
        #navbar{     
        position: sticky;
        top: 0;
        z-index: 100;
        }

        .navbar {
            height: 50px;
        }
    </style>

</head>

<body>

<?php include 'nav2.php'; ?>

    <div class="container-fluid ">
        <div class="row flex-nowrap">
        <?php include 'sidebar.php'; ?>
            <div class="col" style="background-color: #ffffff;">
                <div class="container">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary" style="height: 530px; width: 800px;"> <!-- Adjust the height as needed -->
                            <div class="panel-heading">
                                <div>
                                    <table class="table table-responsive" style="width: 82.5vw">
                                        <thead class="thead-dark" style="background: #2e6fa7; color: white;">
                                            <tr>
                                                <th colspan="8" class="theader"> Your Notifications  <i class="fa-regular fa-bell"></i></th>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #e9ecef;" scope="col">#</th>
                                                <th style="background-color: #e9ecef;" scope="col">Content</th>
                                                <th style="background-color: #e9ecef;" scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; ?>
                                            <?php foreach ($notifcationsData as $key => $notification): ?>
                                              <?php $count++;?>
                                                <tr>
                                                    <th scope="row"><?php echo $count ?></th>
                                                    <td><?php echo $notification[2]; ?></td>
                                                    <td><?php echo date("d.m.Y h.i A", strtotime($notification[3])) ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</html>