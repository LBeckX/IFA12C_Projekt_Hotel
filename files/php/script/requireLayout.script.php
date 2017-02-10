<?php
/**
 * Läd ein Template aus dem PHP-Layout-Verzeichniss
 * @param $name
 */
function requireLayout($name){
    include __DIR__.'/../inc/layout/'.$name.'.inc.php';
}