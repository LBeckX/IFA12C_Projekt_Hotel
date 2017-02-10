<!--
    Der Header von den Hauptseiten
-->

<?php
    /*
     * Rufe die Klasse [sqlHotel] auf und speicher das Objekt
     * in der Variable [$hotel]
     */
    $hotel = new sqlHotel();

    /*
     * Ruft die Methode [selectAllFromTableById()] der Klasse [sqlHotel] auf
     * und speicher den Rückgabewert in der Variable [$hotelReturn]
     */
    $hotelReturn = $hotel->selectAllFromTableById();

    /*
     * Durchläuft "if", wenn der Rückgabewert in der Variable [$hotelReturn] ein Array ist
     * andernfalls durchlaufe "else"
     */
    if(is_array($hotelReturn)){

        //Definiert die Variable [$content] als String
        $content = '';

        /*
         * Durchläuft das Array [$hotelReturn] und speichert teporär die Arrayelemente in [$hotelWert]
         */
        foreach ($hotelReturn as $hotelWert){

            /**
             * Fügt an die Varable [$content] das HTML-Element "<option>" das ggf. mit der Variable
             * [$selected] als selected markiert wird um in der Auswahl angezeigt zu werden (Für das Header-Formular)
             */
            $content .= "<option value='{$hotelWert['hotelname']}'>".
                $hotelWert['hotelname'].
                '</option>';
        }
    } else {

        //Wenn [$hotelReturn] kein Array ist, dann übergabe der [$content] ein HTML-Element
        $content = '<option>Es sind keine Hotels angelegt</option>';
    }
?>

<header>
    <div class="inside">
        <div id="overHead">
            <div id="logo">
                <a href="/"><img src="/files/img/layout/logo.png"></a>
            </div>
            <div class="metaNav">
                <ul>
                    <li><a href="/book.php">Jetzt buchen</a></li>
                    <li><a href="/impressumDatenschutz.php">Impressum</a></li>
                </ul>
            </div>
        </div>
        <div id="inhead">
            <div class="img">
                <img src="files/img/layout/hotel_bg_<?php echo rand(1,4)?>.jpg">
            </div>
            <div class="form">
                <h2>Jetzt buchen:</h2>
                <form action="/book.php" method="post">
                    <select name="hotel" size="1" title="hotel" required>
                        <option>Ihr Hotel</option>
                        <?=$content?>
                    </select>
                    <input type="text" onfocus="(this.type='date')" placeholder="Beginn Ihrer Reise" name="datum" required>
                    <input type="submit" value="Buchen">
                </form>
            </div>
        </div>
    </div>
</header>