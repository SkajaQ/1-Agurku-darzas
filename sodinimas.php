<?php
include __DIR__.'/Agurkas.php';
session_start();

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['agurku ID'] = 0;
}

// SODINIMO SCENARIJUS
if (isset($_POST['sodinti'])) {
    $_SESSION['a'][] = new Agurkas(++$_SESSION['agurku ID']);

    // $_SESSION['a'][] = [
    //     'id' => ++$_SESSION['agurku ID'],
    //     'agurkai' => 0
    // ];
    header('Location: http://localhost:3000/sodinimas.php');
    exit;
}
// ISROVIMO SCENARIJUS
if (isset($_POST['rauti'])) {

    foreach($_SESSION['a'] as $index => $agurkas) {

        if ($_POST['rauti'] == $agurkas->getId()) {
            unset($_SESSION['a'][$index]);
            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }

        // if ($_POST['rauti'] == $agurkas['id']) {
        //     unset($_SESSION['a'][$index]);
        //     header('Location: http://localhost:3000/sodinimas.php');
        //     exit;
        // }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sodinimas</title>
    <!-- <link rel="stylesheet" href="./main.css"> -->
</head>
<body>
<a class="link" href="index.html">Atgal</a>
<!-- <h1>Agurkų sodas</h1> -->
<h3 class="plant-ttl">Sodinimas</h3>

    <form action="" method="post">
    <?php
    var_dump($_SESSION['a']);
    foreach($_SESSION['a'] as $agurkas): ?>
        
    <div class="planting">

        <div class="cucumber">
        Agurkas nr. <?= $agurkas->getId() ?>
        Agurkų: <?= $agurkas->getKiekis() ?>
        </div>
        <button class="button" type="submit" name="rauti" value="<?= $agurkas->getId() ?>">Išrauti</button>
    </div>

    <?php endforeach ?>
    <button type="submit" name="sodinti">SODINTI</button>
    </form>
</body>
</html>