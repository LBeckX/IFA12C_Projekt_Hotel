<?php

/**
 * Diese Funktion wird aufgerufen, nachdem ein Gast das Buchen-Formular nutzt (/book.php)
 *
 * Punkt1:
 * Es wir überprüft, ob alle Felder ausgefüllt und vorhabden sind.
 * Andernfalls wird ein Fehler ausgegeben und die Funktion wird mit false abgebrochen.
 *
 * Punkt2:
 * Es werden alle Daten in Variablen gespeichert und html-Tags sowie einige Sonderzeichen durch die Funktion
 * [escapeString()] entfernt
 *
 * Punkt3:
 * Die Klasse [sqlGast()] wird initialisiert und die Methode [selectAllFromTableByEmail()] aufgerufen um den ausfüllenden
 * Gast zurückzugegeben.
 *
 * Punkt4:
 * Die Methode [sqlGastZimmer()] wird initialisiert.
 *
 * Punkt5:
 * Wenn der ausfüllende Gast noch nicht angelegt ist
 *
 * Punkt6:
 * Der ausführende Gast wird anelegt
 *
 * Punkt7:
 * Der ausführende Gast wird in der DB gesucht und als Array zurückgegeben
 *
 * Punk8:
 * Die Buchung wird in die Datenbank geschrieben
 *
 * Punk9:
 * Es wird eine Info für den erfolgreichen Eintrag der Buchung ausgegeben.
 *
 * Punkt10:
 * Wenn der ausführende Gast bereits existiert...
 *
 * Punkt11:
 *
 * @author Beck 170201
 * @return bool
 */
function setBookingValue(){
    // *Punkt1
    if(!isset($_POST['nachname']) ||
        !isset($_POST['vorname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['sex']) ||
        $_POST['sex'] == '-' ||
        !isset($_POST['gebutsdatum']) ||
        !isset($_POST['strasse']) ||
        !isset($_POST['plz']) ||
        !isset($_POST['ort']) ||
        !isset($_POST['hotel']) ||
        !isset($_POST['hotel']) ||
        !isset($_POST['anfangsdatum']) ||
        !isset($_POST['enddatum']) ||
        !isset($_POST['selectZimmer'])){
        echo "<div class='error'>Sie haben ein Feld nicht ausgefüllt!</div>";
        return false;
    }

    // *Punkt2
    $nachname = escapeString($_POST['nachname']);
    $vorname = escapeString($_POST['vorname']);
    $email= escapeString($_POST['email']);
    $sex = escapeString($_POST['sex']);
    $gebutsdatum = strtotime(escapeString($_POST['gebutsdatum']));
    $strasse = escapeString($_POST['strasse']);
    $plz = escapeString($_POST['plz']);
    $ort = escapeString($_POST['ort']);
    $anfangsdatum = strtotime(escapeString($_POST['anfangsdatum']));
    $enddatum = strtotime(escapeString($_POST['enddatum']));
    $selectZimmer = intval(escapeString($_POST['selectZimmer']));

    // *Punkt3
    $GAST = new sqlGast();
    $gast = $GAST->selectAllFromTableByEmail($email);

    // *Punkt4
    $GASTZIMMER = new sqlGastZimmer();

    // *Punkt5
    if(!$gast){
        // *Punkt6
        if(!$GAST->insertIntoTable($nachname,$vorname,$sex,$gebutsdatum,1,$strasse,$plz,$ort,$email)){
            echo "<div class='error'>Es ist ein Fehler passiert! Bitte versuchen Sie es erneut! - Nicht angelegt</div>";
            return false;
        }

        // *Punkt7
        if(!$gast = $GAST->selectAllFromTableByEmail($email)){
            echo "<div class='error'>Es ist ein Fehler passiert! Bitte versuchen Sie es erneut! - Nicht gefunden</div>";
            return false;
        }

        // *Punkt8
        if(!$GASTZIMMER->insertIntoTable($gast['gastID'],$selectZimmer,$anfangsdatum,$enddatum)){
            echo "<div class='error'>Es ist ein Fehler passiert! Bitte versuchen Sie es erneut! - Buchung</div>";
            return false;
        }

        // *Punkt9
        echo "<div class='info'>Vielen Dank,<br>Ihre Bestellung wurde aufgenommen. - Neu</div>";
        return true;

    }
    // *Punkt10
    else {
        // *Punkt11
        if(!$GAST->updateStammgastByEmail($email)){
            echo "<div class='error'>Es ist ein Fehler passiert! Bitte versuchen Sie es erneut!</div>";
            return false;
        }

        // *Punkt8
        if(!$GASTZIMMER->insertIntoTable($gast['gastID'],$selectZimmer,$anfangsdatum,$enddatum)){
            echo "<div class='error'>Es ist ein Fehler passiert! Bitte versuchen Sie es erneut!</div>";
            return false;
        }

        // *Punkt9
        echo "<div class='info'>Vielen Dank,<br>Ihre Bestellung wurde aufgenommen. - Update</div>";
        return true;
    }
}

/**
 * @return bool|string
 */
function checkAdminForm(){

    if(isset($_POST['newGast'])){
        if(!isset($_POST['nachname']) ||
            !isset($_POST['vorname']) ||
            !isset($_POST['email']) ||
            !isset($_POST['sex']) ||
            $_POST['sex'] == '-' ||
            !isset($_POST['gebutsdatum']) ||
            !isset($_POST['strasse']) ||
            !isset($_POST['plz']) ||
            !isset($_POST['ort'])){
            echo "<div class='error'>Sie haben ein Feld nicht ausgefüllt!</div>";
            return false;
        }

        $nachname = escapeString($_POST['nachname']);
        $vorname = escapeString($_POST['vorname']);
        $email= escapeString($_POST['email']);
        $sex = escapeString($_POST['sex']);
        $gebutsdatum = strtotime(escapeString($_POST['gebutsdatum']));
        $strasse = escapeString($_POST['strasse']);
        $plz = escapeString($_POST['plz']);
        $ort = escapeString($_POST['ort']);

        $GAST = new sqlGast();
        if(!$GAST->insertIntoTable($nachname,$vorname,$sex,$gebutsdatum,0,$strasse,$plz,$ort,$email)){
            echo "<div class='error'>Es ist ein Fehler passiert!</div>";
            return false;
        } else {
            echo "<div class='info'>Gast wurde eingetragen.</div>";
            return true;
        }
    }
    elseif(isset($_POST['newHotel'])){
        if(!isset($_POST['hotelname']) ||
            !isset($_POST['ort'])){
            echo "<div class='error'>Sie haben ein Feld nicht ausgefüllt!</div>";
            return false;
        }
        $hotelName = escapeString($_POST['hotelname']);
        $hotelOrt = escapeString($_POST['ort']);
        $HOTEL = new sqlHotel();
        if(!$HOTEL->insertIntoTable($hotelName,$hotelOrt)){
            echo "<div class='error'>Es ist ein Fehler passiert!</div>";
            return false;
        } else {
            echo "<div class='info'>Hotel wurde eingetragen.</div>";
            return true;
        }
    }
    elseif(isset($_POST['newPreis'])){
        if(!isset($_POST['kategorie']) ||
            !isset($_POST['zimmerart']) ||
            !isset($_POST['preise'])){
            echo "<div class='error'>Sie haben ein Feld nicht ausgefüllt!</div>";
            return false;
        }

        $preisKategorie = escapeString($_POST['kategorie']);
        $zimmerArt = escapeString($_POST['zimmerart']);
        $preis = escapeString($_POST['preise']);

        $PREISE = new sqlPreise();
        if(!$PREISE->insertIntoTable($preisKategorie,$zimmerArt,$preis)){
            echo "<div class='error'>Es ist ein Fehler passiert!</div>";
            return false;
        } else {
            echo "<div class='info'>Preis wurde eingetragen.</div>";
            return true;
        }
    } else {
        return 'No Post';
    }
}

function waehleRechung(){
    if(!isset($_POST['rechnungGastSelect'])){
        $GAST = new sqlGast();
        $alleGaeste = $GAST->selectAllFromTableById();
        $contentString = '<form action="/admin.php?rechnung=true" method="post"><fieldset>';
        foreach ($alleGaeste as $gast){
            $contentString .= "<label for='".$gast['gastID']."_gast'>";
            $contentString .= "<div class='gastinfo'>".$gast['vorname']." ".$gast['nachname']."<br>E-Mail:".$gast['email']."</div>";
            $contentString .= "<input type='radio' id='".$gast['gastID']."_gast' name='gastId' value='".$gast['gastID']."'>";
            $contentString .= "</label>";
        }
        $contentString .= "<input type='submit' name='rechnungGastSelect'>";
        $contentString .= '</fieldset></form>';
        echo $contentString;
    } else {

        if(!isset($_POST['gastId'])){
            echo "<div class='error'>Bitte geben Sie richtige Daten ein.</div>";
            return false;
        }

        $gastID = escapeString($_POST['gastId']);

        $GASTZIMMER = new sqlGastZimmer();
        $alleGaesteZimmer = $GASTZIMMER->selectAllFromTableByGastId($gastID);

        $ZIMMER = new sqlZimmer();
        $HOTEL = new sqlHotel();
        $PREIS = new sqlPreise();
        $GAST = new sqlGast();
        $gast = $GAST->selectAllFromTableById($gastID);

        if(intval($gast[0]['stammgast']) >= SPEZIAL_GAST){
            $stammgast = 'ja';
        } else {
            $stammgast = 'nein';
        }

        $contentString = '';

        foreach ($alleGaesteZimmer as $gZ){

            $zimmer = $ZIMMER->selectAllFromTableById($gZ['zimmerID']);
            $hotel = $HOTEL->selectAllFromTableById($zimmer[0]['hotelID']);
            $preis = $PREIS->selectAllFromTableById($zimmer[0]['preisID']);

            if($stammgast == 'ja'){
                $preis[0]['preise'] = intval($preis[0]['preise'])*0.75;
            }

            $nachtAnzahl = (intval($gZ['abreisedatum'])-intval($gZ['anreisedatum']))/(24*3600);

            $contentString .= '<form action="/admin.php?rechnung=true" method="post"><fieldset>';
            $contentString .= "<label for='".$gZ['gastzimmerID']."_gz'><div class='gastinfo'>";
            $contentString .= "Name Kunde: ".$gast[0]['nachname']."<br>";
            $contentString .= "Vorname Kunde: ".$gast[0]['vorname']."<br>";
            $contentString .= "E-Mail: ".$gast[0]['email']."<br>";
            $contentString .= "Beginn: ".date("d.m.Y",$gZ['anreisedatum'])."<br>";
            $contentString .= "Ende: ".date("d.m.Y",$gZ['abreisedatum'])."<br>";
            $contentString .= "Anzahl Nächte: ".$nachtAnzahl."<br>";
            $contentString .= "Hotel: ".$hotel[0]['hotelname']." - In: ".$hotel[0]['hotelort']."<br>";
            $contentString .= "Zimmerart: ".$preis[0]['zimmerart']."<br>";
            $contentString .= "Zimmerkategorie: ".$preis[0]['kategorie']."<br>";
            $contentString .= "Stammkunde: ".$stammgast."<br>";
            $contentString .= "Preis:".$preis[0]['preise']."€ pro Nacht<br>";
            $contentString .= "Gesamtpreis:".$nachtAnzahl*$preis[0]['preise']."€<br>";
            $contentString .= "</div><input id='".$gZ['gastzimmerID']."_gz' type='radio' name='geasteZimmer' value='".$gZ['gastzimmerID']."'>";
            $contentString .= "</label>";
            $contentString .= '</fieldset>';
            $contentString .= '<input type="hidden" name="gastName" value="'.$gast[0]['nachname'].'">';
            $contentString .= '<input type="submit" class="print" name="rechnungerstellen" value="Erstellen"></form>';
        }

        echo $contentString;
        return true;
    }
}

function printRechnung(){
    if(!isset($_POST['geasteZimmer'])){
        echo "<div class='error'>Bitte geben Sie richtige Daten ein.</div>";
        return false;
    }

    $gastID = escapeString($_POST['gastId']);

    $GASTZIMMER = new sqlGastZimmer();
    $alleGaesteZimmer = $GASTZIMMER->selectAllFromTableByGastId($gastID);

    $ZIMMER = new sqlZimmer();
    $HOTEL = new sqlHotel();
    $PREIS = new sqlPreise();
    $GAST = new sqlGast();
    $gast = $GAST->selectAllFromTableById($gastID);


}