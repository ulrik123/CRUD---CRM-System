<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $database = new Database();
    $conn = $database->getConnection();

    $query = "DELETE FROM bedrift WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([$id])) {
        echo "Bedriften er slettet.";
        // Redirect to the Bedrift_Panel.php or a confirmation page
    } else {
        echo "Det oppsto en feil ved sletting av bedriften.";
    }
} else {
    // Display confirmation form or handle incorrectly accessed script
    echo "Dette skriptet skal kun tilgås via POST-metoden.";
}
