<?php
  session_start();

require_once 'configs/chemins.class.php';
require_once Chemins::CONFIGS.'db_connect.php';
require_once Chemins::CLASSES.'functions.php';



if(!isset($_SESSION['email'])){
  require Chemins::VUES_PERMANENTES.'login.php';
}else{

  require_once Chemins::VUES_PERMANENTES.'header.inc.php';

  if(isset($_GET['controleur'])){
    switch($_GET['controleur']){
      case 'employe':
        require Chemins::VUES.'employe.inc.php';
        break;
      case 'addEmploye':
        require Chemins::VUES.'addEmploye.inc.php';
        break;
      case 'updateEmploye':
        require Chemins::VUES.'updateEmploye.inc.php';
        break;
      case 'entite':
        require Chemins::VUES.'entite.inc.php';
        break;
      case 'addEntite':
        require Chemins::VUES.'addEntite.inc.php';
        break;
      case 'updateEntite':
        require Chemins::VUES.'updateEntite.inc.php';
        break;
      case 'accueil':
        require Chemins::VUES.'accueil.inc.php';
        break;
      default:
        require Chemins::VUES.'accueil.inc.php';
        break;
    }
  }else{
    require Chemins::VUES.'accueil.inc.php';
  }
  require_once Chemins::VUES_PERMANENTES.'footer.inc.php';
}