<?php
require_once 'Database.php';

$database = new Database();
$conn = $database->conn;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Bedrift WHERE Bedrift_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bedrift = $result->fetch_assoc();

    // Now, display the bedrift details
    // For example:
    echo "<h2>" . htmlspecialchars($bedrift['Bedrift_Navn']) . "</h2>";
    // Add more details as needed
} else {
    echo "Bedrift ID not provided.";
}
?>


<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Bedrift Info</title>
    <link rel="stylesheet" href="style.css"> <!-- Link your CSS -->
</head>
<body>

<div class="bedrift-info">
    <h2><?php echo htmlspecialchars($bedrift['name']); ?></h2>
    <p>Org Nr: <?php echo htmlspecialchars($bedrift['org_nr']); ?></p>
    <p>Telefon: <?php echo htmlspecialchars($bedrift['telefon']); ?></p>
    <p>Email: <?php echo htmlspecialchars($bedrift['email']); ?></p>
    <p>Adresse: <?php echo htmlspecialchars($bedrift['adresse']); ?></p>
    <button onclick="window.location.href='Bedrift_Oppdater.php?id=<?php echo $bedrift['id']; ?>'">Oppdater</button>
</div>

<div class="kunder-list">
    <h3>Kunder</h3>
    <?php foreach ($kunder as $kunde): ?>
    <div class="kunde">
        <p><?php echo htmlspecialchars($kunde['fornavn']) . ' ' . htmlspecialchars($kunde['etternavn']); ?></p>
        <p>Telefon: <?php echo htmlspecialchars($kunde['telefon']); ?></p>
        <p>Email: <?php echo htmlspecialchars($kunde['email']); ?></p>
        <button onclick="window.location.href='Rediger_Kunder.php?id=<?php echo $kunde['id']; ?>'">Rediger</button>
        <button onclick="window.location.href='Slett_Kunder.php?id=<?php echo $kunde['id']; ?>'">Slett</button>
    </div>
    <?php endforeach; ?>
    <button onclick="window.location.href='Create_Kunder.php?bedrift_id=<?php echo $bedriftId; ?>'">Legg til ny kunde</button>
</div>

</body>
</html>
