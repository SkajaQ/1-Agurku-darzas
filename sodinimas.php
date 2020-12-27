<?php
session_start();

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['agurku ID'] = 0;
}

// SODINIMO SCENARIJUS
if (isset($_POST['sodinti'])) {

    $_SESSION['a'][] = [
        'id' => ++$_SESSION['agurku ID'],
        'agurkai' => 0
    ];
    header('Location: http://localhost:3000/sodinimas.php');
    exit;
}
// ISROVIMO SCENARIJUS
if (isset($_POST['rauti'])) {
    foreach($_SESSION['a'] as $index => $agurkas) {
        if ($_POST['rauti'] == $agurkas['id']) {
            unset($_SESSION['a'][$index]);
            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sodinimas</title>
</head>
<body>
<a class="link" href="index.html">Atgal</a>
<h1>Agurkų sodas</h1>
<h3>Sodinimas</h3>
    <form action="" method="post">
    <?php foreach($_SESSION['a'] as $agurkas): ?>

    <div>
    Agurkas nr. <?= $agurkas['id'] ?>
    Agurkų: <?= $agurkas['agurkai'] ?>
    <button type="submit" name="rauti" value="<?= $agurkas['id'] ?>">Išrauti</button>
    </div>

    <?php endforeach ?>
    <button type="submit" name="sodinti">SODINTI</button>
    </form>
</body>
</html>