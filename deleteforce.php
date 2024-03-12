<?php
// Include the connection string
include 'connect.php';

// Initialize message variable
$message = '';

// Check if kunde_id is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the kunde_id from the URL
    $kunde_id = $_GET['id'];

    // Fetch customer data based on the kunde_id for confirmation
    $sql_fetch = "SELECT kunde_id, fornavn, etternavn, telefon, email, fodsel_dato FROM kunder WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_fetch)) {
        mysqli_stmt_bind_param($stmt, "i", $kunde_id);
        if (mysqli_stmt_execute($stmt)) {
            $result_fetch = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result_fetch) == 1) {
                $kunde = mysqli_fetch_assoc($result_fetch);
            } else {
                $message = "Ingen kunde funnet med ID: " . $kunde_id;
            }
        } else {
            $message = "Forespørsel feilet: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
} else {
    $message = "Ingen kunde ID angitt.";
}

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    // SQL to delete customer
    $sql_delete = "DELETE FROM kunder WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_delete)) {
        mysqli_stmt_bind_param($stmt, "i", $deleteId);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Kunden ble slettet.";
            header('Location: Read.php'); // Redirect to Read.php after successful deletion
            exit();
        } else {
            $message = "Feil ved sletting av kunden: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slett Kunde</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #777;
            text-align: left;
            background-color: #444;
        }
        th {
            background-color: #555;
        }
        input[type="submit"] {
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            background-color: #64B5F6; /* Light blue */
        }
        input[type="submit"]:hover {
            background-color: #42A5F5;
        }
        .message {
            color: #ff0000;
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <h2 style="text-align: center;">SLETT KUNDER</h2>
        <?php if ($message): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>
        <?php if (isset($kunde)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fornavn</th>
                        <th>Etternavn</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th>Fødsel dato</th>
                        <th>Slett</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($kunde['kunde_id']) ?></td>
                        <td><?= htmlspecialchars($kunde['fornavn']) ?></td>
                        <td><?= htmlspecialchars($kunde['etternavn']) ?></td>
                        <td><?= htmlspecialchars($kunde['telefon']) ?></td>
                        <td><?= htmlspecialchars($kunde['email']) ?></td>
                        <td><?= htmlspecialchars($kunde['fodsel_dato']) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="delete_id" value="<?= htmlspecialchars($kunde['kunde_id']) ?>">
                                <input type="submit" value="Slett">
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
