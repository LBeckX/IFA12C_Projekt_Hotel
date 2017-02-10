<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'\files\php\script\init.script.php');

init();
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    requireLayout('header');
    ?>
</head>
<body>
<?php
requireLayout('contentHeader');
?>
<?php
requireLayout('navigation');
?>
<?php
requireLayout('contentBookingForm');
?>
<footer>
    <div class="inside">
        <?php
        requireLayout('footer');
        ?>
    </div>
</footer>
</body>
</html>
<?php
initEnd();
?>