<?php

require "connection/connection.php";

if (!isset($_SESSION['user'])) {
    header("location: home.php");
    die();
} else {
    $welcome =  'Welcome to Student Application Section <span><i class="far fa-edit "></i></span>';
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
        h5 {
            padding-left: 200px !important;
        }

        .Wel {
            margin-left: 250px !important;
        }

        .size {
            font-size: 20px !important;
        }

        .container {
            margin: 50px 0px auto 150px;
            width: 1050px;
            max-width: 800px;
        }

        .gradient-custom {
            background: #f6d365 !important;
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1)) !important;
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1)) !important;
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
                                <h5>Please Fill the Application Form Below </h5>
                            </div>
                            <div style="padding: 10px;">
                                <form action="postaddfile.php" method="post" autocomplete="off" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="file_id">File ID</label>
                                        <input type="text" required="required" name="file_id" class="form-control opa" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="file_name">File Name</label>
                                        <input type="text" name="file_name" required="required" class="form-control opa" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">File Description (Optional)</label>
                                        <textarea name="description" class="form-control opa" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="fileupload">Soft File (Optional)</label>
                                        <input type="file" name="fileupload" class="form-control" value="">

                                        <!-- <a href="form.html">Add Attachment</a> -->
                                    </div><br>

                                    <input type="submit" class="btn btn-block btn-success " style="margin-left:275px; width: 230px;" value="Submit">
                                </form>
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