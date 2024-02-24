<?php

require "connection/connection.php";

if (!isset($_SESSION['user'])) {
    header("location: home.php");
    die();
} else {
    $user_id = $_SESSION['user'];
    $getQuery = "SELECT * FROM `users` where `id` = $user_id";
    $result = mysqli_query($connection, $getQuery);
    $userData = mysqli_fetch_array($result);
    $welcome = "Welcome " . $userData[1]; 
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
      .Wel{
        margin-left: 150px;
      }
      .size{
        font-size: 20px;
      }
      .container{
        margin: 50px 0px auto 15px;
      }
      
      .gradient-custom {
        /* fallback for old browsers */
        background: #f6d365;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
       }

        h5{
            padding-left: 15px;
       }
    </style>

</head>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <?php include 'navbar.php'; ?>
        <div class="container-fluid ">
        <div class="row flex-nowrap">
        <?php include 'sidebar.php'; ?>
            <div class="col py-3" style="background-color: #dadada;">
              <div class="container">
                  <div class="col-md-6 col-md-offset-3">
                      <div class="panel panel-primary" style="height: 530px; width: 800px;"> <!-- Adjust the height as needed -->
                          <div class="panel-heading">
                              <h5>User Information </h5>
                          </div>
                          <div style="padding: 10px;">
                            <div class="card mb-3" style="border-radius: .5rem;">
                              <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-white"
                                  style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;padding-top: 35px;">
                                  <img src="images/Profile.jpg" alt="hugenerd" width="35" height="35" class="rounded-circle" style="width: 75px;height: 76px;margin-bottom: 20px;">
                                  <h4><?php echo $userData[1] ?></h4>
                                  <?php if($_SESSION['usertype'] ==1):?>
                                  <h5>Principal</h5>
                                  <?php endif?>
                                  <?php if($_SESSION['usertype'] ==2):?>
                                  <h5>Staff</h5>
                                  <?php endif?>
                                  <?php if($_SESSION['usertype'] ==3):?>
                                  <h5>Admin</h5>
                                  <?php endif?>
                                  <?php if($_SESSION['usertype'] ==4):?>
                                  <h5>Student</h5>
                                  <?php endif?>
                                  <?php if($_SESSION['usertype'] ==5):?>
                                  <h5>HOD</h5>
                                  <?php endif?>
                                  
                                </div>
                                <div class="col-md-8">
                                  <div class="card-body p-4">
                                    <h6>Contact Details</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                      <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?php echo $userData[2] ?></p>
                                      </div>
                                      <div class="col-6 mb-3">
                                       
                                      </div>
                                    </div>
                                  
                                   
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
        
    <?php endif ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>
