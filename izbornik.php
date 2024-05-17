<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adresko</title>
    <link rel="stylesheet" href="css/izbornik.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["korisnicko_ime"])) {
        header("Location: user-parts/prijava.php");
        exit();
    }

    include("otvoriVezu.php");
    $rezultat = mysqli_query($veza, "select id, korisnicko_ime from korisnik");
    while ($redak = mysqli_fetch_array($rezultat)) {
        $id = $redak['id'];
        $korisnicko_ime = $redak['korisnicko_ime'];
    }

    mysqli_free_result($rezultat);
    mysqli_close($veza);
    ?>

    <h3 style="text-align: left; font-size: 2rem; padding-left: 10px;">
        Adresko<i class="address book icon"></i>
    </h3>

    <div class="ui three item menu meni">
        <a href="unosPodataka.php" class="item" id="unosPodataka">
            <i class="download icon"></i>
            Unos podataka
        </a>
        <a href="pregledAdresa.php" class="item" id="pregledPodataka">
            <i class="eye icon"></i>
            Pregled
        </a>
        <a href='pregledKorisnika.php?korisnicko_ime=<?php echo $korisnicko_ime ?>' class="item" id="korisnickiRacun">
            Korisnik: <?php echo $_SESSION["korisnicko_ime"] . "<i class='user circle icon'></i>"; ?>
        </a>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentPath = window.location.pathname.split("/").pop();
        console.log("Current Path: " + currentPath);

        var menuItems = document.querySelectorAll('.ui.menu .item');
        menuItems.forEach(function(item) {
            var link = item.getAttribute('href');
            if (link && link.includes(currentPath)) {
                item.classList.add('active');
            }
        });

        var menuLinks = document.querySelectorAll('.ui.menu .item');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                menuLinks.forEach(function(item) {
                    item.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    });
</script>
<script src="js/jquery.min.js"></script>
<script src="js/semantic.js"></script>
<script src="js/semantic.min.js"></script>

</html>