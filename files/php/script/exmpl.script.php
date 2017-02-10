<?php
/**
* Erstellt von Lukas Beck am 30.01.2017
*/
/*
$mitarbeiter = new sqlMitarbeiter();
$hotel = new sqlHotel();
$zimmer = new sqlZimmer();
$preise = new sqlPreise();
$gastZimmer = new sqlGastZimmer();
$gast = new sqlGast();
$rechung = new sqlRechnung();

$mitarbeiter->insertIntoTable('beck','Loggasch',1);
$mitarbeiter->insertIntoTable('hacker','joachim',1);
$mitarbeiter->insertIntoTable('heinz','Ismeinz',2);
$mitarbeiter->insertIntoTable('Gott','Herr',3);
$mitarbeiter->insertIntoTable('Stein','Heinrich',3);

$hotel->insertIntoTable('Green','Berlin');
$hotel->insertIntoTable('HundO','Erlangen');
$hotel->insertIntoTable('Hugggo','Nuernberg');
$hotel->insertIntoTable('Eston','St. Martin');

$preise->insertIntoTable('Standart','Einzelzimmer','50');
$preise->insertIntoTable('Premium','Einzelzimmer','100');
$preise->insertIntoTable('Luxus','Einzelzimmer','150');
$preise->insertIntoTable('Standart','Doppelzimmer','75');
$preise->insertIntoTable('Premium','Doppelzimmer','150');
$preise->insertIntoTable('Luxus','Doppelzimmer','225');

$zimmer->insertIntoTable('0123',1,1);
$zimmer->insertIntoTable('0124',2,1);
$zimmer->insertIntoTable('0125',3,1);
$zimmer->insertIntoTable('0126',1,1);
$zimmer->insertIntoTable('0127',2,1);
$zimmer->insertIntoTable('0128',3,1);
$zimmer->insertIntoTable('0129',4,1);
$zimmer->insertIntoTable('0130',1,2);
$zimmer->insertIntoTable('0131',2,2);
$zimmer->insertIntoTable('0132',3,2);
$zimmer->insertIntoTable('0133',4,2);
$zimmer->insertIntoTable('0134',1,2);
$zimmer->insertIntoTable('0135',2,2);
$zimmer->insertIntoTable('0136',4,2);
$zimmer->insertIntoTable('0137',3,1);

$zimmer->insertIntoTable('0138',1,3);
$zimmer->insertIntoTable('0139',2,3);
$zimmer->insertIntoTable('0140',3,3);
$zimmer->insertIntoTable('0141',1,3);
$zimmer->insertIntoTable('0142',2,3);
$zimmer->insertIntoTable('0143',3,3);
$zimmer->insertIntoTable('0144',4,3);
$zimmer->insertIntoTable('0145',1,3);
$zimmer->insertIntoTable('0146',2,4);
$zimmer->insertIntoTable('0147',3,4);
$zimmer->insertIntoTable('0148',4,4);
$zimmer->insertIntoTable('0149',1,4);
$zimmer->insertIntoTable('0150',2,4);
$zimmer->insertIntoTable('0151',4,4);
$zimmer->insertIntoTable('0152',3,4);

$zimmer->insertIntoTable('0153',1,3);
$zimmer->insertIntoTable('0154',2,3);
$zimmer->insertIntoTable('0155',3,3);
$zimmer->insertIntoTable('0156',1,3);
$zimmer->insertIntoTable('0157',2,3);
$zimmer->insertIntoTable('0158',3,3);
$zimmer->insertIntoTable('0159',4,3);
$zimmer->insertIntoTable('0160',1,3);
$zimmer->insertIntoTable('0161',2,4);
$zimmer->insertIntoTable('0162',3,4);
$zimmer->insertIntoTable('0163',4,4);
$zimmer->insertIntoTable('0164',1,4);
$zimmer->insertIntoTable('0165',2,4);
$zimmer->insertIntoTable('0166',4,4);
$zimmer->insertIntoTable('0167',3,4);

$zimmer->insertIntoTable('0168',1,5);
$zimmer->insertIntoTable('0169',2,5);
$zimmer->insertIntoTable('0170',3,5);
$zimmer->insertIntoTable('0171',1,5);
$zimmer->insertIntoTable('0172',2,5);
$zimmer->insertIntoTable('0173',3,5);
$zimmer->insertIntoTable('0174',4,5);
$zimmer->insertIntoTable('0175',1,6);
$zimmer->insertIntoTable('0176',2,6);
$zimmer->insertIntoTable('0177',3,6);
$zimmer->insertIntoTable('0178',4,6);
$zimmer->insertIntoTable('0179',1,6);
$zimmer->insertIntoTable('0180',2,6);
$zimmer->insertIntoTable('0181',4,6);
$zimmer->insertIntoTable('0182',3,6);

$gast->insertIntoTable('schmidt','herbert','male',strtotime('1960-01-10'),'nein','blumenstraße 4','gartenhausen',91827,'gg@bla.de');
$gast->insertIntoTable('meier','hans','male',strtotime('1970-03-10'),'nein','sandkastenstraße 4','gartenhausen',91827,'blabla@dd.de');
$gast->insertIntoTable('huber','isabell','female',strtotime('1980-05-10'),'ja','teichstraße 4','gartenhausen',91827,'hubaBuba@123.de');
$gast->insertIntoTable('müller','günter','male',strtotime('1990-07-10'),'nein','baumstraße 4','gartenhausen',91827,'1234@web.de');
$gast->insertIntoTable('mayer','isolde','female',strtotime('2000-09-10'),'nein','buschstraße 4','gartenhausen',91827,'mitster@rr.de');


$gastZimmer->insertIntoTable(1,2,strtotime('2017-01-10'), strtotime('2017-03-10'));
$gastZimmer->insertIntoTable(3,6,strtotime('2017-02-10'), strtotime('2017-02-12'));
$gastZimmer->insertIntoTable(5,10,strtotime('2017-11-10'), strtotime('2017-12-01'));

$gastZimmer->insertIntoTable(1,2,strtotime('2017-04-10'), strtotime('2017-06-10'));
$gastZimmer->insertIntoTable(3,6,strtotime('2019-03-10'), strtotime('2019-03-12'));
$gastZimmer->insertIntoTable(5,10,strtotime('2017-12-10'), strtotime('2017-12-13'));

$gastZimmer->insertIntoTable(1,2,strtotime('2020-07-10'), strtotime('2020-09-10'));
$gastZimmer->insertIntoTable(3,6,strtotime('2017-05-10'), strtotime('2017-07-12'));
$gastZimmer->insertIntoTable(5,10,strtotime('2018-11-10'), strtotime('2018-12-01'));
*/