<?php
require_once 'Database.php';

class BedriftPanel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getBedrifter() {
        $query = "SELECT * FROM Bedrift";
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($this->conn));
        }

        $bedrifter = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $bedrifter;
    }

    public function displayBedrifter() {
        $bedrifter = $this->getBedrifter();
        
        if (count($bedrifter) > 0) {
            foreach ($bedrifter as $bedrift) {
                echo "<div class='box'>";
                echo "<h2>" . htmlspecialchars($bedrift['Bedrift_Navn']) . "</h2>";
                echo "<p><strong>Org Nr:</strong> " . htmlspecialchars($bedrift['Org_Nr']) . "</p>";
                echo "<p><strong>E-post:</strong> " . htmlspecialchars($bedrift['Email']) . "</p>";
                echo "<p><strong>Telefon:</strong> " . htmlspecialchars($bedrift['Telefon']) . "</p>";
                echo "<div class='grid-container'>";
                for ($i = 1; $i <= 3; $i++) {
                    echo "<div class='grid-item'>Element $i</div>";
                }
                echo "</div>"; 
                echo "</div>"; 
            }
        } else {
            echo "Ingen bedrifter funnet.";
        }
    }
}
?>

<style>
.container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 20px; /* Add padding from the edges */
}
 
.box {
    padding: 20px;
    background-color: #ecf0f1; /* Light gray background */
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle box shadow */
    border: 1px solid #ddd; /* Border around each box */
    margin-bottom: 20px; /* Space between boxes */
}
 
.grid-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}
 
.grid-item {
    padding: 10px;
    border: 1px solid #ccc;
}
</style>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Bedriftspanel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <h1>Bedrift Panel</h1>
    <a href="Create_bedrift.php" class="create-button">Legg til ny Bedrift</a>
</div>

<?php
$panel = new BedriftPanel();
$panel->displayBedrifter();
?>

</body>
</html>
