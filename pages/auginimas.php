<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/model/Darzove.php';
include __DIR__.'/model/Agurkas.php';
include __DIR__.'/model/Pomidoras.php';
include __DIR__.'/App.php';

App::begin();
App::growing();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Auginimas</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/planting.css">
    <link rel="stylesheet" href="./css/growing.css">
    <link rel="stylesheet" href="./css/harvesting.css">
    <link rel="stylesheet" href="./css/veggies.css">
    <link rel="stylesheet" href="./css/button.css">
</head>

<body>
    <header>
        <a class="linkIn" href="sodinimas.php">Sodinimas</a>
        <a class="linkIn" href="auginimas.php">Auginimas</a>
        <a class="linkIn" href="skynimas.php">Skynimas</a>
        <a class="linkIn" href="silo.php">Daržinė</a>
        <a style="float: right" class="linkIn btn" href="index.php">Atgal</a>
        <h3 class="plant-ttl">Auginimas</h3>
    </header>
    <main class="grow-main">
        <form class="form" action="" method="post">
        <h1 class="grow-vegname">Agurkai</h1>
        <?php foreach(App::getRepository()->getAllByType('agurkas') as $agurkas): ?>
        <div class="grow-line">
            <img src="./images/cucumber.jpg" alt="" class="cucumber">
            Krūmo Nr. <?= $agurkas->getId() ?>
            <?php $kiekisAgurku = $agurkas->auginti() ?>
            <span class="grow-line">Yra: <?= $agurkas->getKiekis() ?></span>
            <span class="grow-line">Užaugs +<?= $kiekisAgurku ?></span>
            <input type="hidden" name="kiekisAgurku[<?= $agurkas->getId() ?>]" value="<?= $kiekisAgurku ?>">
        </div>
        <?php endforeach ?>
        <button type="submit" name="augintiAgurkus" class="sodinti btn2-cucumber">Auginti agurkus</button>

        <h1 class="grow-vegname">Pomidorai</h1>
        
        <?php foreach(App::getRepository()->getAllByType('pomidoras') as $pomidoras): ?>
        <div class="grow-line">
            <img src="./images/tomato.jpg" alt="" class="tomato">
            Krūmo Nr. <?= $pomidoras->getId() ?>
            <?php $kiekisPomidoru = $pomidoras->auginti() ?>
            <span class="grow-line">Yra: <?= $pomidoras->getKiekis() ?></span>
            <span class="grow-line">Užaugs +<?= $kiekisPomidoru ?></span>
            <input type="hidden" name="kiekisPomidoru[<?= $pomidoras->getId() ?>]" value="<?= $kiekisPomidoru ?>">
        </div>
        <?php endforeach ?>
        <button type="submit" name="augintiPomidorus" class="sodinti btn2">Auginti pomidorus</button>
        </form>
    </main>
</body>
</html>