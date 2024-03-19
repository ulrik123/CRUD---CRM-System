<?php
// Henter forbindelses-streng
include 'connect.php';

// Initialize $kunde as an empty array
$bedrift = [];

$sql_les = "SELECT `Org_Nr`, `Bedrift_Navn`, `Telefon`, `Email`, `Adresse`, `kunder_kunde_id` FROM `bedrift`";

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
            background:lightgrey;
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
            color:Black;
            Font-size:bold;
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
        <h1 style="text-align: center;">Berdift Panel</h1>
        <a href="create_Bedrift.php" class="add-button">Legg til ny Bedrift</a>
    </header>
    <main>
        <div class="card-container">
            <?php foreach ($bedrift as $bedrifter) : ?>
                <a href="Bedrift_informasjon.php?id=<?= htmlspecialchars($bedrifter['Org_Nr']); ?>" class="card">
                    <div class="card-content">
                        <h1>#<?= htmlspecialchars($bedrifter['Org_Nr']); ?></h1>
                        <p>ID: <?= htmlspecialchars($bedrifter['Bedrift_Navn']); ?></p>
                        <p>Fornavn: <?= htmlspecialchars($bedrifter['Telefon']); ?></p>
                        <p>Etternavn: <?= htmlspecialchars($bedrifter['Email']); ?></p>
                        <p>Telefon: <?= htmlspecialchars($bedrifter['Adresse']); ?></p>
                        <p>Email: <?= htmlspecialchars($bedrifter['kunder_kunde_id']); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>

</body>
</html>
