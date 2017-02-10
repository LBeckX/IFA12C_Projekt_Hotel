<?php
/**
* Erstellt von Joachim Hacker am 31.01.17
*/
//Läd die Datei init.script.php
require_once(__DIR__.'\init.script.php');

init();

function bookroom(){
    if(isset($_GET['hotel']) && isset($_GET['startdate']) && isset($_GET['enddate'])){
        $hotelname = $_GET['hotel'];
        $startdate = strtotime($_GET['startdate']);
        $enddate = strtotime($_GET['enddate']);

        //Wenn das Startdatum vor dem heutigen Tag liegt, wird der Vorgang abgebrochen
        if($startdate < time()){
            echo false;
            return false;
        }

        //Wenn das Enddautm nach dem Startdatum liegt, führe die Buchung fort
        if($enddate > $startdate){
            $zimmer= new sqlZimmer();
            $hotel= new sqlHotel();
            $resulthotel=$hotel->selectAllFromTableByName($hotelname);
            $preise= new sqlPreise();
            $gastzimmer= new sqlGastZimmer();

            //Wenn die Hotelliste kein Array ist, wird abgebrochen
            if (!is_array($resulthotel)){
                die($resulthotel);
            }

            //Suche alle Zimmer die zu einem Hotel aus der Hotelliste gehören
            foreach($resulthotel as $hotels){
                $resultzimmer=$zimmer->selectAllFromTableByHotelId(intval($hotels['hotelID']));
                $returnZimmerArray = [];

                //Suche zu allen Hotelzimmern, deren Preiskategorie und überprüfe den Gebuchtstatus
                foreach($resultzimmer as $zimmerauswahl){
                    $preiskategorie=$preise->selectAllFromTableById($zimmerauswahl['preisID']);
                    $gastzimmerbelegt=$gastzimmer->selectAllFromTableByZimmerId($zimmerauswahl['zimmerID']);

                    //Sofern die Preiskategorie nicht leer ist, verknüpfe sie mit dem dazugehörigen Zimmer
                    if(is_array($preiskategorie) && !empty($preiskategorie)){
                        $zimmerauswahl['preiskategorie'] = $preiskategorie;
                    }

                    //Verknüpfe die Zimmerbelegungstabelle mit dem Zimmer nur, wenn es für dieses einen Eintrag gibt
                    if(is_array($gastzimmerbelegt) && !empty($gastzimmerbelegt)){
                        $zimmerauswahl['gastzimmerbelegt'] = $gastzimmerbelegt;
                    }

                    //Wenn es für ein Zimmer einen eintrag in der GastZimmertabelle gibt,
                    //dann geh die Liste mit den Zimmern durch und überprüfe, ob das Zimmer für den gewünschten
                    //Buchungszeitraum frei ist
                    if(isset($zimmerauswahl['gastzimmerbelegt'])){
                        foreach($zimmerauswahl['gastzimmerbelegt'] as $checkRoom){
                            $bookingstartdate = $checkRoom['anreisedatum'];
                            $bookingenddate = $checkRoom['abreisedatum'];

                            if(($startdate < $bookingstartdate && $enddate < $bookingstartdate)
                                || ($startdate > $bookingenddate && $enddate > $bookingenddate)){
                                array_push($returnZimmerArray,$zimmerauswahl);
                            }
                        }
                    } else {
                        array_push($returnZimmerArray,$zimmerauswahl);
                    }
                }
                echo json_encode($returnZimmerArray,JSON_PRETTY_PRINT);
            }
        } else {
            //Sollte das Startdatum des Buchungszeitraumes hinter dem Enddatum des Buchungsraumes liegen, brich den Vorgang ab
            echo "false";
        }
    }
}

bookroom();
initEnd();