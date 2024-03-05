<?php
// Henter forbindelses-streng
include 'connect.php';

// Prosedyre for update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_u'])) {
    $id_to_delete = isset($_POST['slett_id']) ? $_POST['slett_id'] : null;
    $fornavn = isset($_POST['fornavn']) ? $_POST['fornavn'] : null;
    $etternavn = isset($_POST['etternavn']) ? $_POST['etternavn'] : null;

    if ($id_to_delete !== null) {
        $sql_slett = "DELETE FROM person WHERE anr = '$id_to_delete'";
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
$sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : 'anr'; // Default sorting column

$sql_les = "SELECT anr, etternavn, fornavn FROM person ORDER BY $sortColumn $sortOrder";

$result_les = mysqli_query($conn, $sql_les);

if (!$result_les) {
    die("Forespørsel feilet: " . mysqli_error($conn));
}

$ansatte = mysqli_fetch_all($result_les, MYSQLI_ASSOC);

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
    <title>Mine Ansatte</title>
</head>
<body>
    <?php include 'meny.php';?>
    <header>
        <p>VIS ANSATTE<br></p>
    </header>

    <main>    
        <table>
            <thead>
                <tr>
                    <th class="sort-btn"><a href="?sortColumn=anr&sortOrder=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Ansattnr</a></th>
                    <th class="sort-btn"><a href="?sortColumn=etternavn&sortOrder=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Etternavn</a></th>
                    <th class="sort-btn"><a href="?sortColumn=fornavn&sortOrder=<?php echo $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Fornavn</a></th>
                    <th>Rediger</th>
                    <th>Slett</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ansatte as $person) { ?>
                    <tr>
                        <td><?php echo $person['anr']; ?></td>    
                        <td><?php echo $person['etternavn']; ?></td>
                        <td><?php echo $person['fornavn']; ?></td>
                        <td><a href="rediger.php?id=<?php echo $person['anr']; ?>">Rediger</a></td>
                        <td><a id="slett_bil" href="slett.php?id=<?php echo $person['anr']; ?>">Slett</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
