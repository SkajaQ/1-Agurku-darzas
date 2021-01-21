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

<body class="grow-main">
<a class="link btn" href="index.php">Atgal</a>
<h3 class="plant-ttl">Auginimas</h3>
    <form action="" method="post">

    <h1 class="grow-vegname">Agurkai</h1>
    <?php foreach(App::getRepository()->getAllByType('agurkas') as $agurkas): ?>
    <div class="grow-line">
    <?php $kiekisAgurku = $agurkas->auginti() ?>
    <span><?= $agurkas->getKiekis() ?></span>
    <span>+<?= $kiekisAgurku ?></span>
    <input type="hidden" name="kiekisAgurku[<?= $agurkas->getId() ?>]" value="<?= $kiekisAgurku ?>">
    Agurkas Nr. <?= $agurkas->getId() ?>
    </div>
    <?php endforeach ?>
    <button type="submit" name="augintiAgurkus" class="sodinti btn2-cucumber">Auginti agurkus</button>

    <h1 class="grow-vegname">Pomidorai</h1>
    <?php foreach(App::getRepository()->getAllByType('pomidoras') as $pomidoras): ?>
    <div class="grow-line">
    <?php $kiekisPomidoru = $pomidoras->auginti() ?>
    <span><?= $pomidoras->getKiekis() ?></span>
    <span>+<?= $kiekisPomidoru ?></span>
    <input type="hidden" name="kiekisPomidoru[<?= $pomidoras->getId() ?>]" value="<?= $kiekisPomidoru ?>">
    Pomidoras Nr. <?= $pomidoras->getId() ?>
    </div>
    <?php endforeach ?>
    <button type="submit" name="augintiPomidorus" class="sodinti btn2">Auginti pomidorus</button>

    </form>
</body>
</html>