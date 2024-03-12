<?php
// Henter forbindelses-streng
include 'connect.php';

// Check for deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    $sql_delete = "DELETE FROM kunder WHERE kunde_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_delete)) {
        mysqli_stmt_bind_param($stmt, "i", $deleteId);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            // Redirect to Read.php after successful deletion
            header('Location: Read.php');
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    mysqli_stmt_close($stmt);
}

// Fetch all customers
$sql_all = "SELECT kunde_id, fornavn, etternavn, telefon, email FROM kunder";
$result_all = mysqli_query($conn, $sql_all);
if (!$result_all) {
    die("Forespørsel feilet: " . mysqli_error($conn));
}

mysqli_close($conn);
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
        }
        th {
            background-color: #555;
        }
        td {
            background-color: #444;
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
    </style>
</head>
<body>
    <main>
        <h2 style="text-align: center;">SLETT KUNDER</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fornavn</th>
                    <th>Etternavn</th>
                    <th>Telefon</th>
                    <th>Email</th>
                    <th>Slett</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_all)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['kunde_id']) ?></td>
                    <td><?= htmlspecialchars($row['fornavn']) ?></td>
                    <td><?= htmlspecialchars($row['etternavn']) ?></td>
                    <td><?= htmlspecialchars($row['telefon']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="delete_id" value="<?= htmlspecialchars($row['kunde_id']) ?>">
                            <input type="submit" value="Slett">
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
