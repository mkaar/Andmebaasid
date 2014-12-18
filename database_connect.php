<?php
if(!isset($_SESSION)){
   session_start();
}
   $host        = "host=apex.ttu.ee";
   $port        = "port=7301";
   $dbname      = "dbname=t123443";
   $credentials = "user=t123443 password=asdqwe123";
   $con =  pg_connect("$host $port $dbname $credentials");
   if (!$con) {
      echo "An error occurred.\n";
      exit;
   }
?>