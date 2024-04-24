<?php
function connectToDB()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "mental";

    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    return $link;
}

?>