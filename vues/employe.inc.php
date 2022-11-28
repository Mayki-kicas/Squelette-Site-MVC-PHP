<?php

$url = "http://".$_SERVER['SERVER_NAME']."/coffrefort/classes/employe.php";
$json = file_get_contents($url);
$employes = json_decode($json, true);
?>

<div class="container">
<br/>
<div class="row">
    <div class="col s4 offset-s4 teal lighten-2 white-text">
        <h4 class="center-align">Liste des employes</h4>
    </div>
</div>
<br/>

<div class="row">
<div class="col s8 offset-s2">
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/coffrefort/index.php?controleur=addEmploye" class="waves-effect waves-light btn center-align">Ajouter un employe</a>
<br/>
<table class="highlight">
        <thead>
          <tr>
              <th>ID</th>
              <th>Matricule</th>
              <th>Prenom</th>
              <th>Nom</th>
              <th>Email</th>
              <th>Entite</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
        <?php 
        foreach ($employes as &$eachEmp) {
            $url = "http://".$_SERVER['SERVER_NAME']."/coffrefort/classes/entite.php?id=".$eachEmp['idEntite'];
            $json = file_get_contents($url);
            $entite = json_decode($json, true)[0]['nomEntite'];

        ?>
          <tr>
            <td><?php echo $eachEmp['idEmploye']; ?></td>
            <td><?php echo $eachEmp['matriculeEmploye']; ?></td>
            <td><?php echo $eachEmp['prenomEmploye']; ?></td>
            <td><?php echo $eachEmp['nomEmploye']; ?></td>
            <td><?php echo $eachEmp['emailEmploye']; ?></td>
            <td><?php echo $entite; ?></td>
            <td><button class="updateEmpButton" value="<?php echo $eachEmp['idEmploye']; ?>"><i class="small material-icons">update</i></button>  <button class="removeEmpButton" value="<?php echo $eachEmp['idEmploye']; ?>"><i class="small material-icons">delete_forever</i></button></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
</div>
</div>
</div>