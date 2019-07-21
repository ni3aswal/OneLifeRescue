<?php

include 'connect.php';
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM `hospital_reg` WHERE email='$email' AND password= '$password'";
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

//echo 1;
}else{
	echo 0;
}
mysqli_close($con);

?>