<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body ng-app="mainModule" ng-controller="mainController">


  <?php
  global $conn;
  if (isset($_POST['submitLogin'])){
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
      $query = "SELECT * FROM `user` WHERE login='$email' and password='" . hash('sha256', $password) . "'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['email'] = $email;
        header("Location: index.php?controleur=accueil");
        exit();
    }else{
      echo '<script> window.alert("Le nom d\'utilisateur ou le mot de passe est incorrect.");</script>';
    }
  }
  ?>
  <div class="container">
    <div id="login-page" class="row">
      <div class=" center-align col s6 offset-s3">
        <form class="login-form" method="post" action="">
          <div class="row">
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">mail_outline</i>
              <input id="email" type="text" name="email">
              <label for="email" data-error="wrong" data-success="right">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock_outline</i>
              <input id="password" type="password" name="password">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <button id="submitLogin" name="submitLogin" class="btn waves-effect waves-light" type="submit">
              Login
              </button>
            </div>
          </div>

        </form>
      </div>
    </div> 
  </div>
</body>
      <!--JavaScript at end of body for optimized loading-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="<?php echo Chemins::JS;?>custom_kicas.js"></script>
    </body>
  </html>