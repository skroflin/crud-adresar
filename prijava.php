<?php

session_start();
include "otvoriVezu.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["korisnicko_ime"]) && isset($_POST["password"])) {
        $korisnickoIme = trim($_POST["korisnicko_ime"]);
        $password = trim($_POST["password"]);

        if (empty($korisnickoIme) || empty($password)) {
            $poruka = "<div id='obavijest'><div class='ui pointing below red basic label'>Korisničko ime i lozinka ne smiju biti prazni</div></div>";
            echo $poruka;
        } else {
            $korisnik = '';
            $pass = '';
            $rezultat = mysqli_query($veza, "select * from korisnik where korisnicko_ime='$korisnickoIme'");

            if ($rezultat && mysqli_num_rows($rezultat) > 0) {
                while ($redak = mysqli_fetch_array($rezultat)) {
                    $korisnik = $redak['korisnicko_ime'];
                    $pass = $redak['password'];
                }
                mysqli_free_result($rezultat);

                if ($korisnickoIme === $korisnik && $password === $pass) {
                    $_SESSION["korisnicko_ime"] = $korisnickoIme;
                    header("Location: izbornik.php");
                    exit();
                } else {
                    $poruka = "<div id='obavijest'><div class='ui pointing below red basic label'>Neuspješna prijava. Provjerite korisničko ime i lozinku.</div></div>";
                    echo $poruka;
                }
            } else {
                $poruka = "<div id='obavijest'><div class='ui pointing below red basic label'>Neuspješna prijava. Provjerite korisničko ime i lozinku.</div></div>";
                echo $poruka;
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adresko</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <style>
        p {
            text-align: center;
        }

        #obavijest {
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>
        Prijava u Adresko<i class="address book outline icon"></i>
    </h2>
    <div class="forma">
        <div class="ui inverted segment" style="border-radius: 15px;">
            <form action="prijava.php" method="post" class="ui form">
                <div class="field">
                    <label style="color: white;">
                        Korisničko ime
                    </label>
                    <div class="ui left icon input">
                        <input type="text" id="korisnicko_ime" name="korisnicko_ime" placeholder="pr. skroflin">
                        <i class="user icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label style="color: white;">
                        Password:
                    </label>
                    <div class="ui left icon input">
                        <input type="password" name="password" class="lozinka" placeholder="Lozinka">
                        <i class="lock icon"></i>
                    </div>
                </div>
                <div style="display: flex; align-items: center; justify-content: center;">
                    <div class="field">
                        <button class="ui submit button" type="submit">
                            <i class="user circle outline icon"></i>
                            Prijava
                        </button>
                    </div>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; padding-top: 10px;">
                    <div class="field">
                        <a href="registracija.php">
                            <i class="user plus icon"></i>
                            Registracija
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div style="display: flex; align-items: center; justify-content: center; color: lightgray; padding-top: 10px;">
            <i class="copyright outline icon"></i>
            <p>Adresko 2024</p>
        </div>
    </footer>
</body>

</html>
