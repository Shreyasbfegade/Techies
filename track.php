<?php

require "connection/connection.php";
require "init.php";

if (!isset($_SESSION['user'])) {
    header("location: home.php");
} else {
    $user_id = $_SESSION['user'];
    $typeid = $_SESSION['usertype'];
    $fileObject = isPrivileged($connection, $_REQUEST['file_id']);
    if (!$fileObject) {
        die("You do not have privilege to access this data.");
    }

    $getQuery = "SELECT * FROM `movements` where `file_id` = '". $_REQUEST['file_id'] . "' order by created_at";
    $result = mysqli_query($connection, $getQuery);
    $filesData = mysqli_fetch_all($result);
    $welcome = "Welcome to Application Status Section";
  
}
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
    .container{
        margin: 0px 0px 0px -25px;
    }
.Wel{
margin-left: 234px;
}

.theader {
    background: #dadada !important;
    padding-bottom: 1rem !important;
    padding-top: 1rem !important;
    padding-left: 23rem !important;
    font-size: 1.25rem !important;
    font-weight: 400 !important;
}

.track{
    font-size: 1.25rem;
    margin-left: 433px;
    font-weight: 500;
}

.disp{
    color: green;
}

.note{
    color: grey;
}
.navbar {
        position: sticky;
    }
    

</style>

</head>

<body>

<?php include 'nav2.php'; ?>
<div class="container-fluid ">
<div class="row flex-nowrap ">
<?php include 'sidebar.php'; ?>
<div class="col-md-6 col-md-offset-3" style="margin-left: -12px;">
        <div class="panel panel-primary" style="height: 530px; width: 800px;"> <!-- Adjust the height as needed -->
            <div class="panel-heading">
            <div>
                <table class="table table-responsive" style="width: 82.5vw">
                    <thead class="thead-dark" style="background: #2e6fa7; color: white;">
                    <tr>
                        <th colspan="8" class="theader">Status of Your Applications</th>
                    </tr>
                        <tr>
                            <th style="background-color: #e9ecef;" scope="col">#</th>
                            <th style="background-color: #e9ecef;" scope="col">From</th>
                            <th style="background-color: #e9ecef;" scope="col"></th>
                            <th style="background-color: #e9ecef;" scope="col">To</th>
                            <th style="background-color: #e9ecef;" scope="col">Note </th>
                            <th style="background-color: #e9ecef;" scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        <?php foreach ($filesData as $key => $file): ?>
                            <?php $count++ ?>
                            <?php 
                                $fromUserQuery =  "SELECT  *  FROM `users` WHERE id = $file[1];";
                                $getFromUserResult = mysqli_query($connection,$fromUserQuery );
                                $fromUserObject = mysqli_fetch_object($getFromUserResult);
                                
                                $toUserQuery =  "SELECT  *  FROM `users` WHERE id = $file[3];";
                                $getToUserResult = mysqli_query($connection,$toUserQuery );
                                $toUserObject = mysqli_fetch_object($getToUserResult);
                             ?>
                            <tr>
                              <th scope="row"><?php echo $count ?></th>
                              <?php if($fromUserObject->name ===  $toUserObject->name ):?>
                              <td><?php echo $fromUserObject->name ?>  </td>
                              <td> added file at </td>
                              <td></td>
                              <td></td>
                              <?php else:?>
                                <td><?php echo $fromUserObject->name ?></td>
                              <td style="text-align: center;">------></td>
                              <td><?php echo $toUserObject->name ?></td>
                              <td><?php echo $file[4] ?></td>
                              
                              <?php endif?>
                              <td> <?php echo date("d.m.Y h.i A", strtotime($file[5])) ?></td>
                            </tr>
                        <?php endforeach ?>

                        
                    </tbody>
                </table>
                <div class = "track">
                <?php
                                    //principal
                                    if ($_SESSION['usertype'] == 1): ?>
                              
                                        <u>Path:</u><br>Staff
                                        <br>&nbsp;<i class="fa-solid fa-minus fa-rotate-90"></i>
                                        <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 1 and $fromUserObject->id != $toUserObject->id){
                                        echo '<div class="disp">You &nbsp; <input type="checkbox" checked> </div>';
                                        }
                                        else{
                                            echo 'You <br>';
                                        }
                                        ?>
                                        &nbsp;<i class="fa-solid fa-minus fa-rotate-90"></i> revert back
                                        <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 4){
                                        echo '<div class="disp">staff/student &nbsp; <input type="checkbox" checked> </div>';
                                        
                                        }
                                        else{
                                            echo 'Staff/student';
                                        }
                                        ?>
                                        <br>
                                    
                                  <?php endif ?>  
                                    <?php
                                    //staff
                                    if ($_SESSION['usertype'] == 2): ?>
                                        Path:
                                        <br>Student
                                        <br>&nbsp;<i class="fa-solid fa-minus fa-rotate-90"></i>
                                        <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 2 and $fromUserObject->id != $toUserObject->id){
                                        echo '<div class="disp">You &nbsp; <input type="checkbox" checked> </div>';
                                        }
                                        else{
                                            echo 'You <br>';
                                        }
                                        ?>
                                        &nbsp;<i class="fa-solid fa-minus fa-rotate-90"></i>
                                        <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 1){
                                        echo '<div class="disp">Principal &nbsp; <input type="checkbox" checked> </div>';
                                        }
                                        else{
                                            echo 'Principal <br>';
                                        }
                                        ?>
                                        &nbsp;<i class="fa-solid fa-minus fa-rotate-90"></i> revert back
                                        <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 4){
                                        echo '<div class="disp">Student &nbsp; <input type="checkbox" checked> </div>';
                                        }
                                        else{
                                            echo 'Student <br>';
                                        }
                                        ?>
                                        
                                   
                                        <?php endif ?>  
                                    <?php
                                    //admin
                                    if ($_SESSION['usertype'] == 3): ?>
                                  
                                    Path:
                                    <br>You
                                    <br>&nbsp;<i class="fa-solid fa-minus fa-rotate-90"></i>
                                    <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                    <br>anyone
                                    <br>
                                    <?php endif ?> 
                                    <?php
                                    //student
                                    if ($_SESSION['usertype'] == 4): ?>
                                        Path:
                                        <br>You
                                        <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 2){
                                        echo '<div class="disp">Staff &nbsp; <input type="checkbox" checked> </div>';
                                        }
                                        else{
                                            echo 'Staff <br>';
                                        }
                                        ?>
                                        &nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 1){
                                        echo '<div class="disp">Principal &nbsp; <input type="checkbox" checked> </div>';
                                        }
                                        else{
                                            echo 'Principal <br>';
                                        }
                                        ?>
                                        &nbsp;<i class="fa-solid fa-minus fa-rotate-90"></i>   revert back
                                        <br>&nbsp;<i class="fa-solid fa-arrow-down"></i>
                                        <br>
                                        <?php if ($toUserObject->usertype == 4 and $fromUserObject->id != $toUserObject->id){
                                        echo '<div class="disp">You &nbsp; <input type="checkbox" checked> </div>';
                                        }
                                        else{
                                            echo 'You <br>';
                                        }
                                        ?>
                                       
                                        <?php endif ?>  
                                        <br>
                                        
                                        <div class="note">
                        <?php if (! isDispatchable($connection, $fileObject->id)): ?>
                            
                                    * Dispatched by you 
                            
                        <?php endif ?>

                        <?php if (isDispatchable($connection, $fileObject->id)): ?>
                                   * Not Dispatched yet 
                        <?php endif ?>
                        </div>
                        <br>
                </div>
            </div>
                            
    </div>
</div>
</div>
</div>
</div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</html>