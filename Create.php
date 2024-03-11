<?php
 
//Henter forbindelses-streng
include 'connect.php';
 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
    {
    if(isset($_POST['fornavn']) && isset($_POST['etternavn']))
        {
        $fornavn = $_POST['fornavn'];
        $etternavn = $_POST['etternavn'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
       
        $sql = "INSERT INTO `kunder` (`fornavn`,`etternavn`, `telefon`, `email`) VALUES ('$fornavn','$etternavn', '$telfon', '$email')";
        $run_query = mysqli_query($conn, $sql);
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

        <label for="etternavn">telefon: </label> <br>
        <input type='text' name='etternavn' id="etternavn" required> <br> <br>

        <label for="etternavn">email </label> <br>
        <input type='text' name='etternavn' id="etternavn" required> <br> <br>

        <!-- <label for="etternavn">fødseldato </label> <br>
        <input type='text' name='etternavn' id="etternavn" required> <br> <br> -->
        
        

        <input type='submit' name='submit' id="submit" value="Registrer" > <br>
        
        
      </form>   
    </main>
    </body>
</html>