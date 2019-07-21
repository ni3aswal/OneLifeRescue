<?php
require("connect.php");

//connect to db
$db = new mysqli($server_name,$mysql_user, $mysql_pass, $db_name);
if ($db->connect_errno) {
    //if the connection to the db failed
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

//get user-input from url
$username=substr($_GET["username"], 0, 32);
$text=substr($_GET["text"], 0, 128);
$location=substr($_GET["location"], 0, 128);
//escaping is extremely important to avoid injections!
$nameEscaped = htmlentities(mysqli_real_escape_string($db,$username)); //escape username and limit it to 32 chars
$textEscaped = htmlentities(mysqli_real_escape_string($db, $text)); //escape text and limit it to 128 chars
$locationEscaped = htmlentities(mysqli_real_escape_string($db, $location)); //escape text and limit it to 128 chars

//create query
$query="INSERT INTO chat (username, text,location) VALUES ('$nameEscaped', '$textEscaped','$locationEscaped')";
//execute query
if ($db->real_query($query)) {
    //If the query was successful
    echo "Wrote message to db";
}else{
    //If the query was NOT successful
    echo "An error occurred";
    echo $db->errno;
}

$db->close();
?>