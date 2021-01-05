<?php
include __DIR__.'/Darzove.php';
include __DIR__.'/Agurkas.php';
include __DIR__.'/Pomidoras.php';
session_start();

if (!isset($_SESSION['a'])) {
echo 'Nieko nera, pasodink ka nors.';
//TODO: button to sodinimas, kai nera agurku

    $_SESSION['a'] = [];
    $_SESSION['agurku ID'] = 0;
}

// AUGINIMO SCENARIJUS
if (isset($_POST['auginti'])) {

    foreach($_SESSION['a'] as $index => &$agurkas) {
        $visasKiekis = $agurkas->getKiekis() + $_POST['kiekis'][$agurkas->getId()];
        $agurkas->setKiekis($visasKiekis);
        // $agurkas['agurkai'] += $_POST['kiekis'][$agurkas['id']];
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
    <?php
    var_dump($_SESSION['a']);
    foreach($_SESSION['a'] as $agurkas): ?>
    <div>
    <?php $kiekis = rand(2, 9) ?>
    <h1 style="display:inline;"><?= $agurkas->getKiekis() ?></h1>
    <h3 style="display:inline;color:red;">+<?= $kiekis ?></h3>
    <input type="hidden" name="kiekis[<?= $agurkas->getId() ?>]" value="<?= $kiekis ?>">
    Agurkas Nr. <?= $agurkas->getId() ?>
    </div>
    <?php endforeach ?>
    <button type="submit" name="auginti">Auginti</button>
    </form>
</body>
</html>