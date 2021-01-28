<?php
include __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../App.php';

App::begin();
App::harvesting();
App::loadCurrencies();

$plnRate = $_SESSION['rates']->PLN;
$krwRate = $_SESSION['rates']->KRW;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daržinė</title>
    <link rel="stylesheet" href="./../css/main.css">
    <link rel="stylesheet" href="./../css/planting.css">
    <link rel="stylesheet" href="./../css/growing.css">
    <link rel="stylesheet" href="./../css/harvesting.css">
    <link rel="stylesheet" href="./../css/veggies.css">
    <link rel="stylesheet" href="./../css/button.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" defer integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
</head>

<body>
    <header class="silo">
        <a class="linkIn" href="sodinimas.php">Sodinimas</a>
        <a class="linkIn" href="auginimas.php">Auginimas</a>
        <a class="linkIn" href="skynimas.php">Skynimas</a>
        <a class="linkIn" href="silo.php">Daržinė</a>
        <a style="float: right" class="linkIn btn" href="./../index.php">Atgal</a>
        <h3 class="plant-ttl">Daržinė</h3>
    </header>

    <main>
        <div>
            <img src="./../images/cucumber.jpg" alt="" class="cucumber">
            
                Kiekis: <?= App::getRepository()->getHarvested('agurkas'); ?>


            <br><br><br><br> <img src="./../images/tomato.jpg" alt="" class="tomato">
                
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

