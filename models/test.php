<?php
   //
   $pdo = require 'connect.php';


   $sql = 'SELECT * From accueil';
   $statement = $pdo->query($sql);
   $user_data = $statement->fetchAll(PDO::FECTCH_ASSOC);
   print_r($user_data);

?>

