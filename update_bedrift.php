<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a safe way to validate and sanitize input data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $orgNr = $_POST['org_nr'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];

    $database = new Database();
    $conn = $database->getConnection();

    $query = "UPDATE bedrift SET name = ?, org_nr = ?, telefon = ?, email = ?, adresse = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([$name, $orgNr, $telefon, $email, $adresse, $id])) {
        header('Location: Bedrift_Panel.php'); // Redirect on success
    } else {
        echo "Error updating record.";
    }
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : die('ID not provided');

    $database = new Database();
    $conn = $database->getConnection();

    // Fetch the current details of the company to pre-fill the form
    $query = "SELECT id, name, org_nr, telefon, email, adresse FROM bedrift WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $bedrift = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Oppdater Bedrift</title>
    <link rel="stylesheet" href="style.css"> <!-- Link your CSS -->
</head>
<body>

<form action="Bedrift_Oppdater.php" method="post">
    <input type="hidden" name="id" value="<?php echo $bedrift['id']; ?>">

    <label for="name">Navn:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($bedrift['name']); ?>" required>

    <label for="org_nr">Org Nr:</label>
    <input type="text" id="org_nr" name="org_nr" value="<?php echo htmlspecialchars($bedrift['org_nr']); ?>" required>

    <label for="telefon">Telefon:</label>
    <input type="text" id="telefon" name="telefon" value="<?php echo htmlspecialchars($bedrift['telefon']); ?>" required>

    <label for="email">E-post:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($bedrift['email']); ?>" required>

    <label for="adresse">Adresse:</label>
    <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($bedrift['adresse']); ?>" required>

    <input type="submit" value="Oppdater">
</form>

</body>
</html>
