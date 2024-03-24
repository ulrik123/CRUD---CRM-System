<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Legg til ny Bedrift</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    /* Updated gradient background with light blue and light red */
    background: linear-gradient(to right top, #89d4cf, #f4c4f3);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-container {
    width: 500px; /* Adjust the width as necessary */
    background-color: #f0f0f0; /* Light grey background */
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-header {
    background-color: #00bcd4; /* Light blue color for the header */
    color: #000000; /* Black color text */
    padding: 15px 20px;
    border-radius: 10px 10px 0 0;
    font-size: 1.5em;
    text-align: center;
}

label, input {
    color: #000000; /* Black color text for labels and input text */
}

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #000000; /* White color for the labels */
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #000000;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF; /* Blue background for the submit button */
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            border: none;
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="form-header">
        Legg til ny Bedrift
    </div>
    <form action="Create_Bedrift.php" method="post">
    <form action="Create_Bedrift.php" method="post">
        <label for="bedriftNavn">Bedrift Navn:</label>
        <input type="text" id="bedriftNavn" name="bedriftNavn" required>

        <label for="telefon">Telefon:</label>
        <input type="text" id="telefon" name="telefon" required>

        <label for="email">E-post:</label>
        <input type="email" id="email" name="email" required>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" required>

        <label for="kunderKundeId">Kunder Kunde ID:</label>
        <input type="number" id="kunderKundeId" name="kunderKundeId" required>

        <input type="submit" value="Legg til">
    </form>
    </form>
</div>

</body>
</html>
