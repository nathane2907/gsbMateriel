<?php
$est=!estConnecte();
?>
  <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active">
                <a href="./indexzz.php">Accueil</a>
              </li>
  <?php

if (estAdministrateurConnecte())
{

  ?>
           <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">Visiteur  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="listerVisiteur.php">Lister</a></li>
                      <li><a href="modifierVisiteur.php">Modifier</a></li>
                      <li><a href="supprimerVisiteur.php">Supprimer</a></li>   
                      <li><a href="ajouterVisiteur.php">Ajouter</a></li>               
                  </ul>
              </li> 
              
              <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">Matériel <b class="caret"></b></a>
                  <ul class="dropdown-menu">                
                      <li><a href="modifierMateriel.php">Modifier</a></li>                 
                      <li><a href="listerMateriel.php">Lister</a></li>                 
                      <li><a href="ajouterMateriel.php">Ajouter</a></li>    
                      <li><a href="supprimerMateriel.php">Supprimer</a></li>             
                  </ul>
              </li>

              <li class="nav">
                 <a href="deconnecter.php" >Se déconnecter</a> 
              </li>
 
  <?php
}
// Si session administrateur
if (estVisiteurConnecte())
{

  ?>
              <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">Emprunts<b class="caret"></b></a>
                  <ul class="dropdown-menu">                
                      <li><a href="AjouterEmprunter.php">Emprunter</a></li>                 
                      <li><a href="AjouterRestituer.php">Restituer</a></li>                            
                  </ul>
              </li>
              <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">Liste matériels<b class="caret"></b></a>
                  <ul class="dropdown-menu">                
                      <li><a href="listerMateriel.php">Tous</a></li>                 
                      <li><a href="restituerPasMateriel.php">Emprunté</a></li>                 
                      <li><a href="emprunter.php">Restitué</a></li>    
                      <li><a href="listerMaterielsDisponible.php">Libre</a></li>             
                  </ul>
              </li>
              <li class="nav">
                 <a href="deconnecter.php" >Se déconnecter</a> 
              </li>
 
  <?php
}
// Si aucune connection n'est en cours, proposer l'inscription et l'identification
if (!estConnecte())
{
?>
              <li class="nav">
                 <a href="connecter.php" >Se connecter</a> 
              </li>
              <li class="nav">
                <a href="inscription.php">Inscription</a>
              </li>   
<?php
}              
                                         
?>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>

