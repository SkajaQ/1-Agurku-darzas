<?php
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/repository/GardenRepository.php';
include __DIR__.'/repository/DBRepository.php';
include __DIR__.'/controller/PlantingController.php';
include __DIR__.'/model/Darzove.php';
include __DIR__.'/model/Agurkas.php';
include __DIR__.'/model/Pomidoras.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

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
        $uri = explode('/', $_SERVER['REQUEST_URI']);  

        if ($uri[1] == 'pages') {
            return;
        }
        
        // TODO: if for uri 2 3

        if ($uri[1] == 'plant') {
            $controller = new PlantingController(self::$repository);
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $type = $uri[2];
                return $controller->get($type);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $type = json_decode(file_get_contents("php://input"))->type;
                return $controller->plant($type);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $id = $uri[2];
                return $controller->remove($id);
            }
        }

        if ($uri[1] == 'grow') {
            if (!isset(URI[1]) || $_SERVER['REQUEST_METHOD'] === 'GET') {
                return (new Controller\Grow)->render();
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                return (new Controller\Grow)->growAll();
            }
        }
        
        if ($uri[1] == 'harvest') {
            if (!isset(URI[1]) || $_SERVER['REQUEST_METHOD'] === 'GET') {
                return (new Controller\Pick)->render();
            }
            if (URI[1] == 'all' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
                return (new Controller\Pick)->pick();
            }
            if (URI[1] == 'all/type' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
                return (new Controller\Pick)->pick();
            }
            if (URI[1] == 'bush' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
                return (new Controller\Pick)->pick();
            }
            if (URI[1] == 'bush/part' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
                return (new Controller\Pick)->pick();
            }
        }
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