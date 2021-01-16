<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/Darzove.php';
include __DIR__.'/Agurkas.php';
include __DIR__.'/Pomidoras.php';
include __DIR__.'/App.php';

App::begin();
App::harvesting();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skynimas</title>
</head>
<body>
<a class="link" href="index.php">Atgal</a>
<!-- <h1>Agurkų sodas</h1> -->
<h3>Skynimas</h3>
    <form action="" method="post">
    <h1>Agurkai</h1>
    <?php foreach(App::getRepository()->getAllByType('agurkas') as $id => &$agurkas): ?>
    <div>
        Agurkas Nr. <?= $agurkas->getId() ?>
        <input type="text" name="kiekisSkintiAgurku<?= $agurkas->getId() ?>" value="<?= $_POST['kiekisSkintiAgurku' .$agurkas->getId()] ?? '' ?>"><br>
        <button type="submit" name="skintiAgurku<?= $agurkas->getId() ?>">Skinti</button>
        <button type="submit" name="skintiVisusAgurkus<?= $agurkas->getId() ?>">Skinti visus nuo krumo</button>
        <h1 style="display:inline;"><?= $agurkas->getKiekis() ?></h1>
    </div>
    <?php endforeach ?>

    <h1>Pomidorai</h1>
    <?php foreach(App::getRepository()->getAllByType('pomidoras') as $id => &$pomidoras): ?>
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