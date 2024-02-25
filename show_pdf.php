<?php

require "connection/connection.php";

if (!isset($_SESSION['user'])) {
    header("location: index.php");
} else {
    $user_id = $_SESSION['user'];
    $getQuery = "SELECT * FROM `users` where `id` = $user_id";
    $result = mysqli_query($connection, $getQuery);
    $userData = mysqli_fetch_array($result);
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

        .Wel{
        margin-left: 125px;
        }

        .gradient-custom {
        
        background: #f6d365;

        
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

        
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }

       /* .navbar{
            height: 50px; 
        } */

       .container{
        padding: 0;
        margin: 0;
        max-width: 600px;
       }

       .btn{
        margin: 8px;
       }

       .flex{
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
            <div class="col py-3" style="background-color: #dadada; height: 1400px;">
              <div class="container">
                  <div class="col-md-6 col-md-offset-3">
                      <div class="panel panel-primary w-100" style="height: 530px; width: 800px;"> <!-- Adjust the height as needed -->
                          <div class="panel-heading">
                          <div  style = "border: 1px solid black; width: 894px;height: 1380px;  background-color:black; margin-left:100px">
        <?php
        if (isset($_GET['id'])) {
            $fileId = $_GET['id'];

            // Replace with your database connection code
          
            $host = "localhost";
            $username = "root";
            $dbname = "fts_5";
            $port = 3307; // Use the appropriate port

            $conn = new mysqli($host, $username, '', $dbname, $port);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch PDF data based on the file ID
            $stmt = $conn->prepare("SELECT attachment FROM files WHERE id = ?");
            $stmt->bind_param("i", $fileId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $pdfData = $row['attachment'];

                // Output the PDF data
                echo '<div class= "flex">';
                echo '<label for="colorPicker" style ="font-size: 1.25rem; margin-right: 1rem;margin-left: 0.5rem;cursor: pointer;color: #6c757d;"><i class="fa-solid fa-pen"></i></label>';
                echo '<input type="color" id="colorPicker" onchange="changeColor(this.value)">';
                echo '<button type="button" class="btn btn-danger" onclick="resetAnnotations()">Reset <i class="fas fa-sync"></i></button>';
                echo '<button type="button" class="btn btn-warning" onclick="undoAnnotations()">Undo <i class="fa-solid fa-undo"></i></button>';
                echo '<button type="button" class="btn btn-secondary" onclick="prevPage()">Previous Page <i class="fa-solid fa-circle-down fa-rotate-90"></i></button>';
                echo '<button type="button" class="btn btn-secondary" onclick="nextPage()">Next Page <i class="fa-solid fa-circle-down fa-rotate-270"></i></button>';
                echo '<button type="button" class="btn btn-success" onclick="printPDF()">Download <i class="fa-solid fa-file-arrow-down"></i></button> </div>';
               
                
                
                // echo '<a href="post_1.php"><button class="btn btn-block btn-primary">Add File</button></a>';
                echo '<span id="pdfContainer">';
                echo '<canvas id="pdfCanvas" ></canvas>';
                echo '</span>';
                echo '<div class= "flex">';
                echo '<label for="colorPicker" style ="font-size: 1.25rem; margin-right: 1rem;margin-left: 0.5rem;cursor: pointer;color: #6c757d;"><i class="fa-solid fa-pen"></i></label>';
                echo '<input type="color" id="colorPicker" onchange="changeColor(this.value)">';
                echo '<button type="button" class="btn btn-danger" onclick="resetAnnotations()">Reset <i class="fas fa-sync"></i></button>';
                echo '<button type="button" class="btn btn-warning" onclick="undoAnnotations()">Undo <i class="fa-solid fa-undo"></i></button>';
                echo '<button type="button" class="btn btn-secondary" onclick="prevPage()">Previous Page <i class="fa-solid fa-circle-down fa-rotate-90"></i></button>';
                echo '<button type="button" class="btn btn-secondary" onclick="nextPage()">Next Page <i class="fa-solid fa-circle-down fa-rotate-270"></i></button>';
                echo '<button type="button" class="btn btn-success" onclick="printPDF()">Download <i class="fa-solid fa-file-arrow-down"></i></button> </div>';
               
                
                

            } else {
                echo '<p>File not found.</p>';
                exit();
            }
        } else {
            echo '<p>Invalid request.</p>';
            exit();
        }
        ?>
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
            
            
</body>
<script>
        const {
            jsPDF
        } = window.jspdf;
        
        const pdfCanvas = document.getElementById('pdfCanvas');
        const context = pdfCanvas.getContext('2d');
        let pdfDoc = null;
        let pageNum = 1;

        const pdfData = atob('<?php echo base64_encode($pdfData); ?>');
        const binaryData = new Uint8Array(Array.from(pdfData).map(c => c.charCodeAt(0)));

        pdfjsLib.getDocument({
            data: binaryData
        }).promise.then(pdf => {
            pdfDoc = pdf;
            renderPage(pageNum);
        });

        const annotations = []; // Store annotations for each page

function prevPage() {
    if (pageNum > 1) {
        pageNum--;
        renderPage(pageNum);
    }
}

function nextPage() {
    if (pageNum < pdfDoc.numPages) {
        pageNum++;
        renderPage(pageNum);
    }
}

function renderAnnotations(pageNumber) {
    annotations[pageNumber - 1]?.forEach(annotation => {
        context.beginPath();
        context.moveTo(annotation.points[0].x, annotation.points[0].y);
        annotation.points.forEach(point => {
            context.lineTo(point.x, point.y);
        });
        context.strokeStyle = annotation.color;
        context.lineWidth = annotation.lineWidth;
        context.stroke();
    });
}


function renderPage(num) {
    pdfDoc.getPage(num).then(page => {
        const viewport = page.getViewport({
            scale: 1.5
        });
        pdfCanvas.width = viewport.width;
        pdfCanvas.height = viewport.height;

        const renderContext = {
            canvasContext: context,
            viewport: viewport
        };

        context.clearRect(0, 0, pdfCanvas.width, pdfCanvas.height); // Clears the canvas

        page.render(renderContext).promise.then(() => {
            renderAnnotations(num); // Renders annotations after rendering the PDF content
        });
    });
}


let isDrawing = false;
let annotationX = 0;
let annotationY = 0;

pdfCanvas.addEventListener('mousedown', startDrawing);
pdfCanvas.addEventListener('mousemove', draw);
pdfCanvas.addEventListener('mouseup', stopDrawing);

function startDrawing(event) {
    isDrawing = true;
    annotationX = event.offsetX;
    annotationY = event.offsetY;
}

let currentColor = 'black';
let isErasing = false;

function changeColor(newColor) {
    currentColor = newColor;
}



function draw(event) {
    if (!isDrawing) return;

    const x = event.offsetX;
    const y = event.offsetY;

    const annotation = {
        points: [{
            x: annotationX,
            y: annotationY
        }, {
            x,
            y
        }],
        color: isErasing ? 'white' : currentColor,
        lineWidth: isErasing ? 10 : 2
    };

    annotations[pageNum - 1] = annotations[pageNum - 1] || [];
    annotations[pageNum - 1].push(annotation);

    context.beginPath();
    context.moveTo(annotationX, annotationY);
    context.lineTo(x, y);
    context.strokeStyle = annotation.color;
    context.lineWidth = annotation.lineWidth;
    context.stroke();

    annotationX = x;
    annotationY = y;
}

function stopDrawing() {
    isDrawing = false;
}


function getAnnotations() {
    const allAnnotations = [];
    for (let i = 0; i < pdfDoc.numPages; i++) {
        const pageAnnotations = annotations[i] || [];
        allAnnotations.push(...pageAnnotations);
    }
    return allAnnotations;
}


function saveAnnotations() {
// jsPDF instance
const { jsPDF } = window.jspdf;
var doc = new jsPDF();

// Define dimensions and position for the image
var imgWidth = 210; 
var imgHeight = 297; 
var xPos = 10; 
var yPos = 10; 
const base64String = pdf1Data;

// A function to add an image and return a promise
function addImageToPDF(index) {
    return new Promise((resolve) => {
        doc.addImage(base64String[index], 'PNG', xPos, yPos, imgWidth, imgHeight);
        console.log(base64String[index]);
        resolve();
    });
}

// An array to store all the image addition promises
const imagePromises = [];

// Loop through the base64String and add images to the PDF
for (let i = 0; i < base64String.length; i++) {
    if (i > 0) {
        doc.addPage();
    }
    imagePromises.push(addImageToPDF(i));
}

// Wait for all promises to resolve before saving the PDF
Promise.all(imagePromises)
    .then(() => {
        // Save the PDF
        doc.save("output.pdf", { compress: true });
    })
    .catch((error) => {
        console.error('Error adding images to PDF:', error);
    });
}


let pdf1Data = []; // array to store PDF page data URIs

function printPDF() {
    const doc = new jsPDF();
    
    for (let i = 1; i <= pdfDoc.numPages; i++) {
        pdfDoc.getPage(i).then(page => {
            const viewport = page.getViewport({ scale: 1.5 });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            const renderContext = {
                canvasContext: context,
                viewport: viewport,
            };

            page.render(renderContext).promise.then(() => {
                renderAnnotationsOnCanvas(context, i); // Render annotations on the canvas
                const imageData = canvas.toDataURL();
                // pdfdat.push(imageData);
                if (i > 1) {
                    doc.addPage(); // Add a new page for each subsequent page
                }
                doc.addImage(imageData, 'PNG', 0, 0, doc.internal.pageSize.width, doc.internal.pageSize.height, '', 'FAST');
                if (i === pdfDoc.numPages) {
                    // Save and trigger the download
                    const fileName = 'annotated_pdf.pdf';
                    doc.save(fileName, { compress: true });
                    console.log(doc);
                }
            });
        });
        
    }
}



function renderAnnotationsOnCanvas(context, pageNumber) {
    annotations[pageNumber - 1]?.forEach(annotation => {
        context.beginPath();
        context.moveTo(annotation.points[0].x, annotation.points[0].y);
        annotation.points.forEach(point => {
            context.lineTo(point.x, point.y);
        });
        context.strokeStyle = annotation.color;
        context.lineWidth = annotation.lineWidth;
        context.stroke();
    });
}

function resetAnnotations() {
    // Clear all annotations on the current page
    annotations[pageNum - 1] = [];
    
    // Clear the canvas
    context.clearRect(0, 0, pdfCanvas.width, pdfCanvas.height);

    // Redraw the page without annotations
    renderPage(pageNum);
}


// a variable to keep track of annotations history
const annotationsHistory = [];

// undoAnnotations function
function undoAnnotations() {
    if (annotations[pageNum - 1] && annotations[pageNum - 1].length > 0) {
        // Removes the last annotation from the current page's annotations
        const lastAnnotation = annotations[pageNum - 1].pop();
        
        // Stores the removed annotation in the history
        annotationsHistory.push(lastAnnotation);

        // Clear the canvas
        context.clearRect(0, 0, pdfCanvas.width, pdfCanvas.height);

        // Redraw the page without the removed annotation
        renderPage(pageNum);
    }
}



    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</html>