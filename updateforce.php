<?php
include 'connect.php';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

 
    // Update the record in the database
    $sql_update = "UPDATE dyr SET Navn='$navn', Eier='$eier', Foedselsaar='$foedselsaar', Type_='$type' WHERE dnr=$id";
    mysqli_query($conn, $sql_update);
 
    // Redirect back to the list page
    header("location: les.php");
}
 
mysqli_close($conn);
?>