/**
 * @author Beck 170201
 */


/**
 * Gibt ein bestimmtes HTML-IMG-Element abhängig vom String zurück
 * @param string
 * @returns {string}
 */
function getImgByKategorie(string) {
    var src = '';
    if(string == 'Standart'){
        src = '/files/img/layout/hotelzimmer_1.jpg';
    } else if(string == 'Premium'){
        src = '/files/img/layout/hotelzimmer_2.jpg';
    } else if(string == 'Luxus'){
        src = '/files/img/layout/hotelzimmer_4.jpg';
    }
    return '<img src="'+src+'" class="zimmerImg">';
}

/**
 * Gibt einen zufälligen dämlack Verkaufspruch zurück :D
 */
function daemlackSpruch() {
    var int = Math.round(Math.random()* (5));

    if(int == 1){
        return 'mit wunderschönem Meerblick';
    } else if(int == 2){
        return 'mit einem 5 min. Weg in die Stadt';
    } else if(int == 3){
        return 'mit eingenem Pool im Bad';
    } else if(int == 4){
        return 'inklusive Massagen und Sauna';
    } else if(int == 4){
        return '5 Fernseher im Zimmer und PS4';
    } else {
        return 'mit Homefeeling';
    }
}