<?php
// Include the connection string
include 'connect.php';

// Initialize variables
$Org_Nr = $Bedrift_Navn = $telefon = $email = $Adresse = '';
$Org_Nr = 0; // Initialize as 0 or any other appropriate default value

// Check if Org_Nr is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the Org_Nr from the URL
    $Org_Nr = $_GET['id'];

    // Fetch customer data based on the Org_Nr
    $sql_fetch = "SELECT Org_Nr, Bedrift_Navn, telefon, email, Adresse FROM bedrift WHERE Org_Nr = ?";
    if ($stmt = mysqli_prepare($conn, $sql_fetch)) {
        mysqli_stmt_bind_param($stmt, "i", $Org_Nr);
        if (mysqli_stmt_execute($stmt)) {
            $result_fetch = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result_fetch) > 0) {
                $row = mysqli_fetch_assoc($result_fetch);
                // Populate variables with data from fetched row
                $Org_Nr = $row['Org_Nr'];
                $Bedrift_Navn = $row['Bedrift_Navn'];
                $telefon = $row['telefon'];
                $email = $row['email'];
                $Adresse = $row['Adresse'];
            } else {
                echo "No record found with Org_Nr: " . $Org_Nr;
                // If no record is found, reset the Org_Nr to prevent the form from showing
                $Org_Nr = 0;
            }
        } else {
            echo "Error fetching record: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oppdater Kunde</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif; /* Or your preferred font */
        }

        .container {
            max-width: 600px; /* Or your preferred max width */
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* So the padding doesn't affect the total width */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>OPPDATER BEDRIFTER</h2>
        <form method="POST">
            <input type="hidden" name="update_id" value="<?= htmlspecialchars($Org_Nr) ?>">
            <label for="Org_Nr">Org_Nr:</label>
            <input type="text" id="Org_Nr" name="Org_Nr" value="<?= htmlspecialchars($Org_Nr) ?>">

            <label for="Bedrift_Navn">Bedrift_Navn:</label>
            <input type="text" id="Bedrift_Navn" name="Bedrift_Navn" value="<?= htmlspecialchars($Bedrift_Navn) ?>">

            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" name="telefon" value="<?= htmlspecialchars($telefon) ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">

            <label for="Adresse">Adresse:</label>
            <input type="text" id="Adresse" name="Adresse" value="<?= htmlspecialchars($Adresse) ?>">

            <input type="submit" value="Oppdater">
        </form>
    </div>
</body>
</html>
