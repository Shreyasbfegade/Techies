<?php
require "connection/connection.php";

if (!isset($_SESSION['user'])) {
    header("location: home.php");
    die();
}

$attached = null;
if (isset($_FILES["fileupload"])) {
    $attached = $_FILES["fileupload"]["tmp_name"];
    // mysqli_real_escape_string escapes any special characters in the file content to prevent SQL injection when inserting it into the database.

    $attached = mysqli_real_escape_string($connection, file_get_contents($attached)); // Read and escape the file content
}

$file_id = ($_POST["file_id"]);
$file_name = ($_POST["file_name"]);
$description = ($_POST["description"]);
$venue = ($_POST["venue"]);
$date = ($_POST["date"]);
$freeslot = ($_POST["freeSlots"]);

// file extension se type determine kar rhe hai file ka 
// strtolower use kar rhe kyuki .JPG bhi save hota hai .jpg to sab lowercase me hi rakhna better practice ke liye 
$fileExtension = strtolower(pathinfo($_FILES["fileupload"]["name"], PATHINFO_EXTENSION));

// ye array me sare files ke types hai jo aapan project me use kar rhe hai 
$attachmentTypes = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'jpg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
];

// apne map me jo files hai wo nhi rha to ye 'application/octet-stream' default save hoga. 
$attachmentType = isset($attachmentTypes[$fileExtension]) ? $attachmentTypes[$fileExtension] : 'application/octet-stream';

$rawQuery = "INSERT INTO `files` (`hardid`, `filename`, `attachment`, `attachment_type`, `description`, `user_id`) VALUES ('%s', '%s', '%s', '%s', '%s', '%d');";
$query = sprintf($rawQuery, $file_id, $file_name, $attached, $attachmentType, $description, $_SESSION['user']);
$result = mysqli_query($connection, $query, MYSQLI_USE_RESULT);

$fileid = mysqli_insert_id($connection);



// Tracking ke liye ye query hai 
$rawMovementQuery = "INSERT INTO `movements` (`from_id`, `file_id`, `to_id`) VALUES ('%d', '%d', '%d');";
$movementQuery = sprintf($rawMovementQuery, $_SESSION['user'], $fileid, $_SESSION['user']);
$result = mysqli_query($connection, $movementQuery);


if ($venue=='auditorium') {
  $venue = 1;
}
if ($venue=='turf') {
    $venue = 2;
  }
  if ($venue=='CollegeGround') {
    $venue = 2;
  }
$new = "INSERT INTO `Request` (`date`, `venue_id`, `time_slot`) VALUES ('%s', '%s', '%s');";
$newQuery = sprintf($new, $date, $venue, $freeslot);
$result = mysqli_query($connection, $newQuery);

header("location: files.php");
?>
