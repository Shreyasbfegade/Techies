<?php
require "connection/connection.php";
require "init.php";

if (!isset($_SESSION['user'])) {
header("location: home.php");
} else {
$user_id = $_SESSION['user'];
$getQuery = "SELECT * FROM `movements` WHERE `to_id` = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($connection, $getQuery);

$filesData = mysqli_fetch_all($result);
$filesData = array_unique(array_map(function ($i) { return $i[2]; }, $filesData));
$welcome = 'Welcome to Student View Section <span><i class="far fa-file"></i></span>';
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
            margin: 0px 0px 0px -25px !important;
        }

        .Wel {
            margin-left: 234px !important;
        }

        .gradient-custom {
            background: #f6d365 !important;
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1)) !important;
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1)) !important;
        }

        .theader {
            background: #dadada !important;
            padding-bottom: 1rem !important;
            padding-top: 1rem !important;
            padding-left: 21.5rem !important;
            font-size: 1.25rem !important;
            font-weight: 400 !important;
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
                        <th colspan="8" class="theader">Details of Your Applications <span><i class="far fa-edit "></i></span></th>
                    </tr>
                        <tr>
                            <th style="background-color: #e9ecef;" scope="col">#</th>
                            <th style="background-color: #e9ecef;" scope="col">ID</th>
                            <th style="background-color: #e9ecef;" scope="col">Name</th>
                            <th style="background-color: #e9ecef;" scope="col">Description</th>
                            <th style="background-color: #e9ecef;" scope="col">File </th>
                            <th style="background-color: #e9ecef;" scope="col">Added on</th>
                            <th style="background-color: #e9ecef;" scope="col">Added By</th>
                            <th style="background-color: #e9ecef;" scope="col">Options</th> <!-- Added "Soft File" column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        <?php foreach ($filesData as $key => $file_id): ?>
                            <?php 
                                $fileQuery =  "SELECT * FROM `files` WHERE id = $file_id;";
                                $getFileResult = mysqli_query($connection, $fileQuery);
                                $fileObject = mysqli_fetch_object($getFileResult);

                                $createdUserQuery =  "SELECT * FROM `users` WHERE id = $fileObject->user_id;";
                                $getCreatedUserResult = mysqli_query($connection, $createdUserQuery);
                                $createdUserObject = mysqli_fetch_object($getCreatedUserResult);
                                $count++;

                                // Retrieve and display the soft file content
                                $softFileContent = base64_encode($fileObject->attachment);
                                ?>
                            
                                <?php 
                                ///////
                                if ($createdUserObject !== null && $createdUserObject->name !==null):
                                    ?>
                            <tr>
                                <th scope="row"><?php echo $count ?></th>
                                <td><?php echo $fileObject->hardid; ?></td>
                                <td><?php echo $fileObject->filename; ?></td>
                                <td title="<?php echo $fileObject->description; ?>"><?php echo substr($fileObject->description, 0, 50); ?>...</td>
                                <td style="width: 100px;">
                                    <!-- ... (controls) -->
                                    
                                    <!-- Display the View PDF link with the file ID as a query parameter -->
                                    <?php if (strpos($fileObject->attachment_type, 'image') !== false): ?>
                                    <a href="annotate.php?id=<?php echo $fileObject->id; ?>">View Image</a>
                                    <?php elseif ($fileObject->attachment_type === 'application/pdf'): ?>
                                        <a href="show_pdf.php?id=<?php echo $fileObject->id; ?>">View PDF</a>
                                    <?php elseif ($fileObject->attachment_type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'): ?>
                                        <!-- <a href="show_word.php?id=<?php echo $fileObject->id; ?>" target="_blank">View Word</a> -->
                                        <a href="data:application/octet-stream;base64,<?php echo $softFileContent; ?>" download="<?php echo $fileObject->filename; ?>">View word file</a>
                                        <?php endif ?>
                                
                            

                                <?php if ($fileObject->attachment): ?>
                                <!-- <a  href="/file/<?php echo $fileObject->attachment ?>" download="<?php echo $fileObject->attachment ?>"><button class="btn btn-sm btn-primary">Download</button></a>  -->
                                <!-- <a href="showing.php">View PDF</a> -->
                                <?php endif ?> / 
                                <?php if ($fileObject->attachment): ?>
                                    <!-- Display the soft file download link -->
                                    <a href="data:application/octet-stream;base64,<?php echo $softFileContent; ?>" download="<?php echo $fileObject->filename; ?>">Download </a>
                                <?php endif ?>
                                </td>
                                <td style="width: 175px;" ><?php echo date("d.m.Y h.i A", strtotime($fileObject->created_at)) ?></td>
                                <td><?php echo $createdUserObject->name ?></td>
                                <td>
                                <a  href="/Techies-main/track.php?file_id=<?php echo $fileObject->id; ?>"><button class="btn btn-sm btn-primary">Track path</button></a> 
                                <?php if (isDispatchable($connection, $fileObject->id)): ?>
                                <a  href="/Techies-main/dispatch.php?file_id=<?php echo $fileObject->id; ?>"><button class="btn btn-sm btn-primary">Dispatch</button></a> 
                                <?php endif ?>
                                <?php if ($createdUserObject->id == $_SESSION['user']): ?>
                                <a  href="deletefile.php?file_id=<?php echo $fileObject->id; ?>" ><button class="btn btn-sm btn-danger">Delete</button></a> 
                                <?php endif ?>
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
