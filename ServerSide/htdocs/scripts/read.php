<?php
require("connect.php");

//connect to db
$db = new mysqli($server_name,$mysql_user, $mysql_pass, $db_name);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$userid=$_GET["userid"];
$query="SELECT * FROM chat order by id asc";
//execute query
if ($db->real_query($query)) {
    //If the query was successful
    $res = $db->use_result();
    while ($row = $res->fetch_assoc()) {
        $username=$row["username"];
        $text=$row["text"];
        $location=$row["location"];
        $time=date('G:i', strtotime($row["time"])); //outputs date as # #Hour#:#Minute#
       // echo "<p>$time |$location| $username: $text</p>\n";
        if($userid==$username)
		    echo '<div class="row msg_container base_sent">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p style="font-size:15px;"><b>'.$text.'</b></p><p style="font-size:10px;">'.$time.'</p>
								</div>
                        </div>
                    </div>';
		else
			echo '<div class="row msg_container base_receive">
                        <div class="col-xs-10 col-md-10">
                            <div class="messages msg_receive">
                                <p><b>'.$username.':</b> '.$text.' <br>'.$time.' | '.$location.'</p></div>
                        </div>
                    </div>';
		
    }
}

else{
    //If the query was NOT successful
    echo "An error occured in UserTable";
    echo $db->errno;
}
$db->close();
?>
