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

// SKYNIMO SCENARIJUS
if (isset($_POST['skintiDerliu'])) {
    foreach($_SESSION['agurkai'] as $index => &$agurkas) {
        $agurkas->setKiekis(0);
    } 
    foreach($_SESSION['pomidorai'] as $index => &$pomidoras) {
        $pomidoras->setKiekis(0);
    }
    header('Location: http://localhost:3000/skynimas.php');
    exit;
}
foreach($_SESSION['agurkai'] as $index => &$agurkas) {
    $name = 'skintiAgurku' . $agurkas->getId();
    $nameAll = 'skintiVisusAgurkus' . $agurkas->getId();

    if (isset($_POST[$name])) {
        $likoAgurku = $agurkas->getKiekis() - $_POST['kiekisSkintiAgurku' .$agurkas->getId()];
        if ($likoAgurku < 0) {
            $likoAgurku = 0;
        }
        $agurkas->setKiekis($likoAgurku);
        header('Location: http://localhost:3000/skynimas.php');
        exit;
    }
    if (isset($_POST[$nameAll])) {
        $agurkas->setKiekis(0);
        header('Location: http://localhost:3000/skynimas.php');
        exit;
    }
}
foreach($_SESSION['pomidorai'] as $index => &$pomidoras) {
    $name = 'skintiPomidoru' . $pomidoras->getId();
    $nameAll = 'skintiVisusPomidorus' . $pomidoras->getId();

    if (isset($_POST[$name])) {
        $likoAPomidoru = $pomidoras->getKiekis() - $_POST['kiekisSkintiPomidoru' .$pomidoras->getId()];
        if ($likoAPomidoru < 0) {
            $likoAPomidoru = 0;
        }
        $pomidoras->setKiekis($likoAPomidoru);
        header('Location: http://localhost:3000/skynimas.php');
        exit;
    }
    if (isset($_POST[$nameAll])) {
        $pomidoras->setKiekis(0);
        header('Location: http://localhost:3000/skynimas.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skynimas</title>
</head>
<body>
<a class="link" href="index.html">Atgal</a>
<!-- <h1>Agurkų sodas</h1> -->
<h3>Skynimas</h3>
    <form action="" method="post">
    <h1>Agurkai</h1>
    <?php foreach($_SESSION['agurkai'] as $index => &$agurkas): ?>
    <div>
        Agurkas Nr. <?= $agurkas->getId() ?>
        <input type="text" name="kiekisSkintiAgurku<?= $agurkas->getId() ?>" value="<?= $_POST['kiekisSkintiAgurku' .$agurkas->getId()] ?? '' ?>"><br>
        <button type="submit" name="skintiAgurku<?= $agurkas->getId() ?>">Skinti</button>
        <button type="submit" name="skintiVisusAgurkus<?= $agurkas->getId() ?>">Skinti visus nuo krumo</button>
        <h1 style="display:inline;"><?= $agurkas->getKiekis() ?></h1>
    </div>
    <?php endforeach ?>

    <h1>Pomidorai</h1>
    <?php foreach($_SESSION['pomidorai'] as $index => &$pomidoras): ?>
    <div>
        Pomidoras Nr. <?= $pomidoras->getId() ?>
        <input type="text" name="kiekisSkintiPomidoru<?= $pomidoras->getId() ?>" value="<?= $_POST['kiekisSkintiPomidoru' .$pomidoras->getId()] ?? '' ?>"><br>
        <button type="submit" name="skintiPomidoru<?= $pomidoras->getId() ?>">Skinti</button>
        <button type="submit" name="skintiVisusPomidorus<?= $pomidoras->getId() ?>">Skinti visus nuo krumo</button>
        <h1 style="display:inline;"><?= $pomidoras->getKiekis() ?></h1>
    </div>
    <?php endforeach ?>

    <button type="submit" name="skintiDerliu">Nuimti derliu</button>
    </form>
</body>
</html>