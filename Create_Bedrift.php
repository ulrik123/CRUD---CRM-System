<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bedriftNavn = isset($_POST['Bedrift_Navn']) ? $_POST['Bedrift_Navn'] : '';
    $telefon = isset($_POST['Telefon']) ? $_POST['Telefon'] : '';
    $email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $adresse = isset($_POST['Adresse']) ? $_POST['Adresse'] : '';

    $database = new Database();
    $conn = $database->conn;

    // The table name and column names should not be enclosed in single quotes, use backticks or nothing at all
    $query = "INSERT INTO Bedrift (Bedrift_Navn, Telefon, Email, Adresse) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Add error handling and execution of the prepared statement
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    if ($stmt->bind_param('ssss', $bedriftNavn, $telefon, $email, $adresse) === false) {
        die('Bind param failed: ' . $stmt->error);
    }

    if ($stmt->execute() === false) {
        echo "Error: Could not create the company.";
    } else {
        // Redirect to Bedrift_Panel.php if the insert is successful
        header('Location: Bedrift_Panel.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Legg til ny Bedrift</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="Create_Bedrift.php" method="post">
    <label for="Bedrift_Navn">Bedrift Navn:</label>
    <input type="text" id="Bedrift_Navn" name="Bedrift_Navn" required>

    <label for="Telefon">Telefon:</label>
    <input type="text" id="Telefon" name="Telefon" required>

    <label for="Email">E-post:</label>
    <input type="email" id="Email" name="Email" required>

    <label for="Adresse">Adresse:</label>
    <input type="text" id="Adresse" name="Adresse" required>
    
    <input type="submit" value="Legg til">
</form>

</body>
</html>
