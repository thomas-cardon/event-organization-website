<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require 'src/core/AutoLoad.php';

$route = $_GET['route'] ?? null;
View::openBuffer(); // on ouvre le tampon d'affichage, les contrôleurs qui appellent des vues les mettront dedans

try
{
    $O_controleur = new Controller($route);
    $O_controleur->execute();
}
catch (ControllerException $O_exception)
{
    echo ('Une erreur s\'est produite : ' . $O_exception->getMessage());
 }