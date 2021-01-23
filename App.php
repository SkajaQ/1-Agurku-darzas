<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/repository/GardenRepository.php';
include __DIR__.'/repository/DBRepository.php';

use Dotenv\Dotenv;
   
$dotenv = new Dotenv(__DIR__);
$dotenv->load();

class App {

    private static GardenRepository $repository;

    public static function begin() {
        session_start();   
        if (!isset($repository)) {
            self::$repository = new DBRepository();
        }
    }

    public static function getRepository() {
        return self::$repository;
    }

    public static function router() {
        if (URI[0] == '' || URI[0] == 'plant') {
            if (!isset(URI[1])) {
                return (new Controller\Garden)->render();
            }
            if (URI[1] == 'new') {
                return (new Controller\Garden)->plantNew();
            }
            if (URI[1] == 'remove') {
                return (new Controller\Garden)->uproot();
            }
        }

        if (URI[0] == 'grow') {
            if (!isset(URI[1])) {
                return (new Controller\Grow)->render();
            }
            if (URI[1] == 'type') {
                return (new Controller\Grow)->growAll();
            }
        }
        
        if (URI[0] == 'harvest') {
            if (!isset(URI[1])) {
                return (new Controller\Pick)->render();
            }
            if (URI[1] == 'all') {
                return (new Controller\Pick)->pick();
            }
            if (URI[1] == 'all/type') {
                return (new Controller\Pick)->pick();
            }
            if (URI[1] == 'bush') {
                return (new Controller\Pick)->pick();
            }
            if (URI[1] == 'bush/part') {
                return (new Controller\Pick)->pick();
            }
        }

        // if (isset(URI[1]) && URI[1] == 'setCurrency') {
        //     return (new Controller\Currency)->setCurrency();
        // }
        return include_once __DIR__ . '/notFound.php';
    }

    public static function planting () {
        // SODINIMO SCENARIJUS
        if (isset($_POST['sodintiAgurka'])) {
            $id = self::getRepository()->getNewId();
            self::getRepository()->save(new Agurkas($id));
            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
        if (isset($_POST['sodintiPomidora'])) {
            $id = self::getRepository()->getNewId();
            self::getRepository()->save(new Pomidoras($id));
            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
        // ISROVIMO SCENARIJUS
        if (isset($_POST['rautiAgurka'])) {
            self::console_log('rauti');
            foreach(self::$repository->getAll() as $id => $agurkas) {

                if ($_POST['rautiAgurka'] == $agurkas->getId()) {
                    self::$repository->delete($agurkas->getId());
                    header('Location: http://localhost:3000/sodinimas.php');
                    exit;
                }
            }
        }
        if (isset($_POST['rautiPomidora'])) {
            foreach(self::$repository->getAll() as $id => $pomidoras) {

                if ($_POST['rautiPomidora'] == $pomidoras->getId()) {
                    self::$repository->delete($pomidoras->getId());
                    header('Location: http://localhost:3000/sodinimas.php');
                    exit;
                }
            }
        }
    }

    public static function growing() {
        // AUGINIMO SCENARIJUS
        if (isset($_POST['augintiAgurkus'])) {
            foreach(self::$repository->getAll() as $id => &$agurkas) {
                $visasKiekis = $agurkas->getKiekis() + $_POST['kiekisAgurku'][$agurkas->getId()];
                $agurkas->setKiekis($visasKiekis);
                self::$repository->update($agurkas);
            }
            header('Location: http://localhost:3000/auginimas.php');
            exit;
        }
        if (isset($_POST['augintiPomidorus'])) {
            foreach(self::$repository->getAll() as $id => &$pomidoras) {
                $visasKiekis = $pomidoras->getKiekis() + $_POST['kiekisPomidoru'][$pomidoras->getId()];
                $pomidoras->setKiekis($visasKiekis);
                self::$repository->update($pomidoras);
            }
            header('Location: http://localhost:3000/auginimas.php');
            exit;
        }
    }

    public static function harvesting() {
        // SKYNIMO SCENARIJUS
        if (isset($_POST['skintiDerliu'])) {
            foreach (self::$repository->getAll() as $id => &$darzove) {
                $darzove->setKiekis(0);
                self::$repository->update($darzove);
            }
            header('Location: http://localhost:3000/skynimas.php');
            exit;
        }
        foreach(self::$repository->getAll() as $id => &$agurkas) {
            $name = 'skintiAgurku' . $agurkas->getId();
            $nameAll = 'skintiVisusAgurkus' . $agurkas->getId();

            if (isset($_POST[$name])) {
                $likoAgurku = $agurkas->getKiekis() - ceil(abs($_POST['kiekisSkintiAgurku' .$agurkas->getId()]));
                if ($likoAgurku < 0) {
                    $likoAgurku = 0;

                }
                $agurkas->setKiekis($likoAgurku);
                self::$repository->update($agurkas);
                header('Location: http://localhost:3000/skynimas.php');
                exit;
            }
            if (isset($_POST[$nameAll])) {
                $agurkas->setKiekis(0);
                self::$repository->update($agurkas);
                header('Location: http://localhost:3000/skynimas.php');
                exit;
            }
        }
        foreach(self::$repository->getAll() as $id => &$pomidoras) {
            $name = 'skintiPomidoru' . $pomidoras->getId();
            $nameAll = 'skintiVisusPomidorus' . $pomidoras->getId();

            if (isset($_POST[$name])) {
                $likoAPomidoru = $pomidoras->getKiekis() - ceil(abs($_POST['kiekisSkintiPomidoru' .$pomidoras->getId()]));
                if ($likoAPomidoru < 0) {
                    $likoAPomidoru = 0;
                }
                $pomidoras->setKiekis($likoAPomidoru);
                self::$repository->update($pomidoras);
                header('Location: http://localhost:3000/skynimas.php');
                exit;
            }
            if (isset($_POST[$nameAll])) {
                $pomidoras->setKiekis(0);
                self::$repository->update($pomidoras);
                header('Location: http://localhost:3000/skynimas.php');
                exit;
            }
        }
    }

    public static function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    public static function loadCurrencies() {
        include __DIR__ . '/currency/Cache.php';
        $DATA = new Cache();
        $answer = $DATA->get();

        $_SESSION['method'] = false === $answer ? 'API' : 'CACHE';

        if (false === $answer) {
            // API START

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.exchangeratesapi.io/latest');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $answer = curl_exec($ch); // siuntimas ir laukimas atsakymo

            $answer = json_decode($answer);
            $DATA->set($answer); // <---- uzkesinam naujus duomenis
            // API END
            
        $_SESSION['rates'] = $answer->rates;
        }

    }

}