<?php
// Henter forbindelses-streng
include 'connect.php';

// Initialize $kunde as an empty array
$kunde = [];

// Prosedyre for lese
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';
$sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : 'kunde_id'; // Default sorting column

$sql_les = "SELECT kunde_id, etternavn, fornavn, telefon, email, fodsel_dato FROM kunder ORDER BY $sortColumn $sortOrder";

$result_les = mysqli_query($conn, $sql_les);

if ($result_les && mysqli_num_rows($result_les) > 0) {
    $kunde = mysqli_fetch_all($result_les, MYSQLI_ASSOC);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mine Kunder</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            width: calc(33.333% - 20px); /* for 3 per row */
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .card {
                width: calc(50% - 20px); /* for 2 per row */
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%; /* full width for small screens */
            }
        }

        .card-content {
            padding: 20px;
        }

        header, footer {
            text-align: center;
            padding: 10px 0;
        }

        .add-button {
            background-color: #2196F3;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1 style="text-align: center;">Kunder</h1>
        <a href="create.php" class="add-button">Legg til ny kunde</a>
    </header>
    <main>
        <div class="card-container">
            <?php foreach ($kunde as $person) : ?>
                <a href="Bedrift_informasjon.php?id=<?= htmlspecialchars($person['kunde_id']); ?>" class="card">
                    <div class="card-content">
                        <p>ID: <?= htmlspecialchars($person['kunde_id']); ?></p>
                        <p>Fornavn: <?= htmlspecialchars($person['fornavn']); ?></p>
                        <p>Etternavn: <?= htmlspecialchars($person['etternavn']); ?></p>
                        <p>Telefon: <?= htmlspecialchars($person['telefon']); ?></p>
                        <p>Email: <?= htmlspecialchars($person['email']); ?></p>
                        <p>Fødselsdato: <?= htmlspecialchars($person['fodsel_dato']); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <a href="create.php" class="add-button">Legg til ny kunde</a>
    </footer>
</body>
</html>
