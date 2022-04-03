<div class="container">

<table class="table table-bordered table-striped table-condensed">
  <br>
  <thead>
    <tr>
      <th>Matricule</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Mail</th>
      <th>Code Postal</th>
    </tr>
  </thead>
  <tbody>  
<?php
$i = 0;
while($i < count($visiteur))
{ 
?>     
    <tr>
        <td><?php echo $visiteur[$i]["vis_matricule"]?></td>
        <td><?php echo $visiteur[$i]["vis_nom"]?></td>
        <td><?php echo $visiteur[$i]["vis_prenom"]?></td>
        <td><?php echo $visiteur[$i]["vis_mail"]?></td>
        <td><?php echo $visiteur[$i]["vis_cp"]?></td>
    </tr>
<?php
    $i = $i + 1;
 }
?>       
   </tbody>       
 </table>    
</div>