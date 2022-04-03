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
          <th>Id</th>
          <th>Marque</th>
          <th>Modèle</th>
     
        </tr>
      </thead>
      <tbody>  
<?php
    $i = 0;
    while($i < count($materiel))
    { 
 ?>     
        <tr>
            <td><?php echo $materiel[$i]['Id']?></td>
            <td><?php echo $materiel[$i]["Marque"]?></td>
            <td ><?php echo $materiel[$i]["Modele"]?></td>
          
        </tr>
<?php
        $i = $i + 1;
     }
?>       
       </tbody>       
     </table>    
  </div>