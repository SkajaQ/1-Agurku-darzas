<?php
class App {

    public static function begin() {

        session_start();

        if (!isset($_SESSION['agurkai'])) {
            $_SESSION['agurkai'] = [];
            $_SESSION['darzovesID'] = 0;
        }
        if (!isset($_SESSION['pomidorai'])) {
            $_SESSION['pomidorai'] = [];
        }
    }



    public static function planting () {
        // SODINIMO SCENARIJUS
        if (isset($_POST['sodintiAgurka'])) {
            $id = ++$_SESSION['darzovesID'];
            $_SESSION['agurkai'][$id] = new Agurkas($id);

            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
        if (isset($_POST['sodintiPomidora'])) {
            $id = ++$_SESSION['darzovesID'];
            $_SESSION['pomidorai'][$id] = new Pomidoras($id);

            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
        // ISROVIMO SCENARIJUS
        if (isset($_POST['rautiAgurka'])) {

            foreach($_SESSION['agurkai'] as $id => $agurkas) {

                if ($_POST['rautiAgurka'] == $agurkas->getId()) {
                    unset($_SESSION['agurkai'][$id]);
                    header('Location: http://localhost:3000/sodinimas.php');
                    exit;
                }
            }
        }
        if (isset($_POST['rautiPomidora'])) {

            foreach($_SESSION['pomidorai'] as $id => $pomidoras) {

                if ($_POST['rautiPomidora'] == $pomidoras->getId()) {
                    unset($_SESSION['pomidorai'][$id]);
                    header('Location: http://localhost:3000/sodinimas.php');
                    exit;
                }
            }
        }
    }

    public static function growing() {

        // AUGINIMO SCENARIJUS
        if (isset($_POST['augintiAgurkus'])) {
            foreach($_SESSION['agurkai'] as $id => &$agurkas) {
                $visasKiekis = $agurkas->getKiekis() + $_POST['kiekisAgurku'][$agurkas->getId()];
                $agurkas->setKiekis($visasKiekis);
            }
            header('Location: http://localhost:3000/auginimas.php');
            exit;
        }
        if (isset($_POST['augintiPomidorus'])) {
            foreach($_SESSION['pomidorai'] as $id => &$pomidoras) {
                $visasKiekis = $pomidoras->getKiekis() + $_POST['kiekisPomidoru'][$pomidoras->getId()];
                $pomidoras->setKiekis($visasKiekis);
            }
            header('Location: http://localhost:3000/auginimas.php');
            exit;
        }
    }

    public static function harvesting() {
        // SKYNIMO SCENARIJUS
        if (isset($_POST['skintiDerliu'])) {
            foreach($_SESSION['agurkai'] as $id => &$agurkas) {
                $agurkas->setKiekis(0);
            } 
            foreach($_SESSION['pomidorai'] as $id => &$pomidoras) {
                $pomidoras->setKiekis(0);
            }
            header('Location: http://localhost:3000/skynimas.php');
            exit;
        }
        foreach($_SESSION['agurkai'] as $id => &$agurkas) {
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
        foreach($_SESSION['pomidorai'] as $id => &$pomidoras) {
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
    }
}