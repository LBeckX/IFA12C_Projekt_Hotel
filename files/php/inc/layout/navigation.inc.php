<!--
    Die Navigation von jeder Hauptseite
-->
<?php
function printNavigation(){

    //Definition der Navigation und füllen des Arrays
    $navigation = [
        'Home'=>['/','_self'],
        'Buchen'=>['book.php','_self'],
        'UnitGreen.com'=>['http://games.unitgreen.com/','_blank'],
        'SpaceInvaders123'=>['http://games.unitgreen.com/spaceinvaders123/','_blank']
    ];

    // Fehler abfangen, wenn [$navigation] kein Array ist
    if(!is_array($navigation)){
        die('Can not print navigation');
    }

    //Ausgabe und Formatieren als HTML-Liste
    echo "<ul>";
    foreach ($navigation as $name => $nav){
        echo "<li>";
        echo "<a href='$nav[0]' target='$nav[1]'>$name</a>";
    }
    echo "</ul>";
}
?>

<!-- Navigationsbereich -->
<div id='navigation'>
    <?php printNavigation();?>
</div>
