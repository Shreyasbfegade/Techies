<?php
require "connection/connection.php";
require "init.php";

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    exit(); // Terminate script execution after redirection
}

if (isset($_GET['id'])) {
    $imageId = $_GET['id'];

    $query = "SELECT * FROM `files` WHERE id = $imageId;";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $imageData = mysqli_fetch_assoc($result);
        $imageType = $imageData['attachment_type'];
        $Name = $imageData['filename'];
        $text = $imageData['description'];
        $Remark = ""; 
    } else {
        echo '<p>Image not found.</p>';
        exit();
    }
} else {
    echo '<p>Invalid request.</p>';
    exit();
}
$welcome = 'Welcome to View Document <span><i class="far fa-file"></i></span> ';
    $extraItem = '<div class="dropdown pb-4 pt-2 ">
    <a href="#" class="d-flex align-items-center text-Black text-decoration-none dropdown-toggle size Wel"
        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="d-sm-inline mx-1 ">Applications <i class="far fa-edit "></i></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow Wel">
        <li><a class="dropdown-item" href="files.php">View Application</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="addfile.php">Write Application</a></li>
    </ul>';
    $back = 'files.php';
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <style>
        #pdfContainer {
            position: relative;
            margin-top: -60px;
            overflow: auto;
        }

        #pdfCanvas {
            border: 1px solid black;

        }

        /* #colorPicker {
         display: none;
        } */

        .Wel {
            margin-left: 125px;
        }

        .navbar {
            height: 50px;
        }

        .container {
            padding: 0;
            margin: 0;
            max-width: 600px;
        }

        .btn {
            margin: 8px;
        }

        .flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #navbar {
      position: sticky;
      top: 0;
      z-index: 100;
    }

    </style>
    
        
</head>

<body>

<?php include 'nav2.php'; ?>

    <div class="container-fluid ">
        <div class="row ">
        <?php include 'sidebar.php'; ?>
            <div class="col py-3" style="background-color: #dadada; height: 700px;">
                <div class="container">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary w-100" style="height: 564px; width: 800px;"> <!-- Adjust the height as needed -->
                            <div class="panel-heading">
                                <div style="border: 1px solid black; width: 800px; height: 600px;  background-color:black; margin-left:100px">
                                    <div class="flex">
                                        <input type="hidden" name="imageId" value="<?php echo $imageId; ?>">
                                        <label for="colorPicker" style ="font-size: 1.25rem; margin-right: 1rem;margin-left: 0.5rem;cursor: pointer;color: #6c757d;"><i class="fa-solid fa-pen"></i></label>
                                        <input type="color" id="colorPicker" name="color" value="#000000">
                                        <label for="brushSize" style ="font-size: 1.25rem; margin-right: 1rem;margin-left: 0.5rem;cursor: pointer;color: #6c757d;">Brush Size:</label>
                                        <input type="range" id="brushSize" name="brushSize" min="1" max="20" value="5">
                                        <button type="button" class="btn btn-danger" id="resetAnnotationsButton">Reset <i class="fas fa-sync"></i></button>
                                    <button type="button" class="btn btn-success" id="downloadButton">Download   <i class="fa-solid fa-file-arrow-down"></i> </button>

                                </div>
                                    <canvas id="imageCanvas" width="800px" height="600px"></canvas>

                                    
                                </div>

                            </div>




                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
     

////////////////////////////
const canvas = document.getElementById("imageCanvas");
        const context = canvas.getContext("2d");
        const colorPicker = document.getElementById("colorPicker");
        const brushSize = document.getElementById("brushSize");
        
        const img = new Image();
        img.src = "data:<?php echo $imageType; ?>;base64,<?php echo base64_encode($imageData['attachment']); ?>";
        img.onload = function () {
            context.drawImage(img, 0, 0, canvas.width, canvas.height);
        }

        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;

        canvas.addEventListener("mousedown", (e) => {
            isDrawing = true;
            [lastX, lastY] = [e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top];
        });

        canvas.addEventListener("mousemove", draw);

        canvas.addEventListener("mouseup", () => {
            isDrawing = false;
            [lastX, lastY] = [0, 0];
        });

        canvas.addEventListener("mouseout", () => (isDrawing = false));

        function draw(e) {
            if (!isDrawing) return;

            context.beginPath();
            context.moveTo(lastX, lastY);
            context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
            context.strokeStyle = colorPicker.value;
            context.lineWidth = brushSize.value;
            context.lineCap = "round";
            context.stroke();

            [lastX, lastY] = [e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top];
        }

//////////////////
      

        const downloadButton = document.getElementById("downloadButton");

        downloadButton.addEventListener("click", () => {
            const downloadLink = document.createElement("a");
            const annotatedImageData = canvas.toDataURL("image/jpeg");
            downloadLink.href = annotatedImageData;
            downloadLink.download = "annotated_image.jpg";
            downloadLink.click();
        });

        // function to reset the annotations
function resetAnnotations() {
    // Clear the canvas
    context.clearRect(0, 0, canvas.width, canvas.height);
    
    
    img.onload(); // This will redraw the image on the canvas
}
const resetAnnotationsButton = document.getElementById("resetAnnotationsButton");

resetAnnotationsButton.addEventListener("click", () => {
    resetAnnotations();
});

    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</html>