<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adresko</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.min.css">
    <style>
        .pregled {
            text-align: center;
        }

        .poruka {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php
    include("otvoriVezu.php");
    $id = $_GET['id'];
    ?>

    <h2>
        Brisanje podataka
    </h2>

    <?php
    if (mysqli_query($veza, "delete from polaznik where id = $id")) {
        echo "
        <div class='poruka'>
        <div class='ui success message'>
          <p>Zapis je uspješno obrisan</p>
        </div>
        </div>
        ";
    } else {
        echo "<div class='poruka'>
        <div class='ui negative message'>
        <p>Zapis nije uspješno obrisan zbog navedene greške: " . mysqli_error($veza) .
            "!</p></div></div>";
    }
    mysqli_close($veza);
    ?>

    <div class="pregled"><a href="pregledAdresa.php">Pregled adresa</a></div>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/semantic.js"></script>
<script src="js/semantic.min.js"></script>
<script src="js/app.js"></script>

</html>