
<div class="container">
<br/>
<div class="row">
    <div class="col s4 offset-s4  teal lighten-2 white-text">
        <h4 class="center-align">Ajout d'un employe</h4>
    </div>
</div>
<br/>

<div class="row">
    <form id="formAddEmp" class="col s6 offset-s3">
      <div class="row">
        <div class="card-panel">Le mot de passe permettant à l'employé de dézipper les pdfs est généré automatiquement et lui est envoyé par email.</div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="matricule" name="matricule" type="text" class="validate" required="" aria-required="true">
          <label for="matricule">Matricule</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="prenom" name="prenom" type="text" class="validate" required="" aria-required="true">
          <label for="prenom">Prenom</label>
        </div>
        <div class="input-field col s6">
          <input id="nom" name="nom" type="text" class="validate" required="" aria-required="true">
          <label for="nom">Nom</label>
        </div>
      </div>
      <select id="selectEntite" name="entite" class="browser-default">
        <option value="-1" disabled selected>Choisir une entite</option>
        <?php 
        $url = "http://".$_SERVER['SERVER_NAME']."/coffrefort/classes/entite.php";
        $json = file_get_contents($url);
        $entites = json_decode($json, true);
        foreach($entites as &$eachEnt){
        ?>
        <option value="<?php echo $eachEnt['idEntite']; ?>"><?php echo $eachEnt['nomEntite']; ?></option>
        <?php
        }
        ?>
      </select>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate" required="" aria-required="true">
          <label for="email">Email</label>
        </div>
      </div>
      <!-- <div class="row">
        <div class="input-field col s12">
          <input id="passwordEmploye" name="passwordEmploye" type="password" class="validate" required="" aria-required="true">
          <label for="passwordEmploye">Mot de passe</label>
        </div>
      </div> -->
      <button id="submitEmp" class="btn waves-effect waves-light" type="submit">Valider
            <i class="material-icons right">send</i>
        </button>

    </form>
  </div>



</div>