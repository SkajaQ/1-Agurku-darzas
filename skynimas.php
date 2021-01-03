<?php
session_start();

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['agurku ID'] = 0;
}

// SKYNIMO SCENARIJUS
if (isset($_POST['skintiVisus'])) {
    foreach($_SESSION['a'] as $index => &$agurkas) {
        $agurkas['agurkai'] = 0;
    }
    header('Location: http://localhost:3000/skynimas.php');
    exit;
}
foreach($_SESSION['a'] as $index => &$agurkas) {
    $name = 'skinti' . $agurkas['id'];
    $name2 = 'skintiViska' . $agurkas['id'];

    if (isset($_POST[$name])) {
        $agurkas['agurkai'] -= $_POST['kiekisSkinti' .$agurkas['id']];
        if ($agurkas['agurkai'] < 0) {
            $agurkas['agurkai'] = 0;
        }
        header('Location: http://localhost:3000/skynimas.php');
        exit;
    }
    if (isset($_POST[$name2])) {
        $agurkas['agurkai'] = 0;
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
    foreach($_SESSION['a'] as $agurkas): ?>
    <div>
        Agurkas Nr. <?= $agurkas['id'] ?>
        <input type="text" name="kiekisSkinti<?= $agurkas['id'] ?>" value="<?= $_POST['kiekisSkinti' .$agurkas['id']] ?? '' ?>"><br>
        <button type="submit" name="skinti<?= $agurkas['id'] ?>">Skinti</button>
        <button type="submit" name="skintiViska<?= $agurkas['id'] ?>">Skinti visus</button>
        <h1 style="display:inline;"><?= $agurkas['agurkai'] ?></h1>
    </div>
    <?php endforeach ?>

    <button type="submit" name="skintiVisus">Nuimti derliu</button>
    </form>
</body>
</html>