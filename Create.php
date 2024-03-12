<?php
 
//Henter forbindelses-streng
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['fornavn']) && isset($_POST['etternavn']) && isset($_POST['telefon']) && isset($_POST['email'])) {
        $fornavn = $_POST['fornavn'];
        $etternavn = $_POST['etternavn'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
       
        // Correct the typo here from `$telfon` to `$telefon`
        $sql = "INSERT INTO `kunder` (`fornavn`,`etternavn`, `telefon`, `email`) VALUES ('$fornavn','$etternavn', '$telefon', '$email')";
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
    </header>

    <main>
    
      <form method="post">
        <label for="fornavn">Fornavn: </label> <br>
        <input type='text' name='fornavn' id="fornavn" required> <br> <br>

        <label for="etternavn">Etternavn: </label> <br>
        <input type='text' name='etternavn' id="etternavn" required> <br> <br>

        <label for="telefon">Telefon: </label> <br>
        <input type='text' name='telefon' id="telefon" required> <br> <br>

        <label for="email">Email: </label> <br>
        <input type='text' name='email' id="email" required> <br> <br> <br>

        <input type='submit' name='submit' id="submit" value="Registrer" > <br>
        
        
      </form>   
    </main>
    </body>
</html>