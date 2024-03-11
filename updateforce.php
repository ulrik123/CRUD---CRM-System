<?php
include 'connect.php';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

 
    // Update the record in the database
    $sql_update = "UPDATE kunder SET fornavn='$fornavn', etternavn='$etternavn', telefon='$telefon', email='$email' WHERE kunde_id=$id";
    mysqli_query($conn, $sql_update);
 
    // Redirect back to the list page
    header("location: Read.php");
}
 
mysqli_close($conn);
?>