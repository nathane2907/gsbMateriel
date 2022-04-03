<?php

// MODIFs A FAIRE
// Ajouter en t�tes 
// Voir : jeu de caract�res � la connection

/** 
 * Se connecte au serveur de donn�es                     
 * Se connecte au serveur de donn�es � partir de valeurs
 * pr�d�finies de connexion (h�te, compte utilisateur et mot de passe). 
 * Retourne l'identifiant de connexion si succ�s obtenu, le bool�en false 
 * si probl�me de connexion.
 * @return resource identifiant de connexion
 */
function connecterServeurBD()
{
  $PARAM_hote = 'localhost'; // le chemin vers le serveur
  $PARAM_port = '3306';
  $PARAM_nom_bd = 'materiel'; // le nom de votre base de donn�es
  $PARAM_utilisateur = 'root'; // nom d'utilisateur pour se connecter
  $PARAM_mot_passe = ''; // mot de passe de l'utilisateur pour se connecter
  $connect = new PDO('mysql:host=' . $PARAM_hote . ';port=' . $PARAM_port . ';dbname=' . $PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
  return $connect;

  //$hote = "localhost";
  // $login = "root";
  // $mdp = "";
  // return mysql_connect($hote, $login, $mdp);
}


/** 
 * Ferme la connexion au serveur de donn�es.
 * Ferme la connexion au serveur de donn�es identifi�e par l'identifiant de 
 * connexion $idCnx.
 * @param resource $idCnx identifiant de connexion
 * @return void  
 */

function listerMateriel()
{
  $connexion = connecterServeurBD();

  $requete = "select * from materiel";
  $jeuResultat = $connexion->query($requete);

  $i = 0;
  $ligne = $jeuResultat->fetch();
  while ($ligne) {
    $visiteur[$i]['Id'] = $ligne['Id'];
    $visiteur[$i]['Marque'] = $ligne['Marque'];
    $visiteur[$i]['Modele'] = $ligne['Modele'];
    $visiteur[$i]['Dimension'] = $ligne['Dimension'];
    $visiteur[$i]['Type'] = $ligne['Type'];
    $ligne = $jeuResultat->fetch();
    $i = $i + 1;
  }
  $jeuResultat->closeCursor();   // fermer le jeu de résultats
  // deconnecterServeurBD($idConnexion);
  return $visiteur;
}

function listerVisiteur()
{
  $connexion = connecterServeurBD();

  $requete = "select vis_matricule, vis_nom, vis_prenom, vis_mail, vis_cp from visiteur";
  $jeuResultat = $connexion->query($requete);

  $i = 0;
  $ligne = $jeuResultat->fetch();
  while ($ligne) 
  {
    $visiteur[$i]['vis_matricule'] = $ligne['vis_matricule'];
    $visiteur[$i]['vis_nom'] = $ligne['vis_nom'];
    $visiteur[$i]['vis_prenom'] = $ligne['vis_prenom'];
    $visiteur[$i]['vis_mail'] = $ligne['vis_mail'];
    $visiteur[$i]['vis_cp'] = $ligne['vis_cp'];
    $ligne = $jeuResultat->fetch();
    $i = $i + 1;
  }
  $jeuResultat->closeCursor();   // fermer le jeu de résultats
  // deconnecterServeurBD($idConnexion);
  return $visiteur;
}

function inscription($unMat, $unMdp, $unMdpConf, $unNom, $unPrenom, $unMail, &$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
  if( $unPrenom ==""|| $unMat ==""|| $unMdp ==""|| $unMail ==""|| $unMdpConf =="")
  {
    $message = "Vous n'avez pas complété le formulaire";
    ajouterErreur($tabErr, $message);
  }
  else
  {   
    if ($unMdp != $unMdpConf) {
      $message = "Les deux mots de passe sont différents";
      ajouterErreur($tabErr, $message);
    } 
    else 
    {
      $verifMat = $connexion->query(" select vis_matricule from visiteur where vis_matricule='" . $unMat . "';");
      $visiteur = $verifMat->fetch();
      $verifMail = $connexion->query(" select vis_mail from visiteur where vis_mail='" . $unMail . "';");
      $visiteur2 = $verifMail->fetch();
      if ($visiteur || $visiteur2) //existe 
      {
        if ($visiteur) {
          $message = "Le matricule est déjà utilisé pour un autre visiteur";
          ajouterErreur($tabErr, $message);
        }
        if ($visiteur2) {
          $message = "Le mail est déjà utilisé pour un autre visiteur";
          ajouterErreur($tabErr, $message);
        }
      } else 
      {
        // Cr�er la requ�te d'ajout 
        $requete = "insert into visiteur"
        . "(vis_matricule,vis_mdp,vis_nom,vis_prenom,vis_mail,rôle) values ('"
        . $unMat . "','"
        . $unMdp . "','"
        . $unNom . "','"
        . $unPrenom . "','"
        . $unMail . "','Visiteur');";
        
        // Lancer la requ�te d'ajout 
        $ok = $connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
        
        // Si la requ�te a r�ussi
        if ($ok) {
          $message = "Vous vous êtes bien inscrit";
          ajouterErreur($tabErr, $message);
        } else {
          $message = "L'inscription a échouée";
          ajouterErreur($tabErr, $message);
        }
      }
    }
  }
}
function AjouterMateriel($uneMarque, $unModele, $uneDimension, $unType, &$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
    
  // Créer la requête d'ajout 
  $requete="insert into materiel"
  ."(Marque, Modele, Dimension, Type) values ('"
  .$uneMarque."','"
  .$unModele."',"
  .$uneDimension.",'"
  .$unType."');";
  
  // Lancer la requête d'ajout 
  $ok=$connexion->query($requete);
  
  // Si la requête a réussi
  if ($ok)
  {
    $message = "Le matériel a été correctement ajouté";
    ajouterErreur($tabErr, $message);
    }
  else
  {
    $message = "Attention, l'ajout du matériel a échoué !!!";
    ajouterErreur($tabErr, $message);
  } 

}
function AjouterVisiteur($unMat, $unNom, $unPrenom, $unMail,$unCode,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
    
  // Créer la requête d'ajout 
  $requete="insert into visiteur"
  ."(VIS_MATRICULE,VIS_NOM,VIS_PRENOM,VIS_MAIL,VIS_CP) values ('"
  .$unMat."','"
  .$unNom."','"
  .$unPrenom."','"
  .$unMail."',"
  .$unCode.");";
  
  // Lancer la requête d'ajout 
  if($unCode<100000){
  $ok=$connexion->query($requete);
  
  // Si la requête a réussi
  if ($ok)
  {
    $message = "Le visiteur a été correctement ajouté";
    ajouterErreur($tabErr, $message);
    }
  else
  {
    $message = "Attention, l'ajout du visiteur a échoué !!!";
    ajouterErreur($tabErr, $message);
  } 
}
else{
  $message = "Attention, le code postal n'est pas valable";
  ajouterErreur($tabErr, $message);
}
}
function supprimerMateriel($unId, &$tabErr)
{
  $connexion = connecterServeurBD();

  $verif = $connexion->query(" select Id from materiel where Id='" . $unId . "';");
  $materiel = $verif->fetch();
  if ($materiel) //existe 
  {
    $requete = "delete from materiel";
    $requete = $requete . " where Id='" . $unId . "';";

    // Lancer la requête supprimer
    $ok = $connexion->query($requete);

    // Si la requête a réussi
    if ($ok) {
      $message = "Le materiel a été correctement supprimé";
      ajouterErreur($tabErr, $message);
    } else {
      $message = "Attention, la suppression du materiel a échoué !";
      ajouterErreur($tabErr, $message);
    }
  } else // n'existe pas
  {
    $message = "Le materiel n'existe pas";
    ajouterErreur($tabErr, $message);
  }
}


function supprimerVisiteur($mat, &$tabErr)
{
  $connexion = connecterServeurBD();

  $verif = $connexion->query(" select vis_matricule from visiteur where vis_matricule='" . $mat . "';");
  $visiteur = $verif->fetch();
  if ($visiteur) //existe 
  {
    $requete = "delete from visiteur";
    $requete = $requete . " where vis_matricule='" . $mat . "';";

    // Lancer la requête supprimer
    $ok = $connexion->query($requete);

    // Si la requête a réussi
    if ($ok) {
      $message = "Le visiteur a été correctement supprimé";
      ajouterErreur($tabErr, $message);
    } else {
      $message = "Attention, la suppression du visiteur a échoué !";
    }
      ajouterErreur($tabErr, $message);
  } else // n'existe pas
  {
    $message = "Le visiteur n'existe pas";
    ajouterErreur($tabErr, $message);
  }
}
function modifierVisiteur($unNom,$unPrenom,$unMail,$unMat,$tabErreurs)
{
    
    // Ouvrir une connexion au serveur mysql en s'identifiant
    $connexion = connecterServeurBD();
    if($unNom==""||$unPrenom==""||$unMail=="")
    {
      $message = "Des données sont incomplètes";
      ajouterErreur($tabErreurs, $message);
    }
    // Cr�er la requ�te de modification 
   else
   {

    $requete= "UPDATE visiteur SET
    vis_nom = '$unNom',
    vis_prenom = '$unPrenom',
    vis_mail = '$unMail' WHERE vis_matricule='$unMat';";      
    // Lancer la requ�te d'ajout 
    $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
    
    // Si la requ�te a r�ussi
    if ($ok)
    {
      $message = "Les données ont été correctement modifiées";
      ajouterErreur($tabErreurs, $message);
    }
    else
    {
      $message = "Attention, les modifications ont echouée !";
      ajouterErreur($tabErreurs, $message);
    } 
  }
}
function modifierMateriel($unId,$uneMarque,$unModele,$uneDimension,$unType,$tabErreurs)
{
    
    // Ouvrir une connexion au serveur mysql en s'identifiant
    $connexion = connecterServeurBD();
    if($uneMarque==""||$unModele==""||$uneDimension==""||$unType=="")
    {
      $message = "Des données sont incomplètes";
      ajouterErreur($tabErreurs, $message);
    }
    // Cr�er la requ�te de modification 
   else
   {

    $requete= "UPDATE materiel SET
    Marque = '$uneMarque',
    Modele = '$unModele',
    Dimension = '$uneDimension',
    Type = '$unType' WHERE Id='$unId';";      
    // Lancer la requ�te d'ajout 
    $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
    
    // Si la requ�te a r�ussi
    if ($ok)
    {
      $message = "Les données ont été correctement modifiées";
      ajouterErreur($tabErreurs, $message);
    }
    else
    {
      $message = "Attention, les modifications ont echouée !";
      ajouterErreur($tabErreurs, $message);
    } 
  }
}
function rechercherUtilisateur($unMat, $unMdp, &$tabErr)
{
    $connexion = connecterServeurBD();
      
    $requete="select * from visiteur";
      $requete=$requete." where VIS_MATRICULE='".$unMat."' and VIS_MDP='".$unMdp."';";
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    // Initialisationd e la cat�gorie trouv�e � : "aucune"
    $cat = "nulle";
    
    $ligne = $jeuResultat->fetch();
    
    // Si un utilisateur est trouv�, on initialise une variable cat avec la cat�gorie de cet utilisateur trouv�e dans la table utilisateur
    if ($ligne)
    {
        $cat = $ligne['role'];
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $cat;
}
function listerEmprunter()
{
    $connexion = connecterServeurBD();
   
    $requete="select dateEmprunter, dateRestituer, vis_matricule, idMateriel from emprunter where dateRestituer is not null";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $materiel[$i]['dateEmprunter']=$ligne['dateEmprunter'];
        $materiel[$i]['dateRestituer']=$ligne['dateRestituer'];
        $materiel[$i]['vis_matricule']=$ligne['vis_matricule'];
        $materiel[$i]['idMateriel']=$ligne['idMateriel'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $materiel;
}

function listerPasRestituer()
{
    $connexion = connecterServeurBD();
   
    $requete="select dateEmprunter, dateRestituer, vis_matricule, idMateriel from emprunter where dateRestituer is null";
    
    $jeuResultat=$connexion->query($requete); 
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $materiel[$i]['dateEmprunter']=$ligne['dateEmprunter'];
        $materiel[$i]['dateRestituer']=$ligne['dateRestituer'];
        $materiel[$i]['vis_matricule']=$ligne['vis_matricule'];
        $materiel[$i]['idMateriel']=$ligne['idMateriel'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   
  
  return $materiel;
}

function ajouterEmprunt($dateEmprunter, $vis_matricule, $idMateriel,&$tabErr)
{
  // Ouvrir une connexion au serveur mysql en s'identifiant
  $connexion = connecterServeurBD();
    
  $requete="select * from emprunter";
  $requete=$requete." where idMateriel != '".$idMateriel."' and dateRestituer is not null;";   
  // Cr�er la requ�te d'ajout 
  
  
  // Lancer la requ�te d'ajout 
  $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
  // Si la requ�te a r�ussi
  if ($ok)
  {
        $requete="insert into emprunter"
        ."(dateEmprunter, vis_matricule, idMateriel) values ('"
        .$dateEmprunter."','"
        .$vis_matricule."','"
        .$idMateriel."');";
        $ok=$connexion->query($requete);
        $message = "L'emprunt a été correctement ajouté";
        ajouterErreur($tabErr, $message);
    }
  else
  {
    $message = "Attention, l'ajout de l'emprunt a échoué !!!";
    ajouterErreur($tabErr, $message);
  } 

}

function ajouterRestituer( $dateRestituer, $vis_matricule, $idMateriel,&$tabErr)
{
  
  $connexion = connecterServeurBD();
  $requete="select vis_matricule, idMateriel from emprunter";
  $requete=$requete." where vis_matricule = '".$vis_matricule."' and idMateriel = '".$idMateriel."' and dateRestituer is null;";   
  // Cr�er la requ�te d'ajout 
  $requete="update emprunter"
  ." set dateRestituer ='"
  .$dateRestituer."'
  where idMateriel = '".$idMateriel."'
  and vis_matricule = '".$vis_matricule."';";          
 
  $ok=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant


  
  // Si la requ�te a r�ussi
  if ($ok)
  {
    $message = "Le matériel a été correctement restitué";
    ajouterErreur($tabErr, $message);
    }
  else
  {
    $message = "Attention, la réstitution de l'emprunt a échoué !!!";
    ajouterErreur($tabErr, $message);
  } 

}

function listerMaterielDisponible()
{
    $connexion = connecterServeurBD();
   
    $requete="SELECT `Id`, `Marque`, `Modele` FROM materiel WHERE Id not in (SELECT emprunter.idMateriel from emprunter where emprunter.dateRestituer is null)";
    
    $jeuResultat=$connexion->query($requete); // on va chercher tous les membres de la table qu'on trie par ordre croissant
  
    $i = 0;
    $ligne = $jeuResultat->fetch();
    while($ligne)
    {
        $materiel[$i]['Id']=$ligne['Id'];
        $materiel[$i]['Marque']=$ligne['Marque'];
        $materiel[$i]['Modele']=$ligne['Modele'];
        $ligne=$jeuResultat->fetch();
        $i = $i + 1;
    }
    $jeuResultat->closeCursor();   // fermer le jeu de r�sultat
  
  return $materiel;
}