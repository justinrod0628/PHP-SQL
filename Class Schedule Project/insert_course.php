<?php

include 'dbconfig.php';
 
 if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}

echo "<a href='logout.php'>logout</a>";

$cookie_name = "aid";

if(!isset($_COOKIE[$cookie_name])) {
	die ("<br>Please login first!");
} 

if (isset($_POST)){

$Course_id = $_POST['course_id'];
$Course_name = $_POST['course_name'];
$Faculty = $_POST['Faculty'];
$Enrollment = $_POST['enrollment'];
$Rooms = $_POST['Rooms']; 
$Admin = $_COOKIE["aid"];

$Course_id = mysqli_real_escape_string($con, $Course_id);
$Course_name = mysqli_real_escape_string($con, $Course_name);
$Enrollment = mysqli_real_escape_string($con, $Enrollment);

if (!is_numeric($Enrollment)){
	echo "<br>Error enrollment needs to be an integer";
	die();
}


$sql7 = "SELECT cid from Courses_rjustin where cid = '$Course_id'"; 
$result7 = mysqli_query($con, $sql7);
$List_query = mysqli_fetch_array($result7);
$List = $List_query['cid'] ?? null;


//Search for keyword already in the table function
if($Course_id == $List){
	echo "<br>Error! Cannot have the same course ID.";
	die();
}

if($Enrollment < 0){
	echo "<br>Enrollment must be greater than 0.";
	die();
}

if($Faculty == ""){
	echo "<br>Please select a faculty.";
	die();
}

if ($Rooms == ""){
	echo "<br>Please select a room.";
	die();
}
 
$sql5 = "Select size from TECH3740.Rooms where rid = $Rooms";
$result5 = mysqli_query($con, $sql5);
$Room_size_query = mysqli_fetch_array($result5);
$Room_size = $Room_size_query['size'];

	
if($Enrollment > $Room_size){
	echo "<br>Enrollment $Enrollment cannot be more than room size $Room_size.";
	die();
}

if (!isset($_POST['term'])) {
	echo "<br>Please select at least one term.";
	die();
}

if (isset($_POST['term']) && !empty($_POST['term'])) {
	$Term_Array=$_POST['term'];  
	$Term="";
	$index = 1;
	foreach($Term_Array as $Term_check)  
   {  
	if($index < count($Term_Array))
      $Term .= $Term_check.",";
	else 
	  $Term .= $Term_check;
	  $index += 1;
   }


$sql6 = "INSERT into Courses_rjustin VALUES('$Course_id', '$Course_name', '$Term', $Enrollment, $Faculty, $Rooms, $Admin);";
		
$result6 = mysqli_query($con, $sql6);

if ($result6)
	echo "<br> Successfully inserted the course: $Course_id, $Course_name";
else{
	echo "<br> Error!";
	die();
}

}

}

mysqli_close($con);

?>


