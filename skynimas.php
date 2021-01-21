<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/model/Darzove.php';
include __DIR__.'/model/Agurkas.php';
include __DIR__.'/model/Pomidoras.php';
include __DIR__.'/App.php';

App::begin();
App::harvesting();
App::loadCurrencies();

$plnRate = $_SESSION['rates']->PLN;
$krwRate = $_SESSION['rates']->KRW;

$priceCuc = "Kaina: ".(Agurkas::PRICE)." eur, ".(round((Agurkas::PRICE*$plnRate), 2))." pln, ".(round((Agurkas::PRICE*$krwRate), 2))." krw;";
$priceTom = "Kaina: ".(Pomidoras::PRICE)." eur, ".(round((Pomidoras::PRICE*$plnRate), 2))." pln, ".(round((Pomidoras::PRICE*$krwRate), 2))." krw;";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skynimas</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/planting.css">
    <link rel="stylesheet" href="./css/growing.css">
    <link rel="stylesheet" href="./css/harvesting.css">
    <link rel="stylesheet" href="./css/veggies.css">
    <link rel="stylesheet" href="./css/button.css">
</head>
<body class="harv-main">
<a class="link btn" href="index.php">Atgal</a>
<!-- <h1>Agurkų sodas</h1> -->
<h3 class="plant-ttl">Skynimas</h3>
    <form action="" method="post">
    <h1 class="grow-vegname">Agurkai - <?= $priceCuc ?></h1> 

    <?php foreach(App::getRepository()->getAllByType('agurkas') as $id => &$agurkas): ?>
    <div class="grow-line">
        Agurkas Nr. <?= $agurkas->getId() ?>
        <span class="grow-line">Užaugo: <?= $agurkas->getKiekis() ?></span>
        <input type="text" name="kiekisSkintiAgurku<?= $agurkas->getId() ?>" value="<?= $_POST['kiekisSkintiAgurku' .$agurkas->getId()] ?? '' ?>">
        <!-- <input type="text" name="eurPrice" value="<?=$agurkas->getPrice() ?>">  -->
        <!-- <input type="text" value="<?= round(($agurkas->getPrice()*$plnRate), 2) ?>"> -->
        <!-- <input type="text" value="<?=round(($agurkas->getPrice()*$krwRate), 2) ?>"> -->
        <button type="submit" name="skintiAgurku<?= $agurkas->getId() ?>" class="button sodinti">Skinti</button>
        <button type="submit" name="skintiVisusAgurkus<?= $agurkas->getId() ?>" class="button sodinti">Skinti visus nuo krumo</button>
    </div>
    <?php endforeach ?>

    <h1 class="grow-vegname">Pomidorai - <?= $priceTom ?></h1>
    <?php foreach(App::getRepository()->getAllByType('pomidoras') as $id => &$pomidoras): ?>
    <div class="grow-line">
        Pomidoras Nr. <?= $pomidoras->getId() ?>
        <span class="grow-line">Užaugo: <?= $pomidoras->getKiekis() ?></span>
        <input type="text" name="kiekisSkintiPomidoru<?= $pomidoras->getId() ?>" value="<?= $_POST['kiekisSkintiPomidoru' .$pomidoras->getId()] ?? '' ?>">
        <button type="submit" name="skintiPomidoru<?= $pomidoras->getId() ?>" class="button sodinti">Skinti</button>
        <button type="submit" name="skintiVisusPomidorus<?= $pomidoras->getId() ?>" class="button sodinti">Skinti visus nuo krumo</button>
    </div>
    <?php endforeach ?>

    <button type="submit" name="skintiDerliu" class="link btn">Nuimti derliu</button>
    </form>
</body>
</html>