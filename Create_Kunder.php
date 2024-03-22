<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $fodsel_dato = $_POST['fodsel_dato'];

    $database = new Database();
    $conn = $database->conn;

    $query = "INSERT INTO Kunder";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([$fornavn, $etternavn, $telefon, $email, $fodsel_dato])) {
        header('Location: Kunder_Panel.php'); 
    } else {
        echo "Error: Could not create the customer.";
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Legg til ny Kunde</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="Create_Kunder.php" method="post">
    <label for="fornavn">Fornavn:</label>
    <input type="text" id="fornavn" name="fornavn" required>

    <label for="etternavn">Etternavn:</label>
    <input type="text" id="etternavn" name="etternavn" required>

    <label for="telefon">Telefon:</label>
    <input type="text" id="telefon" name="telefon" required>

    <label for="email">E-post:</label>
    <input type="email" id="email" name="email" required>

    <label for="fodsel_dato">Fødsel dato:</label>
    <input type="date" id="fodsel_dato" name="fodsel_dato" required>

    <input type="submit" value="Legg til">
</form>

</body>
</html>
