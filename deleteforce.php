<?php
//Henter forbindelses-streng
include 'connect.php';
 
if (isset($_GET['id']))
    {
        $id = $_GET['id'];
 
        $sql_les = "SELECT kunde_id, fornavn, etternavn, telefon, email  FROM kunder WHERE kunde_id = $id";
 
        $result_les = mysqli_query($conn, $sql_les);
 
    if(!$result_les)
        {
           die("forespørsel feilet");
        }
   
    $person = mysqli_fetch_assoc($result_les);
 
    mysqli_free_result($result_les);    
    mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'style.php';?>
   
    <title>Slett Kunder</title>
</head>
<body>
    <?php include 'meny.php';?>
    <header>
      <p>SLETT KUNDER<br></p>
    </header>
 
    <main>
    <form method="POST" action="Read.php">
    <input type="hidden" name="slett_id" value="your_value">
    <!-- Other form fields go here -->
    
    <input type='text' name='slett_id' id="ny_id" value="<?php echo htmlspecialchars($person['kunde_id']) ?>" readonly>
    <input type='text' name='slett_id' id="ny_id" value="<?php echo htmlspecialchars($person['fornavn']) ?>" readonly>
    <input type='text' name='slett_id' id="ny_id" value="<?php echo htmlspecialchars($person['etternavn']) ?>" readonly>
    <input type='text' name='slett_id' id="ny_id" value="<?php echo htmlspecialchars($person['telefon']) ?>" readonly>
    <input type='text' name='slett_id' id="ny_id" value="<?php echo htmlspecialchars($person['email']) ?>" readonly>
</form>
<input type='submit' name='submit_u' id="slett_bil" value="Slett" > <br>+
+
    </main>
    </body>
</html>