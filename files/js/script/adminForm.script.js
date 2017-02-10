/**
 * Wenn der Content geladen hat,
 * Suche das Element mit der ID [#formArt]
 * Führe die Funktion [returnForm()] aus und übergebe Ihr den Wert von [#formArt].
 *
 * Wenn das Eingabefeld gändert wird, führe wieder die Funktion [returnForm()] aus
 * und übergebe Ihr den Wert von [#formArt].
 */
$(document).ready(function () {
    var formSelect = $('#formArt');
    var returnVal = returnForm(formSelect.val());
    printInElement(returnVal,'#formVariation');

    formSelect.change(function () {
        var returnVal = returnForm(formSelect.val());
        printInElement(returnVal,'#formVariation');
    });
});

/**
 * Gibt aufgund des Übergabewertes ein Formular-String zurück
 * @param value
 * @returns {*}
 */
function returnForm(value) {
    if(value == 'gast'){
        return "" +
            '<input type="text" name="nachname" placeholder="Name*" maxlength="29" required>' +
            '<input type="text" name="vorname" placeholder="Vorname*" maxlength="29" required>' +
            '<input type="text" name="email" placeholder="E-Mail*" maxlength="29" required>' +
            '<select name="sex" size="1" title="hotel" required>' +
                '<option value="-">Geschlecht</option>' +
                '<option value="male">Mann</option>' +
                '<option value="female">Frau</option>' +
            '</select>' +
            '<input type="text" id="gebutsdatum" onfocus="(this.type=\'date\')" placeholder="Gebutsdatum" name="gebutsdatum" required>' +
            '<input type="text" name="strasse" placeholder="Straße, Hsnr.*" maxlength="40" required>' +
            '<input type="text" name="plz" placeholder="PLZ*" maxlength="10" required>' +
            '<input type="text" name="ort" placeholder="Ort*" maxlength="30" required>' +
            '<input type="submit" name="newGast">';
    }
    else if(value == 'mitarbeiter'){
        return '' +
                '<div class="error">NICHT IMPLEMENTIERT!</div>'+
                '<input type="text" name="nachname" placeholder="Nachname">' +
                '<input type="text" name="vorname" placeholder="Vorname">' +
                '<input type="submit" name="newMitarbeiter">';
    }
    else if(value == 'hotel'){
        return ''+
            '<input type="text" name="hotelname" placeholder="Name des Hotels">' +
            '<input type="text" name="ort" placeholder="Ort des Hotels">'+
            '<input type="submit" name="newHotel">';
    }
    else if(value == 'zimmer'){
        return ''+
                '<div class="error">NICHT IMPLEMENTIERT!</div>'+
            '<input type="text" name="zimmernummer" placeholder="Zimmernummer">' +
            '<input type="number" name="hotelid" placeholder="ID des Hotels">' +
            '<input type="number" name="preisid" placeholder="ID des Preises">'+
            '<input type="submit" name="newZimmer">';
    }
    else if(value == 'preise'){
        return ''+
            '<input type="text" name="kategorie" placeholder="Preiskategorie">' +
            '<input type="text" name="zimmerart" placeholder="Art des Zimmers">' +
            '<input type="number" name="preise" placeholder="Der Preis in €">'+
            '<input type="submit" name="newPreis">';
    }
    else if(value == 'rechnung'){
        return ''+
            '<input onclick="location.href = \'admin.php?rechnung=true\';" type="button" name="newRechnung" value="Rechnungen erstellen">';
    }
    else {
        return '<div class="error">Übergebe einen richtigen Wert!</div>';
    }
}

/**
 * Screibt Text bzw. HTML-Elemente in ein HTML-Element
 * @param value (String)
 * @param element (html-element (id,class,name,...))
 */
function printInElement(value,element) {
    $(element).html(value);
}