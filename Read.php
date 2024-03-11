<?php
// Henter forbindelses-streng
include 'connect.php';

$kunde = []; // Initialize $kunde as an empty array

// Prosedyre for lese
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';
$sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : 'kunde_id'; // Default sorting column

$sql_les = "SELECT kunde_id, etternavn, fornavn, telefon, email FROM kunder ORDER BY $sortColumn $sortOrder";

$result_les = mysqli_query($conn, $sql_les);

if ($result_les) {
    $kunde = mysqli_fetch_all($result_les, MYSQLI_ASSOC);
    mysqli_free_result($result_les);
} else {
    die("Forespørsel feilet: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mine Kunder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #0779e4 3px solid;
        }
        header h1 {
            text-align: center;
        }
        main {
            padding: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-link {
            color: #333;
            text-decoration: none;
        }
        .action-link:hover {
            text-decoration: underline;
        }
        .button-link {
            display: inline-block;
            background: #4CAF50; /* Green */
            color: white;
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button-link:hover {
            background: #45a049;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>VIS KUNDER</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Kunde ID</th>
                    <th>Fornavn</th>
                    <th>Etternavn</th>
                    <th>Telefon</th>
                    <th>Email</th>
                    <th>Rediger</th>
                    <th>Slett</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kunde as $person) : ?>
                    <tr>
                        <td><?= htmlspecialchars($person['kunde_id']); ?></td>
                        <td><?= htmlspecialchars($person['fornavn']); ?></td>
                        <td><?= htmlspecialchars($person['etternavn']); ?></td>
                        <td><?= htmlspecialchars($person['telefon']); ?></td>
                        <td><?= htmlspecialchars($person['email']); ?></td>
                        <td><a class="action-link" href="updateforce.php?id=<?= $person['kunde_id']; ?>">Rediger</a></td>
                        <td><a class="action-link" href="deleteforce.php?id=<?= $person['kunde_id']; ?>">Slett</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="footer">
            <a href="create.php" class="button-link">Ny Kunde</a>
            <a href="Read.php" class="button-link">Last Inn På Nytt</a>
        </div>
    </main>
</body>
