<?php
include __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../model/Darzove.php';
include __DIR__.'/../model/Agurkas.php';
include __DIR__.'/../model/Pomidoras.php';
include __DIR__.'/../App.php';

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
    <link rel="stylesheet" href="./../css/main.css">
    <link rel="stylesheet" href="./../css/planting.css">
    <link rel="stylesheet" href="./../css/growing.css">
    <link rel="stylesheet" href="./../css/harvesting.css">
    <link rel="stylesheet" href="./../css/veggies.css">
    <link rel="stylesheet" href="./../css/button.css">
    <script src="./../js/harvesting.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" defer integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
</head>

<body>
    <header>
    <a class="linkIn" href="sodinimas.php">Sodinimas</a>
        <a class="linkIn" href="auginimas.php">Auginimas</a>
        <a class="linkIn" href="skynimas.php">Skynimas</a>
        <a class="linkIn" href="silo.php">Daržinė</a>
        <a style="float: right" class="linkIn btn" href="./../index.php">Atgal</a>
        <h3 class="plant-ttl">Skynimas</h3>
    </header>

    <main class="harv-main">
        <form class="form" action="" method="post">
        <h1 class="grow-vegname">Agurkai - <?= $priceCuc ?></h1> 
        <?php foreach(App::getRepository()->getAllByType('agurkas') as $id => &$agurkas): ?>
        <div class="grow-line">
            <img src="./images/cucumber.jpg" alt="" class="cucumber">
            Krūmo Nr. <?= $agurkas->getId() ?>
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
            <img src="./images/tomato.jpg" alt="" class="tomato">
            Krūmo Nr. <?= $pomidoras->getId() ?>
            <span class="grow-line">Užaugo: <?= $pomidoras->getKiekis() ?></span>
            <input type="number" name="kiekisSkintiPomidoru<?= $pomidoras->getId() ?>" value="<?= $_POST['kiekisSkintiPomidoru' .$pomidoras->getId()] ?? '' ?>">
            <button type="submit" name="skintiPomidoru<?= $pomidoras->getId() ?>" class="button sodinti">Skinti</button>
            <button type="submit" name="skintiVisusPomidorus<?= $pomidoras->getId() ?>" class="button sodinti">Skinti visus nuo krumo</button>
        </div>
        <?php endforeach ?>

        <button type="submit" name="skintiDerliu" class="link btn">Nuimti derliu</button>
        </form>
    </main>
</body>
</html>