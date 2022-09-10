<?php

include 'dbconfig.php';
 
 if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}

echo "<a href='logout.php'>logout</a>";
 
 $sql1 = "Select Fid, name from TECH3740.Faculty;";
 $result1 = mysqli_query($con, $sql1);
 
 
 //ask about * vs all columns
 $sql2 = "Select * from TECH3740.Rooms;";
 $result2 = mysqli_query($con, $sql2);

$cookie_name = "aid";

if(!isset($_COOKIE[$cookie_name])) {
	die ("<br>Please login first!");
}

?>

<h1 style='font-size: 20px'> Add a course </h1>

<form action="insert_course.php" method="post">
Course ID: <input type="text" name="course_id" size="5" required="required"> (ex: CPS1231)
<br>
Course Name: <input type="text" name="course_name" size="15" required="required">
<br>
Term: <input type="checkbox" name="term[]" value="Spring">Spring
	  <input type="checkbox" name="term[]" value="Summer">Summer
	  <input type="checkbox" name="term[]" value="Fall">Fall
<br>
Enrollment: <input type="text" name="enrollment" size="3" required="required"> (# of registered students)
<br>

Select a faculty: <select name="Faculty">

<?php
echo '<option value=""></option>';
 
while($row1 = mysqli_fetch_array($result1)) {
	$fid = $row1['Fid']; 
	$faculty = $row1['name'];
	echo "<option value=$fid>$faculty</option>";
}
?>

</select>

<br>


Room: <select name="Rooms">

<?php

echo '<option value=""></option>';

while($row2 = mysqli_fetch_array($result2)) {
	$building = $row2['Building'];
	$rid = $row2['Rid'];
	$roomno = $row2['Number'];
	$size = $row2['Size'];
	echo "<option value=$rid>$building  $roomno has $size seats</option>";
}
?>

</select>

<input type="submit" value="Submit">
</form>

<?php
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_close($con);
?>


