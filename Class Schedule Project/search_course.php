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

$keywordresult = $_GET["keyword"];
 
 $sql1 = "Select * from TECH3740_2021F.Courses_rjustin where cid like '%" . $keywordresult ."%' or name like '%" . $keywordresult ."%'";
 $sql2 = "Select * from TECH3740_2021F.Courses_rjustin;";
 $result1 = mysqli_query($con, $sql1);
 $result2 = mysqli_query($con, $sql2);
 
$total = 0;

if (mysqli_num_rows($result1) == 0 && $keywordresult != "*"){
	echo "<h2 style='font-size: 16px; font-weight: normal';> No course ID and name matched search keyword <b> $keywordresult</b>.</h2>";
	die();
}
 
else{ ?>
	
<!DOCTYPE html>
<html> 
	<head> 
	<style>
	th {font-weight:normal;}
	</style>
	</head> 
	<body> 
	<table border="1px" style="width:900px; line-height:20px; text-align: center;"> 
	<tr colspan="8";> 
			  <th> Course ID </th> 
			  <th> Course Name </th> 
			  <th> Faculty Name </th> 
			  <th> Term </th>
			  <th> Enrollment </th> 
			  <th> Building Room </th> 
			  <th> Size </th>
			  <th> Added by Admin </th> 
	</tr> 
<?php

if ($keywordresult == "*") {

	echo "<h2 style='font-size: 16px; font-weight: normal';> The following course ID and name were matched the search keyword <b> $keywordresult</b>.</h2>";
	
while ($row = mysqli_fetch_array($result2)){
		
	$Admin = $row['aid'];
	$sql4 = "Select name from TECH3740.Admin where aid = $Admin";
	$result4 = mysqli_query($con, $sql4);
	$Admin_name_query = mysqli_fetch_array($result4);
	$Admin_name = $Admin_name_query['name'];

	$Faculty = $row['Fid'];
	$sql5 = "Select name from TECH3740.Faculty where fid = $Faculty";
	$result5 = mysqli_query($con, $sql5);
	$Faculty_name_query = mysqli_fetch_array($result5);
	$Faculty_name = $Faculty_name_query['name'];

	$Rooms = $row['Rid'];
	$sql6 = "Select building from TECH3740.Rooms where rid = $Rooms";
	$result6 = mysqli_query($con, $sql6);
	$Building_name_query = mysqli_fetch_array($result6);
	$Building_name = $Building_name_query['building'];

	$sql7 = "Select number from TECH3740.Rooms where rid = $Rooms";
	$result7 = mysqli_query($con, $sql7);
	$Room_number_query = mysqli_fetch_array($result7);
	$Room_number = $Room_number_query['number'];

	$sql8 = "Select size from TECH3740.Rooms where rid = $Rooms";
	$result8 = mysqli_query($con, $sql8);
	$Room_size_query = mysqli_fetch_array($result8);
	$Room_size = $Room_size_query['size'];
 
	$Building_room = $Building_name . " " . $Room_number;


if($Room_size <= $row['enrollment'] + 2){ ?>

<tr style="text-align: left;">
		<td> <?php echo $row['cid']; ?></td>
		<td> <?php echo $row['name']; ?></td>
		<td> <?php echo $Faculty_name; ?> </td>
		<td> <?php echo $row['term']; ?></td>
			 <?php echo "<td>" . "<font color=RED>" . $row['enrollment'] . "</td>"; ?>
		<td> <?php echo $Building_room ; ?> </td>
		<td> <?php echo $Room_size; ?></td>
		<td> <?php echo $Admin_name; ?></td>
	</tr>
<?php

$total += $row['enrollment'];

}
 
 else { ?>

<tr style="text-align: left;">
		<td> <?php echo $row['cid']; ?></td>
		<td> <?php echo $row['name']; ?></td>
		<td> <?php echo $Faculty_name; ?> </td>
		<td> <?php echo $row['term']; ?></td>
		<td> <?php echo $row['enrollment']; ?> </td>
		<td> <?php echo $Building_room; ?> </td>
		<td> <?php echo $Room_size; ?></td>
		<td> <?php echo $Admin_name; ?></td>
	</tr>
	
<?php

$total += $row['enrollment'];
 
}
	}
}	
	
else {

 echo "<h2 style='font-size: 16px; font-weight: normal';> The following course ID and name were matched the search keyword <b> $keywordresult</b>.</h2>";


while ($row = mysqli_fetch_array($result1)){
	
	$Admin = $row['aid'];
	$sql4 = "Select name from TECH3740.Admin where aid = $Admin";
	$result4 = mysqli_query($con, $sql4);
	$Admin_name_query = mysqli_fetch_array($result4);
	$Admin_name = $Admin_name_query['name'];

	$Faculty = $row['Fid'];
	$sql5 = "Select name from TECH3740.Faculty where fid = $Faculty";
	$result5 = mysqli_query($con, $sql5);
	$Faculty_name_query = mysqli_fetch_array($result5);
	$Faculty_name = $Faculty_name_query['name'];

	$Rooms = $row['Rid'];
	$sql6 = "Select building from TECH3740.Rooms where rid = $Rooms";
	$result6 = mysqli_query($con, $sql6);
	$Building_name_query = mysqli_fetch_array($result6);
	$Building_name = $Building_name_query['building'];

	$sql7 = "Select number from TECH3740.Rooms where rid = $Rooms";
	$result7 = mysqli_query($con, $sql7);
	$Room_number_query = mysqli_fetch_array($result7);
	$Room_number = $Room_number_query['number'];

	$sql8 = "Select size from TECH3740.Rooms where rid = $Rooms";
	$result8 = mysqli_query($con, $sql8);
	$Room_size_query = mysqli_fetch_array($result8);
	$Room_size = $Room_size_query['size'];

	$Building_room = $Building_name . " " . $Room_number;

if($Room_size <= $row['enrollment'] + 2){ ?>

<tr style="text-align: left;">
		<td> <?php echo $row['cid']; ?></td>
		<td> <?php echo $row['name']; ?></td>
		<td> <?php echo $Faculty_name; ?></td>
		<td> <?php echo $row['term']; ?></td>
			 <?php echo "<td>" . "<font color=RED>" . $row['enrollment'] . "</td>"; ?>
		<td> <?php echo $Building_room ; ?> </td>
		<td> <?php echo $Room_size; ?></td>
		<td> <?php echo $Admin_name; ?></td>
	</tr>
	
	<?php
	
	$total += $row['enrollment'];
}
 
 else { ?>

<tr style="text-align: left;">
		<td> <?php echo $row['cid']; ?></td>
		<td> <?php echo $row['name']; ?></td>
		<td> <?php echo $Faculty_name; ?> </td>
		<td> <?php echo $row['term']; ?></td>
		<td> <?php echo $row['enrollment']; ?> </td>
		<td> <?php echo $Building_room; ?> </td>
		<td> <?php echo $Room_size; ?></td>
		<td> <?php echo $Admin_name; ?></td>
	</tr>
	
<?php

$total += $row['enrollment'];
 
}
}

}

?>

</table>

<?php

echo "Total Enrollment: $total";

}

mysqli_close($con);
	
?>
	
</body>
</html>

