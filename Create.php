<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'style.php';?>
    
    <title>Mine ansatte</title>
</head>
<body>
    <?php include 'meny.php';?>
    <header>
      <p>REGISTRER NY ANSATT<br></p>
    </header>

    <main>
    
      <form action='ny-bekreft.php' method="post">
        <label for="fornavn">Fornavn: </label> <br>
        <input type='text' name='fornavn' id="fornavn" required> <br> <br>

        <label for="etternavn">Etternavn: </label> <br>
        <input type='text' name='etternavn' id="etternavn" required> <br> <br>
        
        

        <input type='submit' name='submit' id="submit" value="Registrer" > <br>
        
        
      </form>   
    </main>
    </body>
</html>