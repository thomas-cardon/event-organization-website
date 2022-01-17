<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

const BASE_PATH = '/[insérer url de votre projet]';

/* 
 *  "L’idée d’événement a un coût minimum de points pour être considérée (sinon elle n’apparaitra pas dans la liste des choix du jury, en fin
 *  de campagne)"
 */
const EVENT_MIN_POINTS_REQUIRED = 10000;

/*
 * Ces points seront donnés aux donateurs à chaque début de campagne.
 */
const DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN = 20000;

/*
 * Si cette variable est définie, elle override la constante DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN
 * et donne la valeur de cette variable divisée par le nombre de donateurs à chacun d'entre eux.
 * /!\ Note: cette variable ne doit pas être définie si vous utilisez la constante DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN
 * /!\ Note: cette variable ne sera pas utilisée si le site peut accéder au webservice de l'enveloppe de points.
 */
const DONOR_POINTS_TO_SHARE = 10000;

/*
 * Si cette variable n'est pas définie, l'enveloppe de points sera calculée
 * en fonction de la constante DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN
 */
const POINTS_WEBSERVICE_URL = BASE_URL . '/webservices/points-bank-rest-api/get.php';