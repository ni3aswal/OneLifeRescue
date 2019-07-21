<?php
include 'connect.php';
$user_name= $_POST["user_name"];
$sql = "SELECT mobile1,mobile2,mobile3 FROM `sos` WHERE user_name='$user_name'";
 $res = mysqli_query($con,$sql) or die("Query Not Executed " . mysqli_error($con));
    
     //Step No. 3: Putting the fetched data in Arrays
    $data_array = array();
    while($rows =mysqli_fetch_assoc($res))
    {
        $data_array[] = $rows;
    }
$data_array[0]['state']=0;	
if(isset($data_array) && $data_array!=[] && $data_array!='null')
{
$data_array[0]['state']=1;
 // $arr = array ('state'=>1,'email'=>$email,'name'=>$name);
 echo json_encode($data_array); // {"a":1,"b":2,"c":3,"d":4,"e":5}
 //echo "var mobile1 = ".json_encode($mobile1).";";
//echo 1;
}else{
	echo 0;
}
mysqli_close($con);


?>