<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

const BASE_PATH = '/[insérer url de votre projet]';

/* "L’idée d’événement a un coût minimum de
points pour être considérée (sinon elle n’apparaitra pas dans la liste des choix du jury, en fin
de campagne)" */
const EVENT_MIN_POINTS_REQUIRED = 10000;
const  DONOR_POINTS_GIVEN_FOR_EACH_CAMPAIGN = 500;