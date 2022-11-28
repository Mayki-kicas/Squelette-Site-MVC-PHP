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

    <body>
    <header>
          <!-- Dropdown Structure -->
      <ul id="dropdown-employe" class="dropdown-content">
        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/coffrefort/index.php?controleur=employe">Afficher employes</a></li>
        <li class="divider"></li>
        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/coffrefort/index.php?controleur=addEmploye">Ajouter employe</a></li>
      </ul>
          <!-- Dropdown Structure -->
      <ul id="dropdown-entite" class="dropdown-content">
        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/coffrefort/index.php?controleur=entite">Afficher entites</a></li>
        <li class="divider"></li>
        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/coffrefort/index.php?controleur=addEntite">Ajouter entite</a></li>
      </ul>
      <nav>
        <div class="nav-wrapper teal lighten-2">
          <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/coffrefort/index.php?" class="brand-logo">Coffre-fort</a>
          <ul class="right hide-on-med-and-down">
            <li><a  class="dropdown-trigger" data-target="dropdown-employe">Employe<i class="material-icons right">arrow_drop_down</i></a></li>
            <li><a class="dropdown-trigger" data-target="dropdown-entite">Entite<i class="material-icons right">arrow_drop_down</i></a></li>
            <li><a href="logout.php">Deconnexion</a></li>
          </ul>
        </div>
      </nav>
        
    </header