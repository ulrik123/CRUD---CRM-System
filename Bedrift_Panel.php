<?php
require_once 'Database.php';

class BedriftPanel {
    private $conn;

    public function __construct() {
        $database = new Database(); // This creates the database connection
        $this->conn = $database->conn; // Directly access the connection from the Database object
    }

    public function getBedrifter() {
        $query = "SELECT * FROM Bedrift"; // Make sure the table name is correctly capitalized
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
        foreach ($bedrifter as $bedrift) {
            echo "<div class='bedrift'>";
            // Use the correct column names as per your database schema
            echo "<h2>" . htmlspecialchars($bedrift['Bedrift_Navn']) . "</h2>";
            echo "<p>Org Nr: " . htmlspecialchars($bedrift['Org_Nr']) . "</p>";
            // Add more details and HTML as needed
            echo "</div>";
        }
    }
}

// HTML and usage of BedriftPanel class
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Bedriftspanel</title>
    <link rel="stylesheet" href="style.css"> <!-- Ensure the path to your CSS file is correct -->
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
