<?php
// Include the connection string
include 'connect.php';

// Check if kunde_id is set in the URL
if(isset($_GET['id'])) {
    // Retrieve the kunde_id from the URL
    $kunde_id = $_GET['id'];

    // Fetch customer data based on the kunde_id
    $sql_fetch = "SELECT kunde_id, fornavn, etternavn, telefon, email, fodsel_dato FROM kunder WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_fetch)) {
        mysqli_stmt_bind_param($stmt, "i", $kunde_id);
        if (mysqli_stmt_execute($stmt)) {
            $result_fetch = mysqli_stmt_get_result($stmt);
            // Check if any rows are returned
            if(mysqli_num_rows($result_fetch) > 0) {
                $row = mysqli_fetch_assoc($result_fetch);
                // Populate variables with data from fetched row
                $fornavn = $row['fornavn'];
                $etternavn = $row['etternavn'];
                $telefon = $row['telefon'];
                $email = $row['email'];
            } else {
                echo "No record found with kunde_id: " . $kunde_id;
            }
        } else {
            echo "Error fetching record: " . mysqli_error($conn);
        }
    }
    mysqli_stmt_close($stmt);
}

// Update customer data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_id'])) {
    $updateId = $_POST['update_id'];
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $fodsel_dato = $_POST['fodsel_dato'];

    $sql_update = "UPDATE kunder SET fornavn = ?, etternavn = ?, telefon = ?, email = ?, fodsel_dato = ? WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_update)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $fornavn, $etternavn, $telefon, $email,$fodsel_dato, $updateId);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            // Redirect to Read.php after successful update
            header('Location: Read.php');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oppdater Kunde</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="submit"] {
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            background-color: #64B5F6; /* Light blue */
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        input[type="submit"]:hover {
            background-color: #42A5F5;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">OPPDATER KUNDER</h2>
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
        <label for="email">Fødsel dato:</label>
        <input type="date" id="fodsel_dato" name="fødsel_dato" value="<?= htmlspecialchars($fodsel_dato) ?>">
        <input type="submit" value="Oppdater">
    </form>
</body>
</html>
