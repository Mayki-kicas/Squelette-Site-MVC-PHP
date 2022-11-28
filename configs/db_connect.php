<?php
    $server = "localhost";
    $username = "username";
    $password = "password";
    $db = "coffrefort";
    $conn = new mysqli($server, $username, $password, $db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>
