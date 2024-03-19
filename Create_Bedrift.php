<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bedriftNavn = isset($_POST['bedriftNavn']) ? $_POST['bedriftNavn'] : '';
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];

    $database = new Database();
    $conn = $database->conn;

    $query = "INSERT INTO Bedrift (Bedrift_Navn, Telefon, Email, Adresse) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([$bedriftNavn, $telefon, $email, $adresse])) {
        header('Location: Bedrift_Panel.php'); // Redirect on success
    } else {
        echo "Error: Could not create the company.";
    }
}

?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Legg til ny Bedrift</title>
    <link rel="stylesheet" href="style.css"> <!-- Ensure the path to your CSS file is correct -->
</head>
<body>

<form action="Create_Bedrift.php" method="post">
    <label for="bedriftNavn">Bedrift Navn:</label>
    <input type="text" id="bedriftNavn" name="bedriftNavn" required>

    <label for="telefon">Telefon:</label>
    <input type="text" id="telefon" name="telefon" required>

    <label for="email">E-post:</label>
    <input type="email" id="email" name="email" required>

    <label for="adresse">Adresse:</label>
    <input type="text" id="adresse" name="adresse" required>

    <label for="kunderKundeId">Kunder Kunde ID:</label>
    <input type="number" id="kunderKundeId" name="kunderKundeId" required>

    <input type="submit" value="Legg til">
</form>

</body>
</html>
