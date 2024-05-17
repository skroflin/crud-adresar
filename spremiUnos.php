<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adresko</title>
    <link rel="stylesheet" href="css/podaci.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.min.css">
    <style>
        .poruka {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .podaci {
            margin-right: 40%;
            margin-left: 40%;
        }
    </style>
</head>

<body>
    <?php
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $adresa = $_POST['adresa'];
    $grad_id = $_POST['grad_id'];
    $email = $_POST['email'];
    $spol = $_POST['spol'];

    ?>

    <h2>
        Prikupljeni podaci
    </h2>

    <div class="podaci">
        <div class="ui segment">
            <p>
                <?php echo "Ime: $ime" ?>
            </p>
            <p>
                <?php echo "Prezime: $prezime" ?>
            </p>
            <p>
                <?php echo "Adresa: $adresa" ?>
            </p>
            <p>
                <?php echo "Grad: $grad_id" ?>
            </p>
            <p>
                <?php echo "Email: $email" ?>
            </p>
            <p>
                <?php echo "Adresa: $adresa" ?>
            </p>
            <p>
                <?php echo "Spol: $spol" ?>
            </p>
            <?php
            if (isset($_FILES["datoteka"]["name"]) && $_FILES["datoteka"]["size"] != 0) {
                $izvor = $_FILES["datoteka"]["tmp_name"];
                $odrediste = "slike/{$ime}.jpg";
                move_uploaded_file($izvor, $odrediste);
                echo "<p>Slika: slike/{$ime}.jpg</p>";
            } else {
                $odrediste = "Nije odabrana slika";
                echo "<p>Slika: $odrediste</p>";
            }
            ?>
            <a href="pregledAdresa.php">Pregled adresa</a>
        </div>
    </div>
    <?php

    include("otvoriVezu.php");

    $sql = "insert into polaznik";
    $sql .= "(ime, prezime, adresa, grad_id, spol, email) ";
    $sql .= "values ('$ime', '$prezime', '$adresa', '$grad_id', '$spol', '$email')";
    if (mysqli_query($veza, $sql)) {
        echo "
            <div class='poruka'>
            <div class='ui success message'>
              <p>Podaci su uspješno uneseni</p>
            </div>
            </div>
            ";
    } else {
        echo "<div class='poruka'>
        <div class='ui negative message'>
        <p>Podaci nisu uspješno uneseni zbog navedene greške: " . mysqli_error($veza) .
            "!</p></div></div>";
    }
    mysqli_close($veza);
    ?>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/semantic.js"></script>
<script src="js/semantic.min.js"></script>
<script src="js/app.js"></script>

</html>