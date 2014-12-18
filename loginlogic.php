<?php
include("database_connect.php");
if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    //TODO:ADD PASSWORD HASHING


    $result = pg_query_params($con, 'SELECT * FROM isik WHERE kasutajanimi = $1 AND parool = $2', array($username = $_POST['username'], $password = $_POST['password']));

    if(pg_num_rows($result) > 0){
        $_SESSION["username"] = $username;
        while ($row = pg_fetch_row($result)) {
            $_SESSION["userId"] = $row[0];
        }
        header("Location: index.php");
    } else {
        header("Location: signin.php?error=true");
    }
}

?>