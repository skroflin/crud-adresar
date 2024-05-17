<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dobrodošli</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["korisnicko_ime"])) {
        header("Location: prijava.php");
        exit();
    }
    ?>

    <h2>
        Dobrodošli, <?php echo $_SESSION["korisnicko_ime"] ?>
    </h2>
    <p>
        Imate neograničen pristup navedenoj stranici.
    </p>
    <a href="odjava.php">
        Odjavi se
    </a>
</body>

</html>