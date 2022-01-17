<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

const BASE_PATH = '/[insérer url de votre projet]';


/* Vous devez réexécuter initialize.php si vous avez modifié ces deux variables ci-dessous */

/* 
 *  "L’idée d’événement a un coût minimum de points pour être considérée (sinon elle n’apparaitra pas dans la liste des choix du jury, en fin
 *  de campagne)"
 */
const EVENT_MIN_POINTS_REQUIRED = 10000;

/*
 * Ces points seront donnés aux donateurs à chaque début de campagne.
 */
const DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN = 20000;
define('POINTS_WEBSERVICE_URL', BASE_URL . '/webservices/points-bank-rest-api/get.php');