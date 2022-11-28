<?php


require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function generateRandomString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendPDF(){
    $filesDir = getDirContents($_SERVER['DOCUMENT_ROOT'].'/coffrefort/documents');
    $result = array();

    
    foreach ($filesDir as $file){
        $pieces = explode("/", $file);
        $lenFiles = count($pieces);
        $fileName = $pieces[$lenFiles -1];
        $fileEntity = $pieces[$lenFiles - 2];
        $tempArray = array(
            "entite" => $fileEntity,
            "name" =>$fileName
            );
        if($fileEntity!="documents"){
            $result[] = $tempArray;
        }
    }
    // $result --->  Array(
    //     [0] => Array
    //         (
    //             [entite] => entite1
    //             [name] => KICAS1_010121.txt
    //         )
    //     ...
    // )

        // echo(print_r($result));
    
        

    foreach ($result as $file){
        $pieces = explode("_", $file['name']);
        $matricule = $pieces[0];
        $entite = $file['entite'];

        
        $url = "http://".$_SERVER['SERVER_NAME']."/coffrefort/classes/employe.php?matricule=".$matricule."&entite=".$entite;
        $json = file_get_contents($url);
        $employe = json_decode($json, true);
        
        if(!empty($employe[0]['emailEmploye'])){
            $directory = $_SERVER['DOCUMENT_ROOT'].'/coffrefort/documents/'.$file['entite'].'/'.$file['name'];
    
            sendEmailPDF($employe[0]['emailEmploye'], $directory);
        }
    }



    return true;
}

function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

function sendEmailPDF($email, $fileDir){
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        //$mail->isSMTP();
        $mail->Host = '127.0.0.1';
        $mail->SMTPAuth = false;
        $mail->SMTPSecure = 0;
        $mail->SMTPAutoTLS = false;
        $mail->SMTPSecure = false;
        
        
        $mail->CharSet = "UTF-8";
        $mail->From ='ne_pas_repondre@site.com';
        $mail->FromName = 'Ne pas repondre';
        //A ACTIVER LORS DE LA MISE EN SERVICE
        $mail->addAddress($email);
        
        

        $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non
        
        $mail->addAttachment($fileDir);         //Add attachments


        $mail->Subject = 'pdf';
        $mail->Body = 'Bonjour,<br>
        Voici le pdf.<br>
        Ne le perdez pas.<br><br>
        Bonne journée.<br>
        KICAS BOT';
        
        $mail->send();
    } catch (Exception $e) {
        error_log("KICAS coffre fort functions.php mail not sent. Mailer Error: {$mail->ErrorInfo}");
    }
}


function sendEmailCreation($email, $password){
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        //$mail->isSMTP();
        $mail->Host = '127.0.0.1';
        $mail->SMTPAuth = false;
        $mail->SMTPSecure = 0;
        $mail->SMTPAutoTLS = false;
        $mail->SMTPSecure = false;
        
        
        $mail->CharSet = "UTF-8";
        $mail->From ='ne_pas_repondre@site.com';
        $mail->FromName = 'Ne pas repondre';
        //A ACTIVER LORS DE LA MISE EN SERVICE
        $mail->addAddress($email);
        
        

        $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non
        
        $mail->Subject = 'Mot de passe pdf';
        $mail->Body = 'Bonjour,<br>
        Voici le mot de passe qui vous servira à dézipper les pdfs que vous recevrez de la part de la compta.<br>
        Ne les perdez pas.<br>
        Mot de passe : '.$password.'<br><br>
        Bonne journée.<br>
        KICAS BOT';
        
        $mail->send();
    } catch (Exception $e) {
        error_log("KICAS coffre fort functions.php mail not sent. Mailer Error: {$mail->ErrorInfo}");
    }
}
