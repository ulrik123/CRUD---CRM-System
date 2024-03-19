<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $database = new Database();
    $conn = $database->getConnection();

    $query = "DELETE FROM kunder WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([$id])) {
        header("Location: Bedrift_Info.php?id={$_POST['bedrift_id']}"); // Redirect back, include bedrift_id as hidden input in form
    } else {
        echo "Error deleting customer.";
    }
} else {
    // Handle the case where there's no POST request, possibly showing an error or redirecting
}
