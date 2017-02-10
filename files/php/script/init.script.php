<?php
/**
* Erstellt von Lukas Beck am 30.01.2017
*/

function init(){

    //Läd alle wichtigen Dateien, die benötigt werden.
    require_once __DIR__.'/../inc/config/pwd.config.inc.php';
	require_once(__DIR__.'/dataBase.script.php');
	require_once(__DIR__.'/../class/sqlMitarbeiter.class.php');
	require_once(__DIR__.'/../class/sqlHotel.class.php');
	require_once(__DIR__.'/../class/sqlZimmer.class.php');
	require_once(__DIR__.'/../class/sqlPreise.class.php');
	require_once(__DIR__.'/../class/sqlGastZimmer.class.php');
	require_once(__DIR__.'/../class/sqlGast.class.php');
	require_once(__DIR__.'/../class/sqlRechnung.class.php');
	require_once(__DIR__.'/exmpl.script.php');
    require_once(__DIR__.'/functions.script.php');
    require_once(__DIR__.'/requireLayout.script.php');
    require_once(__DIR__.'/set.script.php');
    require_once(__DIR__.'/backup.script.php');

    // Verbindung zur Datenbank wird aufgebaut und die Datenbank und Tabellen werden erstellt.
    connectDataBase(DBHOST,DBUSER);
	createDatabase();
	$mitarbeiter = new sqlMitarbeiter();
	$hotel = new sqlHotel();
	$zimmer = new sqlZimmer();
	$preise = new sqlPreise();
	$gastZimmer = new sqlGastZimmer();
	$gast = new sqlGast();
	$rechung = new sqlRechnung();

}

function initEnd(){
    disconnectDataBase();
}