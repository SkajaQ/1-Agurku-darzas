<?php
include __DIR__.'/Agurkas.php';
session_start();

if (!isset($_SESSION['a'])) {
    echo 'Nieko nera, pasodink ka nors.';
    //TODO: button to sodinimas, kai nera agurku


    $_SESSION['a'] = [];
    $_SESSION['agurku ID'] = 0;
}

// SKYNIMO SCENARIJUS
if (isset($_POST['skintiVisus'])) {
    foreach($_SESSION['a'] as $index => &$agurkas) {
        $agurkas->setKiekis(0);
    }
    header('Location: http://localhost:3000/skynimas.php');
    exit;
}
foreach($_SESSION['a'] as $index => &$agurkas) {
    $name = 'skinti' . $agurkas->getId();
    $nameAll = 'skintiViska' . $agurkas->getId();

    if (isset($_POST[$name])) {
        $likoAgurku = $agurkas->getKiekis() - $_POST['kiekisSkinti' .$agurkas->getId()];
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
    <?php 
    var_dump($_SESSION['a']);
    foreach($_SESSION['a'] as $index => &$agurkas): ?>
    <div>
        Agurkas Nr. <?= $agurkas->getId() ?>
        <input type="text" name="kiekisSkinti<?= $agurkas->getId() ?>" value="<?= $_POST['kiekisSkinti' .$agurkas->getId()] ?? '' ?>"><br>
        <button type="submit" name="skinti<?= $agurkas->getId() ?>">Skinti</button>
        <button type="submit" name="skintiViska<?= $agurkas->getId() ?>">Skinti visus</button>
        <h1 style="display:inline;"><?= $agurkas->getKiekis() ?></h1>
    </div>
    <?php endforeach ?>

    <button type="submit" name="skintiVisus">Nuimti derliu</button>
    </form>
</body>
</html>