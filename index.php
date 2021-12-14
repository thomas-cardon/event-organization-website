<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require 'src/core/AutoLoad.php';

$S_urlADecortiquer = isset($_GET['route']) ? $_GET['route'] : null;
$A_postParams = isset($_POST) ? $_POST : null;

View::openBuffer(); // on ouvre le tampon d'affichage, les contrôleurs qui appellent des vues les mettront dedans

try
{
    $O_controleur = new Controller($S_urlADecortiquer, $A_postParams);
    $O_controleur->executer();
}
catch (ControllerException $O_exception)
{
    echo ('Une erreur s\'est produite : ' . $O_exception->getMessage());
 }

$contenuPourAffichage = View::getBufferContents();
View::show('_layout/document', array('body' => $contenuPourAffichage));