<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "deshieats";

if(!$CON=mysqli_connect($host, $user, $pass, $db))
{
    die("Fail to connect");
}else{
    $link = mysqli_connect($host, $user, $pass, $db);
}

?>