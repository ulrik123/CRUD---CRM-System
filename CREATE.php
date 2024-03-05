<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='./css/style.css' rel='stylesheet'  type='text/css'> 
    <title>Mine ansatte</title>
    
</head>
<body>
<?php include 'meny.php'; ?>
    <main>
        <form action="ny-bekreft.php" method="POST">
            <label for="fornavn">Fornavn: </label> <br>
            <input type="text" name="fornavn" id="fornavn" required><br><br>
            
            <label for="etternavn">Etternavn: </label> <br>
            <input type="text" name="etternavn" id="etternavn" required><br><br>

            <input type="submit" name="submit" id="submit" value="Registrer"><br><br>

        </form>
    </main>


</body>
</html>