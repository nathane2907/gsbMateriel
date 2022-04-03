<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>  
<div class="container">
  <?php
try
{
  $PARAM_hote = 'localhost'; // le chemin vers le serveur
  $PARAM_port = '3306';
  $PARAM_nom_bd = 'materiel'; // le nom de votre base de donn�es
  $PARAM_utilisateur = 'root'; // nom d'utilisateur pour se connecter
  $PARAM_mot_passe = '';
  $bdd = new PDO('mysql:host=' . $PARAM_hote . ';port=' . $PARAM_port . ';dbname=' . $PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
<form method="post" action="">
  <br><br>
  <legend>Choisissez le matricule du visiteur à modifier :</legend>
  <select name="mat"> 
  <?php
    $reponse = $bdd->query('SELECT vis_matricule FROM visiteur');
    while ($matricule = $reponse->fetch())
    {
  ?>
      <option value="<?php echo $matricule['vis_matricule']; ?>"> <?php echo $matricule['vis_matricule']; ?></option>
  <?php
    }
  ?>
  </select>
  <input type="hidden" name="etape" value="3" />
  <fieldset>
    <legend>Entrez les données à modifier :</legend>
    <label>Nom :</label>
    <input type="text" name="nom"  /><br />
    <label>Prénom :</label>
    <input type="text" name="prenom"  size="20" /><br />
    <label>Mail :</label>
    <input type="text" name="mail"  /><br />
  </fieldset>
  <button type="submit" class="btn btn-primary">Modifier</button>
  <button type="reset" class="btn">Annuler</button>
</form>
</div>
</body>
</html>