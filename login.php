<?php 

require "connection/connection.php";

//Protecting Pages
if (isset($_SESSION['user'])) {
    header("location: home.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap');
     body {
            padding-top: 20px; 
        }

        body {
            background-image: url('bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            color: #333;
        }

        .heading {
            margin-top: 10px;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            
        
        }

        .heading-container {
          background-color: #f2f2f2; 
            padding: 20px;
        }

        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
            }
        }
    </style>
    <title>Login</title>
</head>
<body>
<div class="container-fluid">
<div class="heading-container">
            <h1 class="heading">College Event Handling</h1>
        </div>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <div class="d-flex justify-content-center">
                            <h1 class="heading">Sign in</h1>
                            <!-- <img src="bg-icon.jpg" class="img-fluid mb-4" alt="Icon image" style="height: 100px; width: 150px;"> -->
                        </div>
              <form action="logging.php" method = "POST">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form1Example13">Email address</label>
                  <input type="email" name ="email" id="form1Example13" placeholder="Email Address" class="form-control form-control-lg" />
                </div>
                
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form1Example23">Password</label>
                  <input type="password" name = "password" id="form1Example23" placeholder="Password" class="form-control form-control-lg" />
                </div>
                
                <!--type-->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form1Example13">Type</label>
                  <select name="type" id="form1Example33" class="form-select">
                    <option value="3">admin</option>
                    <option value="1">Principal</option>
                    <option value="2">Staff</option>
                    <option value="4">Student</option>
                    <option value="5">HOD</option>
                    <option value="6">Cultural Commitee</option>
                    <option value="7">Technical Commitee</option>
                    <option value="8">Sports Commitee</option>
                    
                  </select>
                  <!-- <input type="number" name ="type" id="form1Example33" placeholder="Type of user" class="form-control form-control-lg" /> -->
                  
                  
                </div>
                
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                <!--       
                  <div class="divider d-flex align-items-center my-4">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/Sinup.html"
                    class="link-danger">Register</a></p>
                  </div> -->
                </form>
              </div>
              <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="fts1.jpg"
                  class="img-fluid" alt="Phone image">
              </div>
          </div>
        </div>
      </section>
      </div>

</body>
