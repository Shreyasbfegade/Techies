<?php

require "connection/connection.php";

if (!isset($_SESSION['user'])) {
    header("location: index.php");
} else {
    $user_id = $_SESSION['user'];
    $getQuery = "SELECT * FROM users where id = $user_id";
    $result = mysqli_query($connection, $getQuery);
    $userData = mysqli_fetch_array($result);
}
if (!$userData[4]) {
    header("location: index.php");
} else {
    $getAllUsers = "SELECT * FROM users;";
    $results = mysqli_query($connection, $getAllUsers);
    $usersData = mysqli_fetch_all($results);
    $welcome = 'User Section <span><i class="fa-solid fa-user"></i>';
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
        .container {
            margin: 0px 0px 0px -25px;
        }

        .Wel {
            margin-left: 317px;
            margin-right: 130px;
        }

        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }

        .theader {
            background: #dadada !important;
            padding-bottom: 1rem !important;
            padding-top: 1rem !important;
            padding-left: 23rem !important;
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
                                                <th colspan="8" class="theader">Details of All The Users <i class="fa-solid fa-users"></i></th>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #e9ecef;" scope="col">#</th>
                                                <th style="background-color: #e9ecef;" scope="col">Name</th>
                                                <th style="background-color: #e9ecef;" scope="col">Email</th>
                                                <th style="background-color: #e9ecef;" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; ?>
                                            <?php foreach ($usersData as $user) : ?>
                                                <?php if ($user[1] !=='admin'):?>
                                              <?php $count++; ?>
                                                <tr>
                                                    
                                                    <th scope="row"><?php echo $count ?></th>
                                                    <td><?php echo  $user[1] ?></td>
                                                    <td><?php echo  $user[2] ?></td>
                                                    <td> <form method="post" action="deleteuser.php"> 
                                                                    <input type="hidden" name="user_id" value="<?php echo $user[0]; ?>">
                                                                    <button class = "btn btn-danger" type="submit" name="remove_user">Remove user</button>
                                                                    </form>
                                                    </td>
                                                    
                                                </tr>
                                                <?php endif?>
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