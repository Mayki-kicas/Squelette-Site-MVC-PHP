<?php

require_once '../configs/chemins.class.php';
require_once '../'.Chemins::CONFIGS.'db_connect.php';
$request_method = $_SERVER['REQUEST_METHOD'];  


switch($request_method)
{
    case 'GET':
        if(!empty($_GET["id"]))
        {
          // Récupérer une seule entite
          $id = intval($_GET["id"]);
          getEntiteById($id);
        }
        else
        {
          // Récupérer toues les entites
          getEntites();
        }
        break;
    case 'POST':
        addEntite();
        break;
    case 'PUT':
        // Modifier une entite
        $id = intval($_GET['id']);
        updateEntite($id);
        break;
    case 'DELETE':
        // Supprimer une entite
        $id = intval($_GET["id"]);
        deleteEntite($id);
        break;
    default:
        // Requête invalide
         header("HTTP/1.0 405 Method Not Allowed");
         break;
}

function getEntites(){
    global $conn;
    $query = "SELECT * FROM entite";
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function getEntiteById($id=0){
    global $conn;
    $query = "SELECT * FROM entite";
    if($id != 0)
    {
      $query .= " WHERE idEntite=".$id." LIMIT 1";
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

function addEntite(){
    global $conn;
    $nomEntite = $_POST['nomEntite'];
    $dossierEntite = $_POST['dossierEntite'];

    $sql = "INSERT INTO entite(nomEntite, dossierEntite)
    VALUES('$nomEntite', '$dossierEntite')";

    
    if(mysqli_query($conn, $sql))
    {
    $response=array(
        'status' => 1,
        'status_message' =>'Entite ajoute avec succes.'
    );
    }
    else
    {
    $response=array(
        'status' => 0,
        'status_message' =>'ERREUR!.'. mysqli_error($conn)
    );
    }
    header('Content-Type: application/json');
    echo json_encode($response);

}

function updateEntite($id=0){
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    
    $nomEntite = $_PUT['nomEntite'];
    $dossierEntite = $_PUT['dossierEntite'];

    //construire la requête SQL
    $query="UPDATE entite 
    SET nomEntite='$nomEntite', 
    dossierEntite='$dossierEntite'
    WHERE idEntite=".$id;
    
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Entite mis a jour avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'Echec de la mise a jour de Entite. '. mysqli_error($conn)
      );
      
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}

function deleteEntite($id=0){
    global $conn;
    $query = "DELETE FROM employe where idEntite=".$id;
    mysqli_query($conn, $query);
    $query = "DELETE FROM entite WHERE idEntite=".$id;
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'entite supprimee avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'La suppression de l\'entite a echoue. '. mysqli_error($conn)
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}