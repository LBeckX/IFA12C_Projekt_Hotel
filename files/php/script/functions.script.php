<?php
/*
 * @author Beck 170130
 */

/**
 * Gibt einen "sicheren" String zurück
 * @param $string
 * @return mixed
 */
function escapeString($string){
    return str_replace(['\'','\\','/','#','$','"'],'',strip_tags(trim($string)));
}