<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adresko</title>
    <link rel="stylesheet" href="css/podaci.css">
    <link rel="stylesheet" href="css/podaci.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.css">
    <link rel="stylesheet" href="semantic-ui-css/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
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
    <h2>
        Prikupljeni podaci sa registracije
    </h2>
    <?php
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $korisnickoIme = $_POST['korisnicko_ime'];
    $password = $_POST['password'];
    $uloga = $_POST['uloga'];
    ?>

    <div class="podaci">
        <div class="ui segment">
            <p>
                <i class="address book icon"></i>
                <?php echo "Ime: $ime" ?>
            </p>
            <p>
                <i class="address book outline icon"></i>
                <?php echo "Prezime: $prezime" ?>
            </p>
            <p>
                <i class="users icon"></i>
                <?php echo "Korisničko ime: $korisnickoIme" ?>
            </p>
            <p>
                <i class="lock icon"></i>
                <?php echo "Lozinka: <i class='eye slash outline icon'></i>"; ?>
            </p>
            <p>
                <i class="id badge icon"></i>
                <?php echo "Uloga: $uloga" ?>
            </p>
            <?php
            if (isset($_FILES["datoteka"]["name"]) && $_FILES["datoteka"]["size"] != 0) {
                $izvor = $_FILES["datoteka"]["tmp_name"];
                $odrediste = "slike/{$ime}.jpg";
                move_uploaded_file($izvor, $odrediste);
                echo "<p>Slika: slike/{$ime}.jpg</p>";
            } else {
                echo "<p>Korisnik nije odabrao sliku</p>";
            }
            ?>
            <div class="field">
                <a href="prijava.php">
                    Nazad na prijavu
                </a>
            </div>
        </div>
    </div>
    <?php
    include "otvoriVezu.php";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "insert into korisnik (ime, prezime, korisnicko_ime, password, uloga) ";
    $sql .= "VALUES ('$ime', '$prezime', '$korisnickoIme', '$hashedPassword', '$uloga')"; // Stavljamo hashiranu lozinku u bazu
    if (mysqli_query($veza, $sql)) {
        echo "
            <div class='poruka'>
            <div class='ui success message'>
              <p>Podaci su uspješno uneseni, registracija uspješno provedena</p>
            </div>
            </div>
            ";
    } else {
        echo "
        <div class='poruka'>
        <div class='ui negative message'>
        <p>Podaci nisu uspješno uneseni zbog navedene greške: " . mysqli_error($veza) .
            "!</p></div></div>
            ";
    }
    mysqli_close($veza);
    
    ?>
</body>

</html>
