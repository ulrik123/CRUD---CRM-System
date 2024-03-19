<?php
require_once 'Database.php';

class BedriftInfo {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getBedriftById($id) {
        $query = "SELECT id, name, org_nr, telefon, email, adresse, logo FROM bedrift WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getKunderByBedriftId($bedriftId) {
        $query = "SELECT id, fornavn, etternavn, telefon, email FROM kunder WHERE bedrift_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $bedriftId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Assuming an ID is passed via GET request
$bedriftId = isset($_GET['id']) ? $_GET['id'] : die('ID not provided');
$info = new BedriftInfo();
$bedrift = $info->getBedriftById($bedriftId);
$kunder = $info->getKunderByBedriftId($bedriftId);
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
