/**
 * Wartet, bis der Content der Seite fertig geladen hat.
 * Dann suche nach dem Formular mit der ID [#bookingform].
 * Hole DIr aus dem Formular das SELECT-Feld [select[name="hotel"]].
 * Wenn an diesem Feld etwas geändert wird, rufe die Funktion [checkBookingForm()] auf und
 * übergebe Ihr das Formular- und SELECT-Element
 *
 * Wenn das SELECT-Element am Anfang nicht den Wert '-' hat, rufe gleich die Funktion [checkBookingForm()] auf.
 */
$( document ).ready(function() {
    var form = $('#bookingform');
    var formElementSelect = form.find('select[name="hotel"]');

    formElementSelect.change(function () {
        if(formElementSelect.val() !== '-'){
            checkBookingForm(form,formElementSelect);
        }
    });

    if(formElementSelect.val() !== '-'){
        checkBookingForm(form,formElementSelect);
    }
});


/**
 * Übergebe der Funktion das Formular-Objekt und das Formular-Select-Objekt.
 *
 *  Wenn das HTML-Objekt mit der ID [#anfangsdatum] nicht existiert,
 *  Füge dem HTML-Element mit der ID [#inputDate] zwei HTML-Formular-Eingabefelder hinzu.
 *
 *  Suche in dem Formular-Objekt nach den Feldern mit den IDs [#anfangsdatum] und [#enddatum] ggf. erst erstellt (in IF)
 *
 *  Wenn die Felder geändert werden, rufe die Funktion [ajaxForm()] auf und übergebe dieser die Werte von den Eingabefeldern
 *  und des zuvor übergebenen SELECT-Feldes
 *
 * @param form [Formular-Objekt]
 * @param formElementSelect [Formular-Select-Objekt]
 */
function checkBookingForm(form,formElementSelect) {

    if(document.getElementById('anfangsdatum') === null){
        var inputDate = $('#inputDate');
        inputDate.append('<input type="text" id="anfangsdatum" onfocus="(this.type=\'date\')" placeholder="Anfangsdatum" name="anfangsdatum" required>');
        inputDate.append('<input type="text" id="enddatum" onfocus="(this.type=\'date\')" placeholder="Enddatum" name="enddatum" required>');
    }

    var inAnfangsdatum = form.find('#anfangsdatum');
    var inEnddatum = form.find('#enddatum');

    inAnfangsdatum.change(function(){
        ajaxForm(inAnfangsdatum.val(),inEnddatum.val(),formElementSelect.val());
    });
    inEnddatum.change(function () {
        ajaxForm(inAnfangsdatum.val(),inEnddatum.val(),formElementSelect.val());
    });
}


/**
 * Wenn die übergebenen Werte keine leeren Strings sind, rufe die Ajax-Funktion mit der URL
 * [/files/php/script/get.script.php] auf und übergebe dieser URL die Werte [anfangsdatum,enddatum,selHotel]
 * Wenn es einen Rückgabewert gibt, versuche Ihn als JSON zu interpretieren und speicher ihn in die Variable [jsonArray]
 * Andernfalls führe eine [alert]-Funktion aus.
 *
 * Wenn in der Variable [jsonArray] nicht false gespeichert ist, definiere die Variable [fieldsetString] als
 * String.
 * Durchlaufe nun das JSON-Array und fülle die Variable mit den JSON-Parametern und dem HTML-Code
 *
 * Schreibe am Ende des IFs den HTML-Code in die ID [#inputZimmer].
 *
 * Sollte der Variable [jsonArray] ein false zurück gegeben worden sein. Schreibe in das HTML-Element
 * mit der ID [#inputZimmer] eine Fehlermeldung
 *
 * @param anfangsdatum
 * @param enddatum
 * @param selHotel
 */
function ajaxForm(anfangsdatum,enddatum,selHotel){

    if(anfangsdatum != '' && enddatum != ''){

        $.ajax({
            url: "/files/php/script/get.script.php?hotel="+selHotel+'&startdate='+anfangsdatum+'&enddate='+enddatum,
            context: document.body
        }).done(function(value) {
            var jsonArray;
            try{
                jsonArray = JSON.parse(value);
            }catch(e)
            {
                jsonArray = false;
            }

            if(jsonArray !== false){

                var fieldsetString= '<fieldset>';
                for(var i=0;i<jsonArray.length;i++){

                    var zimmer = jsonArray[i];
                    var zimmerID = zimmer.zimmerID;
                    var preisKategorie = zimmer.preiskategorie[0].kategorie;
                    var preis = zimmer.preiskategorie[0].preise;

                    fieldsetString += '' +
                        '<label for="'+i+'_zimmer">'+getImgByKategorie(preisKategorie)+
                        '<div class="descriptionZimmer">'+preisKategorie+'-Zimmer<br>'+daemlackSpruch()+'<br>Preis: '+preis+'€ pro Nacht</div>' +
                        '<input type="radio" id="'+i+'_zimmer" name="selectZimmer" value="'+zimmerID+'">' +
                        '</label>';
                }
                fieldsetString += '</fieldset>' +
                    '<input type="submit" name="bookingSubmit" value="Buchen">';

                $('#inputZimmer').html(fieldsetString);

            } else {
                $('#inputZimmer').html('<div class="error">Bitte kontrollieren Sie Ihre Datumseingabe!</div>')
            }
        });
    }
}