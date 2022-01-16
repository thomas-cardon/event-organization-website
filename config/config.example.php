<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

define('BASE_PATH', '/[insérer url de votre projet]');

/* "L’idée d’événement a un coût minimum de
points pour être considérée (sinon elle n’apparaitra pas dans la liste des choix du jury, en fin
de campagne)" */
define('EVENT_MIN_POINTS_REQUIRED', 1000);

/*
 * Donne x points à un donateur au début de chaque campagne
 */
define('DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN', 3000);

/*
 * Donne x points à un donateur lorsqu'il s'inscrit
 */
define('DONOR_POINTS_GIVEN_AT_REGISTRATION', 10000);

/*
 * Passe outre la règle au dessus, et répartit les points donné par l'API REST entre les donateurs
*/
define('POINTS_WEBSERVICE_URL', BASE_URL . '/webservices/points-bank-rest-api/get.php');