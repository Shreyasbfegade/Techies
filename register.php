<?php
    require "connection/connection.php";
    require "init.php";

if (!isset($_SESSION['user'])) {
    header("location: home.php");
}
  $welcome = '<i class="fa-regular fa-id-card" style="font-size: 1.5rem;"></i> Register Section ';
  $userMar = '425px';
  $back = 'Home.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="style.css">
    <title>REGISTER</title>
    <style>
      .container{
    margin: 25px 0px auto 150px ;
    width: 1050px;
    max-width: 800px;
}
    </style>
</head>
<body>
<?php include 'nav2.php'; ?>

    <div class="container-fluid ">
        <div class="row flex-nowrap">
        <?php include 'sidebar.php'; ?>
            <div class="col py-3" style="background-color: #dadada;">
                <div class="container">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary" style="height: 530px; width: 800px;"> <!-- Adjust the height as needed -->
                            <div class="panel-heading">
                            <h2 class="fw-bold mb-2">Register</h2>
            <form action="registering.php" method="post" autocomplete="off">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="form-outline mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="form3Example1">Name</label>
                    <input type="text" name="name" id="form3Example1" class="form-control" />
                    
                  </div>
                </div>
                
              </div>
  
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3" >Email address</label>
                <input type="email" name="email" id="form3Example3" class="form-control" />
              </div>
  
              <!-- Password input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Password</label>
                <input type="password" name="password" id="form3Example4" class="form-control" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Confirm Password</label>
                <input type="password" name="confirm_password" id="form3Example5" class="form-control" />
              </div>

              <!-- <div class="form-outline mb-4">
                <label class="form-label" for="form3Example6">user type</label>
                <input type="text" name="usertype" id="form3Example6" class="form-control" />
              </div> -->
              <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example6">User Type</label>
                  <select name="usertype" id="form3Example6" class="form-control">
                  <option value="3">admin</option>
                  <option value="1">Principal</option>
                  <option value="2">Staff</option>
                  <option value="4">Student</option>
               
                  </select>
                  <!-- <input type="number" name ="type" id="form1Example33" placeholder="Type of user" class="form-control form-control-lg" /> -->
                
                
                </div>
  
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Add User
              </button>
              </div>
            </form>
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
  <!-- Section: Design Block -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>