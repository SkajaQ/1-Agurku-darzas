<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/model/Darzove.php';
include __DIR__.'/model/Agurkas.php';
include __DIR__.'/model/Pomidoras.php';
include __DIR__.'/App.php';
App::begin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daržinė</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/planting.css">
    <link rel="stylesheet" href="./css/growing.css">
    <link rel="stylesheet" href="./css/harvesting.css">
    <link rel="stylesheet" href="./css/veggies.css">
    <link rel="stylesheet" href="./css/button.css">
</head>

<body class="silo">
    <header>
        <a class="linkIn" href="sodinimas.php">Sodinimas</a>
        <a class="linkIn" href="auginimas.php">Auginimas</a>
        <a class="linkIn" href="skynimas.php">Skynimas</a>
        <a style="float: right" class="linkIn btn" href="index.php">Atgal</a>
    </header>

    <main>
        <div>
            <img src="./images/cucumber.jpg" alt="" class="cucumber">
            
                Kiekis: <?= App::getRepository()->getHarvested('agurkas'); ?>


            <br><br><br><br><img src="./images/tomato.jpg" alt="" class="tomato">
                
                Kiekis: <?= App::getRepository()->getHarvested('pomidoras'); ?>

        </div>
    <!-- $priceCuc = "Kaina: ".(Agurkas::PRICE)." eur, ".(round((Agurkas::PRICE*$plnRate), 2))." pln, ".(round((Agurkas::PRICE*$krwRate), 2))." krw;";
    $priceTom = "Kaina: ".(Pomidoras::PRICE)." eur, ".(round((Pomidoras::PRICE*$plnRate), 2))." pln, ".(round((Pomidoras::PRICE*$krwRate), 2))." krw;"; -->

    <!-- <input type="text" name="eurPrice" value="<?=$agurkas->getPrice() ?>">  -->
    <!-- <input type="text" value="<?= round(($agurkas->getPrice()*$plnRate), 2) ?>"> -->
    <!-- <input type="text" value="<?=round(($agurkas->getPrice()*$krwRate), 2) ?>"> -->


    </main>


</body>
</html>

