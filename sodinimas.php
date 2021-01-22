<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/model/Darzove.php';
include __DIR__.'/model/Agurkas.php';
include __DIR__.'/model/Pomidoras.php';
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
        <a class="linkIn btn" href="index.php">Atgal</a>
        <h3 class="plant-ttl">Sodinimas</h3>
    </header>

    <main class="plant-main">
        <form action="" method="post">
        <h1 class="grow-vegname">Agurkai</h1>
        <?php foreach(App::getRepository()->getAllByType('agurkas') as $id => &$agurkas): ?>
        <div class="planting cucumber">
            <img src="./images/cucumber.jpg" alt="" class="cucumber">
            Krūmo nr. <?= $agurkas->getId() ?>
            Kiekis: <?= $agurkas->getKiekis() ?>
            <button class="button sodinti" type="submit" name="rautiAgurka" value="<?= $agurkas->getId() ?>">Rauti</button>
        </div>
        <?php endforeach ?>
        <button type="submit" name="sodintiAgurka" class="sodinti btn2-cucumber">Sodinti agurką</button>

        <h1 class="grow-vegname">Pomidorai</h1>
        <?php foreach(App::getRepository()->getAllByType('pomidoras') as &$pomidoras): ?>
            <div class="planting tomato">
                <img src="./images/tomato.jpg" alt="" class="tomato">
                Krūmo nr. <?= $pomidoras->getId() ?>
                Kiekis: <?= $pomidoras->getKiekis() ?>
                <button class="button sodinti" type="submit" name="rautiPomidora" value="<?= $pomidoras->getId() ?>">Rauti</button>
            </div>
            <?php endforeach ?>
        <button type="submit" name="sodintiPomidora" class="sodinti btn2">Sodinti pomidorą</button>
        </form>
    </main>
</body>
</html>