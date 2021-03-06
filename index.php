<?php
include __DIR__.'/App.php';

use Symfony\Component\HttpFoundation\JsonResponse;

App::begin();
$data = App::router();
if ($data != null) {
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Šeimos ūkis</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/growing.css">
    <link rel="stylesheet" href="./css/veggies.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" defer integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
</head>

<body>
    <div class="backgr">
    <h2 class="title">Šeimos ūkis</h2>
    <div class="mainlinks">
        <a class="link" href="./pages/sodinimas.php">Sodinimas</a><br/>
        <a class="link" href="./pages/auginimas.php">Auginimas</a><br/>
        <a class="link" href="./pages/skynimas.php">Skynimas</a><br/>
        <a class="link" href="./pages/silo.php">Daržinė</a><br/>
    </div>
</div>
</body>
</html>