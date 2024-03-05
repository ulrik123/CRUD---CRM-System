<?php
include 'connect.php';
 
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Reconnect for deletion
    include 'connect.php';
 
    $id = $_POST['id'];
 
    // Delete the record from the database
    $sql_delete = "DELETE FROM kjeledyr WHERE kjæledyr_ID=?";
    $stmt = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt, "i", $id);
 
    if (mysqli_stmt_execute($stmt)) {
        // Success: Redirect back to the list page
        header("location: les.php");
        exit();
    }
 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>