<?php
include __DIR__.'/Darzove.php';
include __DIR__.'/Agurkas.php';
include __DIR__.'/Pomidoras.php';
session_start();

if (!isset($_SESSION['agurkai']) || !isset($_SESSION['pomidorai'])) {
echo 'Nieko nera, pasodink ka nors.';
//TODO: button to sodinimas, kai nera agurku

    $_SESSION['agurkai'] = [];
    $_SESSION['darzovesID'] = 0;
}

// AUGINIMO SCENARIJUS
if (isset($_POST['augintiAgurkus'])) {
    foreach($_SESSION['agurkai'] as $index => &$agurkas) {
        $visasKiekis = $agurkas->getKiekis() + $_POST['kiekisAgurku'][$agurkas->getId()];
        $agurkas->setKiekis($visasKiekis);
    }
    header('Location: http://localhost:3000/auginimas.php');
    exit;
}
if (isset($_POST['augintiPomidorus'])) {
    foreach($_SESSION['pomidorai'] as $index => &$pomidoras) {
        $visasKiekis = $pomidoras->getKiekis() + $_POST['kiekisPomidoru'][$pomidoras->getId()];
        $pomidoras->setKiekis($visasKiekis);
    }
    header('Location: http://localhost:3000/auginimas.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auginimas</title>
</head>
<body>
<a class="link" href="index.html">Atgal</a>
<!-- <h1>Agurkų sodas</h1> -->
<h3>Auginimas</h3>
    <form action="" method="post">
    <h1>Agurkai</h1>
    <?php foreach($_SESSION['agurkai'] as $agurkas): ?>
    <div>
    <?php $kiekisAgurku = $agurkas->auginti() ?>
    <h1 style="display:inline;"><?= $agurkas->getKiekis() ?></h1>
    <h3 style="display:inline;color:red;">+<?= $kiekisAgurku ?></h3>
    <input type="hidden" name="kiekisAgurku[<?= $agurkas->getId() ?>]" value="<?= $kiekisAgurku ?>">
    Agurkas Nr. <?= $agurkas->getId() ?>
    </div>
    <?php endforeach ?>
    <button type="submit" name="augintiAgurkus">Auginti agurkus</button>

    <h1>Pomidorai</h1>
    <?php foreach($_SESSION['pomidorai'] as $pomidoras): ?>
    <div>
    <?php $kiekisPomidoru = $pomidoras->auginti() ?>
    <h1 style="display:inline;"><?= $pomidoras->getKiekis() ?></h1>
    <h3 style="display:inline;color:red;">+<?= $kiekisPomidoru ?></h3>
    <input type="hidden" name="kiekisPomidoru[<?= $pomidoras->getId() ?>]" value="<?= $kiekisPomidoru ?>">
    Pomidoras Nr. <?= $pomidoras->getId() ?>
    </div>
    <?php endforeach ?>
    <button type="submit" name="augintiPomidorus">Auginti pomidorus</button>

    </form>
</body>
</html>