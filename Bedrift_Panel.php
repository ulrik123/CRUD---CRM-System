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
                // Making each box clickable and redirect to Bedrift_Info.php
                echo "<div class='box'>";
                echo "<h2>" . htmlspecialchars($bedrift['Bedrift_Navn']) . "</h2>";
                echo "<p><strong>Org Nr:</strong> " . htmlspecialchars($bedrift['Org_Nr']) . "</p>";
                echo "<p><strong>E-post:</strong> " . htmlspecialchars($bedrift['Email']) . "</p>";
                echo "<p><strong>Telefon:</strong> " . htmlspecialchars($bedrift['Telefon']) . "</p>";
                echo "<p><strong>Adresse:</strong> " . htmlspecialchars($bedrift['Adresse']) . "</p>";
                
                // Buttons for editing and deleting with confirmation modal
                echo "<div class='action-container'>";
                echo "<a href='Update_bedrift.php?id=" . $bedrift['Bedrift_id'] . "' class='action-button edit-button'>Rediger</a>";
                echo "<button onclick='showDeleteModal(" . $bedrift['Bedrift_id'] . ")' class='action-button delete-button'>Slett</button>";
                echo "</div>"; // End action-container
                
                echo "</div>"; // End box
            }
        } else {
            echo "Ingen bedrifter funnet.";
        }
    }
}

$panel = new BedriftPanel();

?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Bedriftspanel</title>
    <style>
          <style>
        body {
            margin: 0;
            padding: 0;
            /* Updated gradient background with light blue and light red */
            background: linear-gradient(to right top, #89d4cf, #f4c4f3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            flex-direction: column; /* Stack the header and boxes container vertically */
            align-items: center; /* Center-align the items */
            gap: 20px;
            padding: 20px;
            width: 100%; /* Ensure the container takes up the full width */
            max-width: 800px; /* Set a max-width for the container */
            margin-top: -100px; /* Adjust as necessary to position the container within the viewport */
        }

        .header {
            width: 100%; /* Header takes full width of the container */
            text-align: center; /* Center the header content */
            margin-bottom: 40px; /* Adds space below the header */
        }

        .header h1 {
            font-size: 2em; /* Make the title larger */
            font-weight: bold; /* Make the title bold */
            color: #000; /* Ensuring the text is black for visibility */
        }

        .create-button {
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #3498db; /* Blue */
            border-radius: 3px;
            display: block; /* Align the button as a block */
            margin: 0 auto; /* Center the button */
            width: max-content; /* Fit the button width to its content */
        }

        .boxes-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center the boxes horizontally */
            align-items: flex-start; /* Align the boxes to the start vertically */
            gap: 20px;
            width: 100%; /* Take full width to center children correctly */
        }

        .box {
            width: 200px; /* Adjust width as needed */
            background-color: #ecf0f1;
            border: 2px solid #ccc; /* A light grey border */
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.19), 0px 6px 6px rgba(0, 0, 0, 0.23);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
        }

        .action-button {
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #add8e6; /* Light blue */
            border: none;
            border-radius: 3px;
            margin: 5px 0;
            display: block; /* Align the button as a block */
            text-align: center;
            width: auto; /* Allow the button width to adjust to its content */
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 100px; /* Location of the box */
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px; /* Could be more or less, depending on screen size */
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .delete-confirm-btn {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            cursor: pointer;
        }

        .cancel-btn {
            background-color: #95a5a6;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Bedrift Panel</h1>
        <a href="Create_bedrift.php" class="create-button">Legg til ny Bedrift</a>
    </div>
    <div class="boxes-container">
        <?php $panel->displayBedrifter(); ?>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <p>Confirm</p>
        <p>Are you sure want to permanently delete this bedrift?</p>
        <button id="confirmDelete" class="delete-confirm-btn">Yes, Delete!</button>
        <button id="cancelDelete" class="cancel-btn">Cancel</button>
    </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("deleteModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close-button")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks on "Cancel", close the modal
document.getElementById("cancelDelete").onclick = function() {
    modal.style.display = "none";
}

// Function to show the modal
function showDeleteModal(bedriftId) {
    modal.style.display = "block";
    var confirmBtn = document.getElementById("confirmDelete");
    // Reset any previous on-click event
    confirmBtn.replaceWith(confirmBtn.cloneNode(true));
    confirmBtn = document.getElementById("confirmDelete");
    // Set up a new on-click event
    confirmBtn.onclick = function() {
        // Implement the deletion logic here, could be an AJAX call or form submission
        console.log("Deleting bedrift with ID " + bedriftId); // Replace with actual deletion logic
        modal.style.display = "none";
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
