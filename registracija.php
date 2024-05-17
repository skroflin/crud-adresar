<?php
include "otvoriVezu.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["ime"]) && isset($_POST["prezime"]) && isset($_POST["korisnicko_ime"]) && isset($_POST["password"]) && isset($_POST["uloga"])) {
        $ime = trim($_POST["ime"]);
        $prezime = trim($_POST["prezime"]);
        $korisnickoIme = trim($_POST["korisnicko_ime"]);
        $password = trim($_POST["password"]);
        $uloga = $_POST["uloga"];

        if (empty($ime) || empty($prezime) || empty($korisnickoIme) || empty($password) || empty($uloga)) {
            $poruka = "<div class='poruka'><div class='ui negative message'>Sva polja moraju biti popunjena!</div></div>";
            echo $poruka;
        } else {
            $ime = trim($_POST["ime"]);
            $prezime = trim($_POST["prezime"]);
            $korisnickoIme = trim($_POST["korisnicko_ime"]);
            $password = trim($_POST["password"]);
            $uloga = $_POST["uloga"];
            $stmt = $veza->prepare("insert into korisnik (ime, prezime, korisnicko_ime, password, uloga) values (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $ime, $prezime, $korisnickoIme, $password, $uloga);

            if ($stmt->execute()) {
                $poruka = "<div class='poruka'><div class='ui success message'>Podaci su uspješno uneseni, registracija uspješno provedena</div></div>";
                echo $poruka;
            } else {
                $poruka = "<div class='poruka'><div class='ui negative message'>Podaci nisu uspješno uneseni zbog navedene greške: " . $stmt->error . "!</div></div>";
                echo $poruka;
            }

            $stmt->close();
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
</head>

<body>
    <h2>
        Registracija za Adresko<i class="address book outline icon"></i>
    </h2>
    <div class="forma">
        <div class="ui inverted segment" style="border-radius: 15px;">
            <form action="spremiRegistraciju.php" method="post" class="ui form" enctype="multipart/form-data">
                <div class="field">
                    <label style="color: white;">
                        Ime:
                    </label>
                    <div class="ui left icon input">
                        <input type="text" name="ime" class="ime" placeholder="Ime...">
                        <i class="address book icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label style="color: white;">
                        Prezime:
                    </label>
                    <div class="ui left icon input">
                        <input type="text" name="prezime" class="prezime" placeholder="Prezime...">
                        <i class="address book outline icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label style="color: white;">
                        Korisničko ime
                    </label>
                    <div class="ui left icon input">
                        <input class="korisnicko_ime" name="korisnicko_ime" type="text" placeholder="Korisničko ime...">
                        <i class="users icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label style="color: white;">
                        Lozinka
                    </label>
                    <div class="ui left icon input">
                        <input type="password" name="password" class="lozinka" placeholder="Lozinka...">
                        <i class="lock icon"></i>
                    </div>
                </div>
                <div class="inline fields">
                    <label style="color: white;">
                        Uloga
                    </label>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" value="menađer" name="uloga">
                            <label style="color: white;">
                                <i class="briefcase icon"></i>
                                Menađer
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" value="djelatnik" name="uloga">
                            <label style="color: white;">
                                <i class="wrench icon"></i>
                                Djelatnik
                            </label>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label style="color: white;">
                        <i class="image icon"></i>
                        Slika:
                    </label>
                    <input type="file" name="datoteka" id="slika">
                </div>
                <div style="display: flex; align-items: center; justify-content: center;">
                    <div class="field">
                        <button class="ui submit button" type="submit">
                            <i class="paper plane outline icon"></i>
                            Registriraj
                        </button>
                    </div>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; padding-top: 10px;">
                    <div class="field">
                        Ukoliko već imaš račun <a href="prijava.php">ovdje!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div style="display: flex; align-items: center; justify-content: center; color: lightgray; padding-top: 10px">
            <i class="copyright outline icon"></i>
            <p>Adresko 2024</p>
        </div>
    </footer>
</body>

</html>