<?php
include __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../App.php';

App::begin();
App::router();

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
    <link rel="stylesheet" href="./../css/main.css">
    <link rel="stylesheet" href="./../css/planting.css">
    <link rel="stylesheet" href="./../css/growing.css">
    <link rel="stylesheet" href="./../css/harvesting.css">
    <link rel="stylesheet" href="./../css/veggies.css">
    <link rel="stylesheet" href="./../css/button.css">
    <script src="./../js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" defer integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <a class="linkIn" href="sodinimas.php">Sodinimas</a>
        <a class="linkIn" href="auginimas.php">Auginimas</a>
        <a class="linkIn" href="skynimas.php">Skynimas</a>
        <a class="linkIn" href="silo.php">Daržinė</a>
        <a style="float: right" class="linkIn btn" href="index.php">Atgal</a>
        <h3 class="plant-ttl">Sodinimas</h3>
    </header>

    <main class="plant-main">
        <h1 class="grow-vegname">Agurkai</h1>
        <div class="cucumber-place"></div>
        <button id="plantCucumber" type="submit" name="sodintiAgurka" class="sodinti btn2-cucumber">Sodinti agurką</button>

        <h1 class="grow-vegname">Pomidorai</h1>
        <div class="tomatoes-place"></div>
        <button id="plantTomato" type="submit" name="sodintiPomidora" class="sodinti btn2">Sodinti pomidorą</button>
    </main>

</body>
</html>