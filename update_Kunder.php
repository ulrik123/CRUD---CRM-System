<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];

    $database = new Database();
    $conn = $database->getConnection();

    $query = "UPDATE kunder SET fornavn = ?, etternavn = ?, telefon = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([$fornavn, $etternavn, $telefon, $email, $id])) {
        // Redirect back to the company info page
        header("Location: Bedrift_Info.php?id={$_POST['bedrift_id']}"); // Include bedrift_id as hidden input in form
    } else {
        echo "Error updating customer.";
    }
} else {
    $id = $_GET['id'] ?? die('ID not provided');
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT id, bedrift_id, fornavn, etternavn, telefon, email FROM kunder WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $kunde = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$kunde) die('Customer not found');
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Rediger Kunde</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="Rediger_Kunder.php" method="post">
    <input type="hidden" name="id" value="<?php echo $kunde['id']; ?>">
    <input type="hidden" name="bedrift_id" value="<?php echo $kunde['bedrift_id']; ?>">

    <label for="fornavn">Fornavn:</label>
    <input type="text" id="fornavn" name="fornavn" value="<?php echo htmlspecialchars($kunde['fornavn']); ?>" required>

    <label for="etternavn">Etternavn:</label>
    <input type="text" id="etternavn" name="etternavn" value="<?php echo htmlspecialchars($kunde['etternavn']); ?>" required>

    <label for="telefon">Telefon:</label>
    <input type="text" id="telefon" name="telefon" value="<?php echo htmlspecialchars($kunde['telefon']); ?>" required>

    <label for="email">E-post:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($kunde['email']); ?>" required>

    <input type="submit" value="Oppdater">
</form>

</body>
</html>
