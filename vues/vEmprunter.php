
  <!-- Vue pour lister les fleurs
    ================================================== -->
    <br>
<br>
<br>
<br>
<br>

<br>
<div class="container">

    <table class="table table-bordered table-striped table-condensed">
      <br>
      <thead>
        <tr>
          <th>Date d'emprunt</th>
          <th>Date de restitution</th>
          <th>Matricule</th>
          <th>Id du matériel</th>
     
        </tr>
      </thead>
      <tbody>  
<?php
    $i = 0;
    while($i < count($materiel))
    { 
 ?>     
        <tr>
            <td><?php echo $materiel[$i]['dateEmprunter']?></td>
            <td><?php echo $materiel[$i]["dateRestituer"]?></td>
            <td ><?php echo $materiel[$i]["vis_matricule"]?></td>
            <td><?php echo $materiel[$i]["idMateriel"]?></td>
          
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>

 