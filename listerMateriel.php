<?php
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Rechercher"
 * @package default
 * @todo  RAS
 */
 
$repVues = './vues/';
require("./include/_bdGestionDonnees.lib.php");
require("./include/_gestionSession.lib.php");
require("./include/_utilitairesEtGestionErreurs.lib.php");

// d�marrage ou reprise de la session
initSession();

// initialement, aucune erreur ...
$tabErreurs = array();
  

// DEBUT du contr�leur lister.php

$materiel = listerMateriel();
  
  // Construction de la page Rechercher
  // pour l'affichage (appel des vues)
  include($repVues."entete.php") ;
  include($repVues."menu.php") ;
  include($repVues."vListerMateriel.php");
  include($repVues."pied.php") ;
  ?>
    
