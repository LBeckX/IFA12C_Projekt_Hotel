<div id="content">
<?php

//Definiere die Variable [$form] mit dem Login-Formular
$form = "<form action='' method='post'>
    <input type='text' name='username' placeholder='Benutzername'>
    <input type='password' name='password' placeholder='Passwort'>
    <input type='submit' name='submit' value='Login'>
</form>";

/*
 * Wenn die COOKIES [username] und [pwd] gesetzt sind,
 * überprüfe, ob diese COOKIE-Werte mit den Konstanten [USER] und [PWD] übereinstimmen.
 * Wenn die Werte übereinstimme, setzt die Variable [$login] auf true. Andernfalls auf false.
 * Wenn die COOKIES nicht gesetzt sind, setzt die Variable [$login] auch auf false.
 *
 * Die Variable $login wird unten genutzt um die Korrektheit der Logindaten zu prüfen
 */
if(isset($_COOKIE["username"]) && isset($_COOKIE["pwd"])){
    if($_COOKIE["username"] === USER && $_COOKIE["pwd"] === PWD){
        $login = true;
    } else {
        $login = false;
    }
} else {
    $login = false;
}

/*
 * Wenn die Formular-Übergabedaten [$_POST['username']] und [$_POST['password']] nicht gesetzt sind
 * und wenn durch den false-Wert der Variable [$login] der missglückte Login signalisiert wird, wird das Formular
 * aus der Variable [$form] ausgeben.
 */
if((!isset($_POST['username']) && !isset($_POST['password'])) && $login === false){
    echo "Geben Sie hier Ihre Nutzerdaten an: <br>";
    echo $form;
}
/*
 * Wenn die Formular-Übergabedaten [$_POST['username']] und [$_POST['password']] gesetzt sind und
 * wenn durch den false-Wert der Variable [$login] der missglückte Login signalisiert wird,
 * werden die Formular-Übergabedaten mit den Konstanten Werten verglichen und bei Korrektheit
 * werden die COOKIES mit den Übergabedaten und die Variable [$login] auf true gesetzt.
 *
 * Andernfalls wird das Formular und eine Fehlermeldung für flasche Logindaten ausgegeben.
 */
elseif(isset($_POST['username']) && isset($_POST['password']) &&  $login === false){
    $pwd = hash("sha256",escapeString($_POST['password']));

    if($_POST['username'] === USER && $pwd === PWD) {
        setcookie("username", escapeString($_POST['username']), time() + 3600);
        setcookie("pwd", $pwd, time() + 3600);
        $login = true;
    } else {
        $login = false;
        echo $form;
        echo "<br><br>";
        echo "<div class='error'>Falscher Benutzer oder falsches Passwort!</div>";
    }
}

/**
 * Wenn Login auf true ist, wird das Template [contentAdminFormNewData.inc.php] geladen.
 */
if($login){
    requireLayout('contentAdminFormNewData');
}

?>
</div>
