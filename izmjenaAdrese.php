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
    <?php
    include("otvoriVezu.php");

    $rezultat = mysqli_query($veza, "SELECT * FROM polaznik WHERE id = " . $_GET['id']);
    while ($redak = mysqli_fetch_array($rezultat)) {
        $id = $redak['id'];
        $ime = $redak['ime'];
        $prezime = $redak['prezime'];
        $adresa = $redak['adresa'];
        $grad_id = $redak['grad_id'];
        $email = $redak['email'];
        $spol = $redak['spol'];
    }
    mysqli_free_result($rezultat);

    $gradovi_query = mysqli_query($veza, "SELECT * FROM grad");
    $gradovi = array();
    while ($grad_redak = mysqli_fetch_array($gradovi_query)) {
        $gradovi[] = $grad_redak;
    }
    mysqli_free_result($gradovi_query);
    mysqli_close($veza);
    ?>
    <h2>
        <i class="cog icon"></i>Izmjena podataka
    </h2>
    <div class="forma">
        <div class="ui segment">
            <form class="ui form" action="spremiIzmjene.php" method="post" enctype="multipart/form-data">
                <div class="field">
                    <label><i class="address book icon"></i>Ime:</label>
                    <div class="field">
                        <input type="text" name="ime" class="ime" placeholder="Ime" value="<?php echo $ime ?>">
                    </div>
                    <label><i class="address book outline icon"></i>Prezime:</label>
                    <input type="text" name="prezime" class="prezime" placeholder="Prezime" value="<?php echo $prezime ?>">
                </div>
                <div class="field">
                    <label>
                        <i class="envelope icon"></i>
                        Email:
                    </label>
                    <input type="text" name="email" placeholder="Email" id="mail" value="<?php echo $email ?>">
                </div>
                <div class="field">
                    <label><i class="building icon"></i>Adresa:</label>
                    <input type="text" name="adresa" class="adresa" value="<?php echo $adresa ?>">
                </div>
                <div class="field">
                    <label>
                        <i class="home icon"></i>
                        Grad:
                    </label>
                    <select class="ui fluid dropdown" name="grad_id" id="grad">
                        <?php foreach ($gradovi as $grad) { ?>
                            <option value="<?php echo $grad['id']; ?>" <?php if ($grad_id == $grad['id']) echo 'selected'; ?>><?php echo $grad['naziv']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="inline fields">
                    <label>Spol:</label>
                    <div class="field">
                        <input type="radio" value="m" name="spol" <?php if ($spol == 'm') echo 'checked'; ?>>
                        <label>
                            Muški
                            <i class="male icon"></i>
                        </label>
                    </div>
                    <div class="field">
                        <input type="radio" value="z" name="spol" <?php if ($spol == 'z') echo 'checked'; ?>>
                        <label>
                            Ženski
                            <i class="female icon"></i>
                        </label>
                    </div>
                </div>
                <div class="field">
                    <label>
                        <i class="image icon"></i>
                        Slika:
                    </label>
                    <input type="file" name="datoteka" id="slika">
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="gumbovi">
                    <button type="submit" class="ui primary button spremi">
                        <i class="bookmark icon"></i>
                        Spremi
                    </button>
                    <button type="reset" class="ui secondary button odustani">
                        <i class="undo icon"></i>
                        Resetiraj
                    </button>
                    <input type="button" value="Nazad" class="ui button nazad" id="vrati">
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('vrati').addEventListener('click', function() {
            location.href = 'pregledAdresa.php';
        });
    </script>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/semantic.js"></script>
<script src="js/semantic.min.js"></script>
<script src="js/app.js"></script>

</html>