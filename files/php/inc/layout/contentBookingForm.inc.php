<!--
    Der Content-Bereich von der Buchenseite [book.php]
-->

<?php

    /*
     * Wenn die Übergabewerte ['hotel'] und ['datum'] gesetzt sind,
     * dann fülle die Variablen mit den Werten der Übergabewerte andernfalls
     * fülle sie mit false
    */
    if(isset($_POST['hotel']) && isset($_POST['datum'])){
        $bDatum = escapeString($_POST['datum']);
        $dHotel = escapeString($_POST['hotel']);
    } else {
        $bDatum = false;
        $dHotel = false;
    }

    /*
     * Rufe die Klasse [sqlHotel] auf und speicher das Objekt
     * in der Variable [$hotel]
     */
    $HOTEL = new sqlHotel();

    /*
     * Ruft die Methode [selectAllFromTableById()] der Klasse [sqlHotel] auf
     * und speicher den Rückgabewert in der Variable [$hotelReturn]
     */
    $hotelReturn = $HOTEL->selectAllFromTableById();

    /*
     * Durchläuft "if", wenn der Rückgabewert in der Variable [$hotelReturn] ein Array ist
     * andernfalls durchlaufe "else"
     */
    if(is_array($hotelReturn)){

        //Definiert die Variable [$content] als String
        $content = '';

         //Durchläuft das Array [$hotelReturn] und speichert teporär die Arrayelemente in [$hotelWert]
        foreach ($hotelReturn as $hotelWert){

            /*
             * Wenn der POST-Übergabewert gesetzt und die Variable [$dHotel] nicht false ist, durchlaufe
             * "if". Andernfalls durchlaufe "else"
             */
            if($dHotel !== false){

                /*
                 * Wenn der Wert aus Variable [$dHotel] der Wert von [$hotelWert['hotelname']] ist,
                 * dann definiere die Variable [$selected] mit dem Strin "selected" für das HTML-Element.
                 * Andernfalls definiere die Variable [$selected] als leeren String
                 */
                if($dHotel == $hotelWert['hotelname']){
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
            } else{
                //Definiert die Variable [$selected] als leeren String
                $selected = '';
            }

            /**
             * Fügt an die Varable [$content] das HTML-Element "<option>" das ggf. mit der Variable
             * [$selected] als selected markiert wird um in der Auswahl angezeigt zu werden (Für das Header-Formular)
             */
            $content .= "<option value='{$hotelWert['hotelname']}' $selected>".
                        $hotelWert['hotelname'].
                        '</option>';
        }
    } else {
        /**
         * Wenn [$hotelReturn] kein Array ist, dann übergabe der [$content] ein HTML-Element
         */
        $content = '<option>Es sind keine Hotels angelegt</option>';
    }

    /*
     * Wenn die Variable [$bDatum] nicht false ist, dann definiere die Variable [$inputDate] mit zwei HTML-Input-Elementen.
     * Andernfalls, lasse die Variable [$inputDate] leer.
     */
    if($bDatum !== false){
        $inputDate = '
        <input type="date" id="anfangsdatum" value="'.date("Y-m-d",strtotime($bDatum)).'" name="anfangsdatum" required>
        <input type="text" id="enddatum" onfocus="(this.type=\'date\')" placeholder="Enddatum" name="enddatum" required>
        ';
    } else {
        $inputDate = '';
    }
?>

<div id="content">
    <?php if(!isset($_POST['bookingSubmit'])):?>
    <h1>Jetzt buchen:</h1>
    <p>Buchen Sie hier Ihr Traumzimmer in den schönsten Hotels Europas. Wir bieten Ihnen günstige Preise<br>für extra schöne Zimmer in top Lagen.</p>
    <form id="bookingform" method="post" action="">
        <input type="text" name="nachname" placeholder="Name*" maxlength="29" required>
        <input type="text" name="vorname" placeholder="Vorname*" maxlength="29" required>
        <input type="text" name="email" placeholder="E-Mail*" maxlength="29" required>
        <select name="sex" size="1" title="hotel" required>
            <option value="-">Geschlecht</option>
            <option value="male">Mann</option>
            <option value="female">Frau</option>
        </select>
        <input type="text" id="gebutsdatum" onfocus="(this.type='date')" placeholder="Gebutsdatum" name="gebutsdatum" required>
        <input type="text" name="strasse" placeholder="Straße, Hsnr.*" maxlength="40" required>
        <input type="text" name="plz" placeholder="PLZ*" maxlength="10" required>
        <input type="text" name="ort" placeholder="Ort*" maxlength="30" required>
        <select name="hotel" size="1" title="hotel" required>
            <option value="-">Ihr Hotel</option>
            <?=$content?>
        </select>
        <div id="inputDate">
            <?=$inputDate?>
        </div>
        <div id="inputZimmer">
        </div>
    </form>
    <script src="/files/js/script/booking.script.js" type="text/javascript"></script>
    <noscript><div class="error">Dieses Formular funktioniert nur mit JavaScript. Bitte aktivieren!</div></noscript>
    <?php endif; ?>

    <?php
        if(isset($_POST['bookingSubmit'])){
            setBookingValue();
        }
    ?>


</div>
