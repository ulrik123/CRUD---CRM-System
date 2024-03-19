<?php
 
//Henter forbindelses-streng
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['Org_Nr']) && isset($_POST['Bedrift_Navn']) && isset($_POST['telefon']) && isset($_POST['email'])&& isset($_POST['Adresse'])) {
        $Org_Nr = $_POST['Org_Nr'];
        $Bedrift_Navn = $_POST['Bedrift_Navn'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $Adresse = $_POST['Adresse'];
       
        // Correct the typo here from `$telfon` to `$telefon`
        $sql = "INSERT INTO `bedrift` (`Org_Nr`,`Bedrift_Navn`, `telefon`, `email`,`Adresse`) VALUES ('$Org_Nr','$Bedrift_Navn', '$telefon', '$email', '$Adresse')";
        if ($run_query = mysqli_query($conn, $sql)) {
            // After successful insertion, redirect to Read.php
            header('Location: Read.php');
            exit();
        }
    }
}

// Close the connection here if it's not needed anymore
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'style.php';?>
    
    <title>Registrer ny kunde</title>
</head>
<body>
    <?php include 'meny.php';?>
    <header>
      <p>REGISTRER NY KUNDE<br></p>
      <link rel="stylesheet" href="css/style.css">
    </header>

    <main>
    
      <form method="post">
        <label for="Org_Nr">Org_Nr: </label> <br>
        <input type='text' name='Org_Nr' id="Org_Nr" required> <br> <br>

        <label for="Bedrift_Navn">Bedrift_Navn: </label> <br>
        <input type='text' name='Bedrift_Navn' id="Bedrift_Navn" required> <br> <br>

        <label for="telefon">Telefon: </label> <br>
        <input type='text' name='telefon' id="telefon" required> <br> <br>

        <label for="email">Email: </label> <br>
        <input type='text' name='email' id="email" required> <br> <br> <br>

        <label for="adresse">Adresse: </label> <br>
        <input type='text' name='text' id="text" required> <br> <br> <br>

        <input type='submit' name='submit' id="submit" value="Registrer" > <br>
        
        
      </form>   
    </main>
    </body>
</html>