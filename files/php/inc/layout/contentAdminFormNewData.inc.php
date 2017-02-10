
<?php if(!isset($_GET['rechnung'])): ?>
<h1>Neue Daten eintragen:</h1>
<form action="" method="post">
<select name="formArt" size="1" title="formArt" id="formArt">
    <option value="gast" selected>Gast</option>
    <option value="mitarbeiter">Mitarbeiter</option>
    <option value="hotel">Hotel</option>
    <option value="zimmer">Zimmer</option>
    <option value="preise">Preise</option>
    <option value="rechnung">Rechnung</option>
</select>
</form>
<br><br>
<h1>Das Formular</h1>
<form id="realForm" action="" method="post">
<div id="formVariation">

</div>
</form>
<script src="/files/js/script/adminForm.script.js" type="text/javascript"></script>
<?php
checkAdminForm();
endif;
?>

<?php if(isset($_GET['rechnung'])):?>
    <?php waehleRechung();?>
<?php endif;?>

<?php if(isset($_GET['rechnung']) && isset($_POST[''])): ?>
    <?php printRechnung();?>
<?php endif;?>
