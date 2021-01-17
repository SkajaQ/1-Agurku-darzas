<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/Darzove.php';
include __DIR__.'/Agurkas.php';
include __DIR__.'/Pomidoras.php';
include __DIR__.'/App.php';

App::begin();

if (isset($_POST['sodintiAgurka']) || isset($_POST['sodintiPomidora'])) {
    App::planting();
}
if (isset($_POST['rautiAgurka']) || isset($_POST['rautiPomidora'])) {
    App::planting();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sodinimas</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="./css/growing.css">
    <link rel="stylesheet" href="./css/veggies.css">
    <link rel="stylesheet" href="./css/planting.css">
    <link rel="stylesheet" href="./css/button.css">
</head>
<body class="plant-main">
<a class="link btn" href="index.php">Atgal</a>
<!-- <h1>Agurkų sodas</h1> -->
<h3 class="plant-ttl">Sodinimas</h3>

    <form action="" method="post">

    <h1>Agurkai</h1>
    <?php foreach(App::getRepository()->getAllByType('agurkas') as $id => &$agurkas): ?>
    <div class="planting cucumber">
        <img src="./images/cucumber.jpg" alt="" class="cucumber">
        bush nr. <?= $agurkas->getId() ?>
        Total: <?= $agurkas->getKiekis() ?>
        <button class="button sodinti" type="submit" name="rautiAgurka" value="<?= $agurkas->getId() ?>">Dig Out</button>
    </div>
    <?php endforeach ?>
    <button type="submit" name="sodintiAgurka" class="sodinti btn2-cucumber">Plant Cucumber</button>

    <h1>Pomidorai</h1>
    <?php foreach(App::getRepository()->getAllByType('pomidoras') as &$pomidoras): ?>
        <div class="planting tomato">
        <img src="./images/tomato.jpg" alt="" class="tomato">
            bush nr. <?= $pomidoras->getId() ?>
            Total: <?= $pomidoras->getKiekis() ?>
            <button class="button sodinti" type="submit" name="rautiPomidora" value="<?= $pomidoras->getId() ?>">Dig Out</button>
        </div>
        <?php endforeach ?>

    <button type="submit" name="sodintiPomidora" class="sodinti btn2">Plant Tomato</button>
    </form>
</body>
</html>