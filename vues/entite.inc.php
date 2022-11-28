<?php

$url = "http://".$_SERVER['SERVER_NAME']."/coffrefort/classes/entite.php";
$json = file_get_contents($url);
$entites = json_decode($json, true);
?>

<div class="container">
<br/>
<div class="row">
    <div class="col s4 offset-s4 teal lighten-2 white-text">
        <h4 class="center-align">Liste des entites</h4>
    </div>
</div>
<br/>

<div class="row">
<div class="col s8 offset-s2">
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/coffrefort/index.php?controleur=addEntite" class="waves-effect waves-light btn center-align">Ajouter une entite</a>
<br/>
<table class="highlight">
        <thead>
          <tr>
              <th>ID</th>
              <th>Nom entite</th>
              <th>Dossier entite</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
        <?php 
        foreach ($entites as &$eachEnt) {
        ?>
          <tr>
            <td><?php echo $eachEnt['idEntite']; ?></td>
            <td><?php echo $eachEnt['nomEntite']; ?></td>
            <td><?php echo $eachEnt['dossierEntite']; ?></td>
            <td><button class="updateEntButton" value="<?php echo $eachEnt['idEntite']; ?>"><i class="small material-icons">update</i></button>  <button class="removeEntButton" value="<?php echo $eachEnt['idEntite']; ?>"><i class="small material-icons">delete_forever</i></button></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
</div>
</div>
</div>