<?php
/**
 * Ein paar Datenbankfunktionen
 * @author Hacker 170131
 * @author Beck 170201
 */

/**
 * Baut eine Verbindung zur Datenbank auf
 * @param $dbHost
 * @param $dbUser
 * @param string $dbPwd
 * @param string $dbName
 */
function connectDataBase($dbHost,$dbUser,$dbPwd = '',$dbName = ''){
    $GLOBALS['mysql'] = new mysqli($dbHost, $dbUser, $dbPwd, $dbName);
    if ($GLOBALS['mysql']->connect_error) {
        die("Connection failed: " . $GLOBALS['mysql']->connect_error);
    }
}

/**
 * Schließt die Verbindung zu Datenbank
 */
function disconnectDataBase(){
    $GLOBALS['mysql']->close();
}

/**
 * Erstellt die Datenbank
 * @param string $dataBase
 * @return bool
 */
function createDatabase($dataBase = 'hotel'){
    // Verbindung überprüfen
    if ($GLOBALS['mysql']->connect_error) {
        printf("Verbindung fehlgeschlagen: %s\n", $GLOBALS['mysql']->connect_error);
        return false;
    } else {
        // SQL-Befehl
        $sql_befehl = "CREATE DATABASE IF NOT EXISTS `$dataBase`";

        if (!$GLOBALS['mysql']->query($sql_befehl)) {
            // Meldung bei Fehlschlag
            echo "Datenbank konnte nicht angelegt werden!";
            return false;
        }
        $GLOBALS['mysql']->select_db ($dataBase);
        return true;
    }
}
