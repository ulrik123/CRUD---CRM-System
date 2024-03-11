<?php
// Henter forbindelses-streng
include 'connect.php';

// Prosedyre for update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_u'])) {
    $id_to_delete = isset($_POST['slett_id']) ? $_POST['slett_id'] : null;
    $fornavn = isset($_POST['fornavn']) ? $_POST['fornavn'] : null;
    $etternavn = isset($_POST['etternavn']) ? $_POST['etternavn'] : null;
    $telefon = isset($_POST['telefon']) ? $_POST['telefon'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    if ($id_to_delete !== null) {
        $sql_slett = "DELETE FROM kunder WHERE kunde_id = '$id_to_delete'";
        $result_slett = mysqli_query($conn, $sql_slett);

        if (!$result_slett) {
            die("forespørsel feilet: " . mysqli_error($conn));
        }
    } else {
        // Handle the case where 'slett_id' is not set
        echo "Error: 'slett_id' is not set.";
    }
}

// Prosedyre for lese
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';
$sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : 'kunde_id'; // Default sorting column

$sql_les = "SELECT kunde_id, etternavn, fornavn, telefon, email FROM kunder ORDER BY $sortColumn $sortOrder";

$result_les = mysqli_query($conn, $sql_les);

if (!$result_les) {
    die("Forespørsel feilet: " . mysqli_error($conn));
}

$kunde = mysqli_fetch_all($result_les, MYSQLI_ASSOC);

mysqli_free_result($result_les);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'style.php';?>
    <title>Mine Kunder</title>
</head>
<body>
    <?php include 'meny.php';?>
    <header>
        <h1 style="text-align: center;>">VIS KUNDER</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th class="sort-btn">Kunde ID</a></th>
                    <th class="sort-btn">Fornavn</a></th>
                    <th class="sort-btn">Etternavn</a></th>
                    <th class="sort-btn">telefon</a></th>
                    <th class="sort-btn">email</a></th>
                    <th>Rediger</th>
                    <th>Slett</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($kunde as $person) { ?>
                    <tr>
                        <td><?php echo $person['kunde_id']; ?></td>    
                        <td><?php echo $person['etternavn']; ?></td>
                        <td><?php echo $person['fornavn']; ?></td>
                        <td><?php echo $person['telefon']; ?></td>
                        <td><?php echo $person['email']; ?></td>
                        <td><a href="updateforce.php?id=<?php echo $person['kunde_id']; ?>">Rediger</a></td>
                        <td><a id="slett_bil" href="deleteforce.php?id=<?php echo $person['kunde_id']; ?>">Slett</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
