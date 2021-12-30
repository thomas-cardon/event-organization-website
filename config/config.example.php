<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

define('BASE_PATH', '/[insérer url de votre projet]');

/* "L’idée d’événement a un coût minimum de
points pour être considérée (sinon elle n’apparaitra pas dans la liste des choix du jury, en fin
de campagne)" */
define('EVENT_MIN_POINTS_REQUIRED', 1000);