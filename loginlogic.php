<?php
include("database_connect.php");
if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = pg_query_params($con, "SELECT * FROM f_on_kasutaja($1, $2)", array($username, $password));
    if(pg_num_rows($result) > 0){
        $_SESSION["username"] = $username;
        while ($row = pg_fetch_row($result)) {
            $_SESSION['mode'] = $row[0];
            $_SESSION['userId'] = $row[1];
        }

        echo("<script>location.href='index.php'</script>");
    } else {
        echo("<script>location.href='signin.php?error=true'</script>");
    }
}

?>
