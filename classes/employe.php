<?php


require_once '../configs/chemins.class.php';
require_once '../'.Chemins::CONFIGS.'db_connect.php';
$request_method = $_SERVER['REQUEST_METHOD'];  


switch($request_method)
{
    case 'GET':
      if(!empty($_GET["id"]))
      {
        $id = intval($_GET["id"]);
        getEmployeById($id);
      }
      elseif(!empty($_GET['matricule'])){
        $matricule = $_GET['matricule'];
        $entite = $_GET['entite'];
        getEmployeByMatricule($matricule, $entite);
      }
      else{
        getEmployes();
      }
      break;
    case 'POST':
        addEmploye();
        break;
    case 'PUT':
        // Modifier un employe
        $id = intval($_GET['id']);
        updateEmploye($id);
        break;
    case 'DELETE':
        // Supprimer un employe
        $id = intval($_GET["id"]);
        deleteEmploye($id);
        break;
    default:
        // Requête invalide
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function deleteEmploye($id=0){
    global $conn;
    $query = "DELETE FROM employe WHERE idEmploye=".$id;
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Employe supprime avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'La suppression du Employe a echoue. '. mysqli_error($conn)
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function updateEmploye($id=0){
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    

    $matriculeEmploye = $_PUT['matriculeEmploye'];
    $nom = $_PUT['nom'];
    $prenom = $_PUT['prenom'];
    $email = $_PUT['email'];
    $idEntite = $_PUT['entite'];

    $sql = "SELECT * FROM entite WHERE idEntite=".$idEntite." LIMIT 1"; 
    
    $response = array();
    $result = mysqli_query($conn, $sql) or die($conn->error);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }




    if(!empty($response[0])){
      //construire la requête SQL
      $query="UPDATE employe 
      SET matriculeEmploye='$matriculeEmploye',
      nomEmploye='$nom', 
      prenomEmploye='$prenom',
      emailEmploye='$email', 
      idEntite='$idEntite'
      WHERE idEmploye=".$id;
      
      if(mysqli_query($conn, $query))
      {
        $response=array(
          'status' => 1,
          'status_message' =>'Employe mis a jour avec succes.'
        );
      }
      else
      {
        $response=array(
          'status' => 0,
          'status_message' =>'Echec de la mise a jour de Employe. '. mysqli_error($conn)
        );
        
      }
    }else{
    $response=array(
      'status' => 0,
      'status_message' =>'ERREUR! Cette entite n existe pas.'
    );
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}

function getEmployeById($id=0){
    global $conn;
    $query = "SELECT idEmploye, matriculeEmploye, prenomEmploye, nomEmploye, emailEmploye, idEntite FROM employe";
    if($id != 0)
    {
      $query .= " WHERE idEmploye=".$id." LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function getEmployeByMatricule($idMatricule=0, $entite=0){
    global $conn;
    $query = "SELECT idEmploye, matriculeEmploye, prenomEmploye, nomEmploye, emailEmploye, entite.idEntite FROM employe, entite WHERE entite.idEntite=employe.idEntite AND matriculeEmploye='" . $idMatricule . "' AND nomEntite='". $entite . "' LIMIT 1";


    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function getEmployeByEntite($idEntite=0){
    global $conn;
    $query = "SELECT  idEmploye, matriculeEmploye, prenomEmploye, nomEmploye, emailEmploye, idEntite FROM employe";
    if($idEntite != 0)
    {
      $query .= " WHERE idEntite=".$idEntite;
    }
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function getEmployes(){
      global $conn;
      $query = "SELECT idEmploye, matriculeEmploye, prenomEmploye, nomEmploye, emailEmploye, idEntite FROM employe";
      $response = array();
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_array($result))
      {
        $response[] = $row;
      }
      header('Content-Type: application/json');
      echo json_encode($response, JSON_PRETTY_PRINT);
}

function addEmploye(){
    global $conn;

    $matriculeEmploye = $_POST['matriculeEmploye'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $idEntite = $_POST['entite'];
    $password = generateRandomString();

    $sql = "SELECT * FROM entite WHERE idEntite=".$idEntite." LIMIT 1"; 
    
    $response = array();
    $result = mysqli_query($conn, $sql) or die($conn->error);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }




    if(!empty($response[0])){
      $sql="INSERT INTO employe(matriculeEmploye, nomEmploye, prenomEmploye, emailEmploye, idEntite, passwordEmploye) 
       VALUES ('$matriculeEmploye', '$nom', '$prenom', '$email', $idEntite, '$password')";
      
      
      if(mysqli_query($conn, $sql))
      {
        $response=array(
          'status' => 1,
          'status_message' =>'Employe ajoute avec succes.'
        );
      }
      else
      {
        $response=array(
          'status' => 0,
          'status_message' =>'ERREUR!.'. mysqli_error($conn)
        );
      }
    }else{
      $response=array(
        'status' => 0,
        'status_message' =>'ERREUR! Cette entite n existe pas.'
      );
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}