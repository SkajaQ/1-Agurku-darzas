<?php
include __DIR__.'/Darzove.php';
include __DIR__.'/Agurkas.php';
include __DIR__.'/Pomidoras.php';
include __DIR__.'/App.php';

App::begin();
App::growing();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auginimas</title>
</head>
<body>
<a class="link" href="index.php">Atgal</a>
<!-- <h1>Agurkų sodas</h1> -->
<h3>Auginimas</h3>
    <form action="" method="post">
    <h1>Agurkai</h1>
    <?php foreach(App::getRepository().getAllByType(Agurkas::class) as $agurkas): ?>
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
    <?php foreach(App::getRepository().getAllByType(Pomidoras::class) as $pomidoras): ?>
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