<?php
// Include the connection string
include 'connect.php';

// Initialize variables
$fornavn = $etternavn = $telefon = $email = $fodsel_dato = '';
$kunde_id = 0; // Initialize as 0 or any other appropriate default value

// Check if kunde_id is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the kunde_id from the URL
    $kunde_id = $_GET['id'];

    // Fetch customer data based on the kunde_id
    $sql_fetch = "SELECT kunde_id, fornavn, etternavn, telefon, email, fodsel_dato FROM kunder WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_fetch)) {
        mysqli_stmt_bind_param($stmt, "i", $kunde_id);
        if (mysqli_stmt_execute($stmt)) {
            $result_fetch = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result_fetch) > 0) {
                $row = mysqli_fetch_assoc($result_fetch);
                // Populate variables with data from fetched row
                $fornavn = $row['fornavn'];
                $etternavn = $row['etternavn'];
                $telefon = $row['telefon'];
                $email = $row['email'];
                $fodsel_dato = $row['fodsel_dato'];
            } else {
                echo "No record found with kunde_id: " . $kunde_id;
                // If no record is found, reset the kunde_id to prevent the form from showing
                $kunde_id = 0;
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
        <h2>OPPDATER KUNDER</h2>
        <form method="POST">
            <input type="hidden" name="update_id" value="<?= htmlspecialchars($kunde_id) ?>">
            <label for="fornavn">Fornavn:</label>
            <input type="text" id="fornavn" name="fornavn" value="<?= htmlspecialchars($fornavn) ?>">

            <label for="etternavn">Etternavn:</label>
            <input type="text" id="etternavn" name="etternavn" value="<?= htmlspecialchars($etternavn) ?>">

            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" name="telefon" value="<?= htmlspecialchars($telefon) ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">

            <label for="fodsel_dato">Fødselsdato:</label>
            <input type="date" id="fodsel_dato" name="fodsel_dato" value="<?= htmlspecialchars($fodsel_dato) ?>">

            <input type="submit" value="Oppdater">
        </form>
    </div>
</body>
</html>
