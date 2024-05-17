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
        .paginacija {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .slika {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php
    include "izbornik.php";
    ?>

    <h1 style="text-align: center;">
        Pregled adresa
    </h1>
    <div style="display: flex; justify-content: center; margin: 20px;">
        <form method="get" action="pregledAdresa.php" class="ui form">
            <div class="field">
                <div class="ui left icon input">
                    <input type="text" id="search" name="search" placeholder="Pretraži..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <i class="users icon"></i>
                </div>
            </div>
            <button type="submit" class="ui primary button">
                <i class="search icon"></i>
                Pretraži
            </button>
            <button type="reset" class="ui secondary button" onclick="resetSearch()">
                <i class="sync icon"></i>
                Resetiraj
            </button>
        </form>
    </div>
    <div style="display: flex; justify-content: center;" id="poruka">
        <div class="ui yellow mini message">
            <p>
                <strong>
                    Navedenom trakom za pretraživanje možete pronaći <br>
                    željene informacije o raznim korisnicma.
                </strong>
            </p>
        </div>
    </div>
    <?php
    include("otvoriVezu.php");

    $searchTerm = '';
    if (isset($_GET['search'])) {
        $searchTerm = mysqli_real_escape_string($veza, $_GET['search']);
    }

    $recordsPerPage = 3;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $recordsPerPage;

    $totalQuery = "select count(*) as total from polaznik p inner join grad g on g.id = p.grad_id";
    if (!empty($searchTerm)) {
        $totalQuery .= " where p.ime like '%$searchTerm%' or p.prezime like '%$searchTerm%' or p.adresa like '%$searchTerm%' or g.naziv like '%$searchTerm%' or p.email like '%$searchTerm%' or p.spol like '%$searchTerm%'";
    }
    $totalResult = mysqli_query($veza, $totalQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalRecords = $totalRow['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);

    $query = "select p.id, p.ime, p.prezime, p.adresa, g.naziv, p.email, p.spol 
              from polaznik p 
              inner join grad g on g.id = p.grad_id";

    if (!empty($searchTerm)) {
        $query .= " where p.ime like '%$searchTerm%' or p.prezime like '%$searchTerm%' or p.adresa like '%$searchTerm%' or g.naziv like '%$searchTerm%' or p.email like '%$searchTerm%' or p.spol like '%$searchTerm%'";
    }

    $query .= " order by p.id limit $offset, $recordsPerPage";

    $rezultat = mysqli_query($veza, $query);

    while ($redak = mysqli_fetch_array($rezultat)) {
        $id = $redak['id'];
        $ime = $redak['ime'];
        $prezime = $redak['prezime'];
        $adresa = $redak['adresa'];
        $naziv = $redak['naziv'];
        $email = $redak['email'];
        $spol = $redak['spol'];

        $putanja_slike = "slike/$ime.jpg";
        $slika_datoteka = '';

        if (file_exists($putanja_slike)) {
            $slika_datoteka = "<div class='slika'><img class='ui small image' src='$putanja_slike' alt='$ime'></div>";
        } else {
            $slika_datoteka = "Korisnik nema sliku";
        }
    ?>

        <div style="display: flex; align-items: center; justify-content: center; margin: 15px;">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>Ime<i class="address book icon"></i></th>
                        <th>Prezime<i class="address book outline icon"></i></th>
                        <th>Adresa<i class="building icon"></i></th>
                        <th>Grad<i class="home icon"></i></th>
                        <th>Email<i class="envelope icon"></i></th>
                        <th>Spol<i class="male icon"></i>ili<i class="female icon"></i></th>
                        <th>Slika<i class="image icon"></i></th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Ime"><?php echo $ime ?></td>
                        <td data-label="Prezime"><?php echo $prezime ?></td>
                        <td data-label="Adresa"><?php echo $adresa ?></td>
                        <td data-label="Naziv"><?php echo $naziv ?></td>
                        <td data-label="Email"><?php echo $email ?></td>
                        <td data-label="Spol"><?php echo $spol ?></td>
                        <td data-label="Slika"><?php echo $slika_datoteka ?></td>
                        <td style="text-align: center;">
                            <div class="ui dropdown">
                                <div class="text">Postavke</div>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="item">
                                        <a href='brisanjeAdrese.php?id=<?php echo $id ?>'>
                                            <i class="trash alternate outline icon"></i>
                                            Obriši...
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href='izmjenaAdrese.php?id=<?php echo $id ?>'>
                                            <i class="cog icon"></i>
                                            Ažuriraj...
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    <?php
    }
    mysqli_free_result($rezultat);
    mysqli_close($veza);
    ?>
    <div class="paginacija">
        <div class="ui breadcrumb">
            <?php if ($page > 1) : ?>
                <a class="section" href="?search=<?php echo htmlspecialchars($searchTerm); ?>&page=<?php echo $page - 1; ?>"><i class="arrow alternate circle left icon"></i></a>
                <div class="divider"> / </div>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a class="section <?php if ($i == $page) echo 'active'; ?>" href="?search=<?php echo htmlspecialchars($searchTerm); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <div class="divider"> / </div>
            <?php endfor; ?>

            <?php if ($page < $totalPages) : ?>
                <a class="section" href="?search=<?php echo htmlspecialchars($searchTerm); ?>&page=<?php echo $page + 1; ?>"><i class="arrow alternate circle right icon"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        <div style="display: flex; align-items: center; justify-content: center; color: lightgray; padding-top: 10px">
            <i class="copyright outline icon"></i><p>Adresko 2024</p>
        </div>
    </footer>
</body>
<script src="js/app.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/semantic.js"></script>
<script src="js/semantic.min.js"></script>
<script>
    function resetSearch() {
        document.getElementById('search').value = '';
        window.location.href = 'pregledAdresa.php';
    }

    $(document).ready(function() {
        $('#poruka').hide()
        $('#search').mouseenter(function() {
            $('#poruka').fadeIn()
        })
        $('#search').mouseleave(function() {
            $('#poruka').fadeOut()
        })
    })
</script>

</html>