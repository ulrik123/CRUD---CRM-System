<?php
// Include the connection string
include 'connect.php';

// Check if kunde_id is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the kunde_id from the URL
    $kunde_id = $_GET['id'];

    // Fetch customer data based on the kunde_id
    $sql_fetch = "SELECT kunde_id, fornavn, etternavn, telefon, email FROM kunder WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_fetch)) {
        mysqli_stmt_bind_param($stmt, "i", $kunde_id);
        if (mysqli_stmt_execute($stmt)) {
            $result_fetch = mysqli_stmt_get_result($stmt);
            // Check if any rows are returned
            if (mysqli_num_rows($result_fetch) > 0) {
                $row = mysqli_fetch_assoc($result_fetch);
                // Populate variables with data from fetched row
                $fornavn = $row['fornavn'];
                $etternavn = $row['etternavn'];
                $telefon = $row['telefon'];
                $email = $row['email'];
            } else {
                echo "No record found with kunde_id: " . $kunde_id;
                exit; // Stop the script if no customer is found
            }
        } else {
            echo "Error fetching record: " . mysqli_error($conn);
            exit; // Stop the script in case of SQL error
        }
        mysqli_stmt_close($stmt);
    }
}

// Delete customer data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    $sql_delete = "DELETE FROM kunder WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_delete)) {
        mysqli_stmt_bind_param($stmt, "i", $deleteId);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to Read.php after successful deletion
            header('Location: Read.php');
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
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
    <!-- (Include the same style section as in Read.php here) -->
    <!-- ... -->
</head>
<body>
    <h2 style="text-align: center;">SLETT KUNDE</h2>
    <form method="POST">
        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($kunde_id) ?>">
        <p>Er du sikker på at du vil slette følgende kunde?</p>
        <p>ID: <?= htmlspecialchars($kunde_id) ?></p>
        <p>Fornavn: <?= htmlspecialchars($fornavn) ?></p>
        <p>Etternavn: <?= htmlspecialchars($etternavn) ?></p>
        <p>Telefon: <?= htmlspecialchars($telefon) ?></p>
        <p>Email: <?= htmlspecialchars($email) ?></p>
        <input type="submit" value="Slett">
    </form>
</body>
</html>
