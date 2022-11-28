
<div class="container">
        
   <div class="row">
        <div class="card-panel center-align col s6 offset-s3">
        <br>Site en travaux<br> Ajout employe, entite et envoie des pdf par mail.<br><br>
        </div>
   </div>
   <div class="row">
        <div class="card-panel center-align col s6 offset-s3">
        <br>Le bouton ci-dessous aura pour but d'envoyer tout les fichiers pdf à l'employé lui correspondant une fois finit.<br>
        Un document est dans le dossier <i>documents/urlEntite</i> et est appelé matriculeEmp_date.pdf<br>
        Si le matricule n'est pas correctement orthographié, le fichier ne sera probablement pas envoyé.<br> 
        A noter qu'une fois envoyé, le pdf est supprimé du dossier.<br><br>
        </div>
   </div>
   <div class="row">
        <div class="center-align col s6 offset-s3">
        <form name="sendPDF" method="post" action="">

        <button id="submitPDF" name="submitPDF" class="btn waves-effect waves-light" type="submit">Envoyer les PDFs
                <i class="material-icons right">send</i>
        </button>
        <form>
        </div>
   </div>
</div>


<?php
if(isset($_POST['submitPDF'])) {
        if(sendPDF()){
          ?>
          <div class="container">
        
               <div class="row">
                    <div class="card-panel center-align col s6 offset-s3">
                    <br>Mails bien envoyés<br><br>
                    </div>
               </div>
          <div class="container">
          <?php
        }else{
          ?>
          <div class="container">
        
               <div class="row">
                    <div class="card-panel center-align col s6 offset-s3">
                    <br>Erreur lors de l'envoie des mails<br><br>
                    </div>
               </div>
          <div class="container">
          <?php
        }
}?>