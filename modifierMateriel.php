<?php
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Ajouter"
 * @package default
 * @todo  RAS
 */
 
 
// Initialise les ressources n�cessaires au fonctionnement de l'application

  $repVues = './vues/';
  require("./include/_bdGestionDonnees.lib.php");
  require("./include/_gestionSession.lib.php");
  require("./include/_utilitairesEtGestionErreurs.lib.php");
  // d�marrage ou reprise de la session
  initSession();
  // initialement, aucune erreur ...
  $tabErreurs = array();

// DEBUT du contr�leur rechercher.php 

if (count($_POST)==0)
{
    $etape = 1;
}
else
{
    $etape = 2;
    $unId=$_POST['Id'];
    $uneMarque=$_POST['Marque'];
    $unModele=$_POST["Modele"];
    $uneDimension=$_POST["Dimension"];
    $unType=$_POST["Type"];
    modifierMateriel($unId,$uneMarque,$unModele,$uneDimension,$unType,$tabErreurs);
    // Message de r�ussite pour l'affichage
    if (nbErreurs($tabErreurs)==0)
    {
      $reussite = 1;
      $messageActionOk = "Le materiel a été correctement modifié";
    }
  
}


// D�but de l'affichage (les vues)
include($repVues."entete.php") ;
include($repVues."menu.php") ;
include($repVues ."erreur.php");

if($etape==1)
{
   include($repVues."vModifierMateriel.php");
}
include($repVues."pied.php") ;
?>