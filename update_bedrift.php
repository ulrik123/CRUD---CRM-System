<?php
require_once 'Database.php';

// Create a new instance of the Database class
$database = new Database();
// Use the conn property to get the mysqli connection
$conn = $database->conn;

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the data from the POST request
    $id = $_POST['id'];
    $name = $_POST['name'];
    $orgNr = $_POST['org_nr'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];

    // Prepare the update query
    $query = "UPDATE bedrift SET name = ?, org_nr = ?, telefon = ?, email = ?, adresse = ? WHERE id = ?";
    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind parameters and execute the statement
    if ($stmt && $stmt->bind_param("sssssi", $name, $orgNr, $telefon, $email, $adresse, $id) && $stmt->execute()) {
        // If successful, redirect to bedrift_panel.php
        header('Location: bedrift_panel.php');
        exit;
    } else {
        // If there was an error, display it
        echo "Error updating record: " . $conn->error;
    }
}
// Rest of your form and HTML below
?>
<style>
    .form-group {
    margin-bottom: 15px;
}

.btn {
    padding: 10px;
    width: 100%;
    border: none;
    background-color: #007BFF; /* Blue background for the submit button */
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.btn:hover {
    background-color: #0056b3;
}

</style>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Oppdater Bedrift</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right top, #89d4cf, #f4c4f3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 500px;
            background-color: #f0f0f0;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            background-color: #00bcd4;
            color: #000000;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            font-size: 1.5em;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #000000;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #000000;
            border-radius: 5px;
            color: #000000; /* Set the text color inside inputs to black */
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none; /* Remove border for submit button */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="form-header">
        Oppdater Bedrift
    </div>
    <form action="Bedrift_Oppdater.php" method="post">
        <input type="hidden" name="id" value="<?php echo isset($bedrift['id']) ? $bedrift['id'] : ''; ?>">

        <label for="name">Navn:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($bedrift['name']) ? htmlspecialchars($bedrift['name']) : ''; ?>" required>

        <label for="org_nr">Org Nr:</label>
        <input type="text" id="org_nr" name="org_nr" value="<?php echo isset($bedrift['org_nr']) ? htmlspecialchars($bedrift['org_nr']) : ''; ?>" required>

        <label for="telefon">Telefon:</label>
        <input type="text" id="telefon" name="telefon" value="<?php echo isset($bedrift['telefon']) ? htmlspecialchars($bedrift['telefon']) : ''; ?>" required>

        <label for="email">E-post:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($bedrift['email']) ? htmlspecialchars($bedrift['email']) : ''; ?>" required>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" value="<?php echo isset($bedrift['adresse']) ? htmlspecialchars($bedrift['adresse']) : ''; ?>" required>

        <input type="submit" value="Oppdater">
    </form>
</div>

</body>
</html>


