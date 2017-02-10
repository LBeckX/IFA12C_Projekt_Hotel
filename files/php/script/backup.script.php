<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 02.02.2017
 * Time: 09:48
 */

require_once(__DIR__ . '\init.script.php');

function writeDate(){
    $checkdate= __DIR__ . '\..\..\Database_Backup\timestamp.txt';
    if(!$checkdate){
        touch($checkdate);
    }
    //$inhalt=file_get_contents($checkdate);
    $inhalt=time();
    file_put_contents($checkdate, $inhalt);
}
function createBackup($backupfilepath){
    include_once(__DIR__ . '\..\class\mysqldump-class\src\Ifsnop\Mysqldump\Mysqldump.php');
    $dump = new Ifsnop\Mysqldump\Mysqldump("mysql:host=".DBHOST.";dbname=hotel",DBUSER, DBPWD);
    $dump->start($backupfilepath);
    writeDate();
}

function createBackupFolder($checkdate){
    $day=24*3600;
    $lasttime=intval(file_get_contents($checkdate));
    $now=time();
    $timeforbackup=$lasttime+$day;
    $month=date("ym");
    $date=date("j");
    $folderpathmonth=__DIR__.'\\..\..\Database_Backup\\'.$month;
    $folderpathday=$folderpathmonth."\\".$date;
    if($timeforbackup<=$now){
        if(!file_exists($folderpathmonth)){
            mkdir($folderpathmonth);
        }
        if(!file_exists($folderpathday)){
            mkdir($folderpathday);
        }
        $backupfilepath=$folderpathday.'\\hotel_backup_'.date('m-d-Y').'.sql';
        createBackup($backupfilepath);
    }
}
init();
$checkdate= __DIR__ . '\..\..\Database_Backup\timestamp.txt';
createBackupFolder($checkdate);
initEnd();