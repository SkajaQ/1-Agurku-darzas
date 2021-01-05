<?php
include __DIR__.'/Darzove.php';
include __DIR__.'/Agurkas.php';
include __DIR__.'/Pomidoras.php';
session_start();

if (!isset($_SESSION['agurkai'])) {
    $_SESSION['agurkai'] = [];
    $_SESSION['darzovesID'] = 0;
}
if (!isset($_SESSION['pomidorai'])) {
    $_SESSION['pomidorai'] = [];
}

// SODINIMO SCENARIJUS
if (isset($_POST['sodintiAgurka'])) {
    $_SESSION['agurkai'][] = new Agurkas(++$_SESSION['darzovesID']);

    header('Location: http://localhost:3000/sodinimas.php');
    exit;
}
if (isset($_POST['sodintiPomidora'])) {
    $_SESSION['pomidorai'][] = new Pomidoras(++$_SESSION['darzovesID']);

    header('Location: http://localhost:3000/sodinimas.php');
    exit;
}
// ISROVIMO SCENARIJUS
if (isset($_POST['rautiAgurka'])) {

    foreach($_SESSION['agurkai'] as $index => $agurkas) {

        if ($_POST['rautiAgurka'] == $agurkas->getId()) {
            unset($_SESSION['agurkai'][$index]);
            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
    }
}
if (isset($_POST['rautiPomidora'])) {

    foreach($_SESSION['pomidorai'] as $index => $pomidoras) {

        if ($_POST['rautiPomidora'] == $pomidoras->getId()) {
            unset($_SESSION['pomidorai'][$index]);
            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
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

    <h1>Agurkai</h1>
    <?php foreach($_SESSION['agurkai'] as $agurkas): ?>
        
    <div class="planting">
        <div class="cucumber">
        Agurkas nr. <?= $agurkas->getId() ?>
        Agurkų: <?= $agurkas->getKiekis() ?>
        </div>
        <button class="button" type="submit" name="rautiAgurka" value="<?= $agurkas->getId() ?>">Išrauti agurka</button>
    </div>
    <?php endforeach ?>
    <button type="submit" name="sodintiAgurka">SODINTI AGURKA</button>

    <h1>Pomidorai</h1>
    <?php foreach($_SESSION['pomidorai'] as $pomidoras): ?>
        
        <div class="planting">
            <div class="cucumber">
            Pomidoro nr. <?= $pomidoras->getId() ?>
            Pomidoru: <?= $pomidoras->getKiekis() ?>
            </div>
            <button class="button" type="submit" name="rautiPomidora" value="<?= $pomidoras->getId() ?>">Išrauti pomidora</button>
        </div>
        <?php endforeach ?>

    <button type="submit" name="sodintiPomidora">SODINTI POMIDORA</button>
    </form>
</body>
</html>