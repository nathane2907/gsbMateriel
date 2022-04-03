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
    

// DEBUT du contr�leur ajouterMateriel.php

if (count($_POST)==0)
{
  $etape = 1;
}
else
{
  $etape = 2;
  $uneMarque=$_POST["marque"];
  $unModele=$_POST["modele"];
  $uneDimension=$_POST["dimension"];
  $unType=$_POST["type"];
  AjouterMateriel($uneMarque, $unModele ,$uneDimension, $unType, $tabErreurs);
}

// D�but de l'affichage (les vues)

include($repVues."entete.php");
include($repVues."menu.php");
include($repVues."erreur.php");
include($repVues."vAjouterMateriel.php");
include($repVues."pied.php");
?>