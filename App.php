<?php
include __DIR__.'/GardenRepository.php';
include __DIR__.'/DBRepository.php';

class App {

    private static GardenRepository $repository;

    public static function begin() {
        session_start();
        // session_destroy();
        if (!isset($repository)) {
            self::$repository = new DBRepository();
        }
    }

    public static function getRepository() {
        return self::$repository;
    }

    public static function planting () {
        // SODINIMO SCENARIJUS
        if (isset($_POST['sodintiAgurka'])) {
            // $id = ++$_SESSION['lastId'];
            $id = self::getRepository()->getNewId();
            // $_SESSION['agurkas'][$id] = new Agurkas($id);
            self::getRepository()->save(new Agurkas($id));
            header('Location: http://localhost:3000/sodinimas.php');
            exit;
        }
        if (isset($_POST['sodintiPomidora'])) {
            $id = self::getRepository()->getNewId();

            // $id = ++$_SESSION['lastId'];
            self::getRepository()->save(new Pomidoras($id));

            // $_SESSION['pomidoras'][$id] = new Pomidoras($id);

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
            // foreach($_SESSION['agurkas'] as $id => $agurkas) {

            //     if ($_POST['rautiAgurka'] == $agurkas->getId()) {
            //         unset($_SESSION['agurkas'][$id]);
            //         header('Location: http://localhost:3000/sodinimas.php');
            //         exit;
            //     }
            // }

        }
        if (isset($_POST['rautiPomidora'])) {
            foreach(self::$repository->getAll() as $id => $pomidoras) {

                if ($_POST['rautiPomidora'] == $pomidoras->getId()) {
                    self::$repository->delete($pomidoras->getId());
                    header('Location: http://localhost:3000/sodinimas.php');
                    exit;
                }
            }

            // foreach($_SESSION['pomidoras'] as $id => $pomidoras) {

            //     if ($_POST['rautiPomidora'] == $pomidoras->getId()) {
            //         unset($_SESSION['pomidoras'][$id]);
            //         header('Location: http://localhost:3000/sodinimas.php');
            //         exit;
            //     }
            // }
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


            // foreach($_SESSION['agurkas'] as $id => &$agurkas) {
            //     $visasKiekis = $agurkas->getKiekis() + $_POST['kiekisAgurku'][$agurkas->getId()];
            //     $agurkas->setKiekis($visasKiekis);
            // }
            header('Location: http://localhost:3000/auginimas.php');
            exit;
        }
        if (isset($_POST['augintiPomidorus'])) {
            foreach(self::$repository->getAll() as $id => &$pomidoras) {
                $visasKiekis = $pomidoras->getKiekis() + $_POST['kiekisPomidoru'][$pomidoras->getId()];
                $pomidoras->setKiekis($visasKiekis);
                self::$repository->update($pomidoras);
            }
            // foreach($_SESSION['pomidoras'] as $id => &$pomidoras) {
            //     $visasKiekis = $pomidoras->getKiekis() + $_POST['kiekisPomidoru'][$pomidoras->getId()];
            //     $pomidoras->setKiekis($visasKiekis);
            // }
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

            // foreach($_SESSION['agurkas'] as $id => &$agurkas) {
            //     $agurkas->setKiekis(0);
            // } 
            // foreach($_SESSION['pomidoras'] as $id => &$pomidoras) {
            //     $pomidoras->setKiekis(0);
            // }
            header('Location: http://localhost:3000/skynimas.php');
            exit;
        }
        foreach(self::$repository->getAll() as $id => &$agurkas) {
            $name = 'skintiAgurku' . $agurkas->getId();
            $nameAll = 'skintiVisusAgurkus' . $agurkas->getId();

            if (isset($_POST[$name])) {
                $likoAgurku = $agurkas->getKiekis() - $_POST['kiekisSkintiAgurku' .$agurkas->getId()];
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
                $likoAPomidoru = $pomidoras->getKiekis() - $_POST['kiekisSkintiPomidoru' .$pomidoras->getId()];
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
        include __DIR__ . '/Currency API/Cache.php';
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