<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['Org_Nr']) && isset($_POST['Bedrift_Navn']) && isset($_POST['telefon']) && isset($_POST['email']) && isset($_POST['Adresse'])) {
        $Org_Nr = $_POST['Org_Nr'];
        $Bedrift_Navn = $_POST['Bedrift_Navn'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $Adresse = $_POST['Adresse'];

        // Define and assign value to $fk_Bedrift_kunder
        $fk_Bedrift_kunder = 1; // Assuming 1 is the correct foreign key value

        // Define the query to retrieve kunde_id
        // Define the query to retrieve kunde_id based on email
        $kunde_id_query = "SELECT kunde_id FROM kunder WHERE email = '$email'";

        // Execute the query to retrieve kunde_id
        $result = mysqli_query($conn, $kunde_id_query);

        // Check if the query was successful and if it returned any rows
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the result row
            $row = mysqli_fetch_assoc($result);
            // Get the kunde_id from the result
            $kunde_id = $row['kunde_id'];

            // Construct the INSERT query
            $sql = "INSERT INTO `bedrift` (`Org_Nr`, `Bedrift_Navn`, `telefon`, `email`, `Adresse`, `fk_Bedrift_kunder`) 
                    VALUES ('$Org_Nr', '$Bedrift_Navn', '$telefon', '$email', '$Adresse', $fk_Bedrift_kunder)";

            // Execute the INSERT query
            if ($run_query = mysqli_query($conn, $sql)) {
                header('Location: Read.php');
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: No rows returned from the query.";
        }
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer ny bedrift</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'meny.php';?>
    <header>
        <p>REGISTRER NY BEDRIFT<br></p>
    </header>

    <main>
        <form method="post" action="create_bedrift.php">
            <label for="Org_Nr">Org_Nr: </label> <br>
            <input type='text' name='Org_Nr' id="Org_Nr" required> <br> <br>

            <label for="Bedrift_Navn">Bedrift_Navn: </label> <br>
            <input type='text' name='Bedrift_Navn' id="Bedrift_Navn" required> <br> <br>

            <label for="telefon">Telefon: </label> <br>
            <input type='text' name='telefon' id="telefon" required> <br> <br>

            <label for="email">Email: </label> <br>
            <input type='text' name='email' id="email" required> <br> <br> <br>

            <label for="adresse">Adresse: </label> <br>
            <input type='text' name='Adresse' id="adresse" required> <br> <br> <br>

            <input type='submit' name='submit' id="submit" value="Registrer" > <br>
        </form>   
    </main>
</body>
</html>
