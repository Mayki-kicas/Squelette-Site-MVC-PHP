
<div class="container">
<br/>
<div class="row">
    <div class="col s4 offset-s4  teal lighten-2 white-text">
        <h4 class="center-align">Modification d'une entite</h4>
    </div>
</div>
<br/>

<?php
$idEnt = $_GET['id'];



$url = "http://".$_SERVER['SERVER_NAME']."/coffrefort/classes/entite.php?id=".$idEnt;
$json = file_get_contents($url);
$entites = json_decode($json, true);
$myEntite = $entites[0];

?>

<div class="row">
    <form id="formUpdateEnt" method="PUT" class="col s6 offset-s3">
      <div class="row">
        <div class="input-field col s12">
          <input value="<?php echo $myEntite['nomEntite']; ?>" id="nomEntite" name="nomEntite" type="text" class="validate" required="" aria-required="true">
          <label for="nomEntite">Nom Entite</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input value="<?php echo $myEntite['dossierEntite']; ?>" id="dossierEntite" name="dossierEntite" type="text" class="validate" required="" aria-required="true">
          <label for="dossierEntite">Dossier Entite</label>
        </div>
      </div>
      <button id="submitEnt" class="btn waves-effect waves-light" type="submit">Valider
            <i class="material-icons right">send</i>
        </button>

    </form>
  </div>



</div>