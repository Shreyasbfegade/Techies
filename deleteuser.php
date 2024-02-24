<?php
require "connection/connection.php";

if (isset($_POST['remove_user'])) {
    $user_id = $_POST['user_id'];
    
    // Ensure that the user performing the delete operation is authorized (e.g., check user's permissions)
    // Perform validation and authorization checks here

    // Delete the user from the database
    $deleteQuery = "DELETE FROM `users` WHERE `id` = $user_id";
    $result = mysqli_query($connection, $deleteQuery);

    if ($result) {
        // User deleted successfully
        header("Location: show.php"); // Redirect to the page where you show all users
    } else {
        // Handle the case where the deletion failed
        echo "Failed to delete the user.";
    }
} else {
    // Handle the case where the form was not submitted correctly
    echo "Invalid request.";
}
?>
