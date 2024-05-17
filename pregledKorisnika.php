<?php

include "izbornik.php";

if (!isset($_SESSION["korisnicko_ime"])) {
    header("Location: prijava.php");
    exit();
}

include "otvoriVezu.php";

$korisnickoIme = $_SESSION["korisnicko_ime"];

$rezultati = mysqli_query($veza, "select * from korisnik where korisnicko_ime = '$korisnickoIme'");
while ($redak = mysqli_fetch_array($rezultati)) {
    $id = $redak['id'];
    $ime = $redak['ime'];
    $korisnickoIme = $redak['korisnicko_ime'];
    $prezime = $redak['prezime'];
    $uloga = $redak['uloga'];

    $putanja_slike = "slike/$ime.jpg";
    $slika_datoteka = '';

    if (file_exists($putanja_slike)) {
        $slika_datoteka = "<div class='slika'><img class='ui small image' src='$putanja_slike' alt='$ime'></div>";
    } else {
        $slika_datoteka = "<div style='padding: 65px; text-align: center;'>Korisnik nema sliku <i class='thumbs down outline icon'></i></div>";
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adresko</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
        <style>
            .slika {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>

    <body>
        <h2 style="text-align: center;">
            Pregled korisnika
        </h2>

        <p style="display: none;">
            <?php
            session_start();
            ?>
        </p>

        <div style="display: flex; align-items: center; justify-content: center;">
            <div>
                <div class="ui card">
                    <div class="image">
                        <?php
                        echo $slika_datoteka;
                        ?>
                    </div>
                    <div class="content">
                        <p class="header">
                            <?php
                            echo $ime . " " . $prezime;
                            ?>
                        </p>
                        <div class="description" style="text-transform: capitalize;">
                            <?php
                            function prikaziIkonu($uloga)
                            {
                                if ($uloga == 'djelatnik') {
                                    return "<i class='wrench icon'></i>";
                                } elseif ($uloga == 'menađer') {
                                    return "<i class='briefcase icon'></i>";
                                } else {
                                    return '';
                                }
                            }
                            ?>
                            <?php
                            echo prikaziIkonu($uloga) . $uloga;
                            ?>
                        </div>
                    </div>
                    <div class="extra content">
                        <a href="odjava.php" class="item" id="odjava">
                            <i class="user times icon"></i>
                            Odjava
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div style="display: flex; align-items: center; justify-content: center; color: lightgray; padding-top: 10px;">
                <i class="copyright outline icon"></i>
                <p>Adresko 2024</p>
            </div>
        </footer>
    </body>
    <script src="js/jquery.min.js"></script>
    <script src="js/semantic.js"></script>
    <script src="js/semantic.min.js"></script>

    </html>
<?php
}
mysqli_free_result($rezultati);
mysqli_close($veza);
?>