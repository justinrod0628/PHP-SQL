<?php
 
include 'dbconfig.php';

$keywordresult = $_GET["keyword"];
 
 if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}
 
 $sql1 = "Select * from TECH3740.Admin where Address like '%" . $keywordresult ."%'";
 $sql2 = "Select * from TECH3740.Admin;";
 $result1 = mysqli_query($con, $sql1); 
 $result2 = mysqli_query($con, $sql2);
 
 $numrows1 = mysqli_num_rows($result1);
 $numrows2 = mysqli_num_rows($result2);
 

if (mysqli_num_rows($result1) == 0 && $keywordresult != "*"){ ?> 

<?php

echo "<h2 style='font-size: 16px; font-weight: normal';> No records in the database for the keyword: <b> $keywordresult</b>.</h2>";
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
	<table border="1px" style="width:700px; line-height:20px; text-align: left;"> 
	<tr colspan="8";> 
			  <th> ID </th> 
			  <th> Login </th> 
			  <th> Password </th> 
			  <th> Name </th>
			  <th> DOB </th> 
			  <th> Join date </th> 
			  <th> Gender </th>
			  <th> Address </th> 
	</tr> 
<?php

if ($keywordresult == "*") {

	echo "<h2 style='font-size: 16px; font-weight: normal';> There are <b> $numrows2 </b> admin(s) in the database. </h2>";

	
	while ($row = mysqli_fetch_array($result2)){

if($row['dob'] == NULL){ ?>

<tr>
		<td> <?php echo $row['aid']; ?></td>
		<td> <?php echo $row['login']; ?></td>
		<td> <?php echo $row['password']; ?></td>
		<td> <?php echo $row['name']; ?></td>
			 <?php echo "<td>" . "<font color=RED>" . "NULL" . "</td>"; ?>
			 <?php echo "<td>" . "<font color=BLUE>" . $row['join_date'] . "</td>"; ?>
		<td> <?php echo $row['gender']; ?></td>
		<td> <?php echo $row['Address']; ?></td>
    
	</tr>
<?php
}

if($row['join_date'] < $row['dob']){ ?>

<tr>
		<td> <?php echo $row['aid']; ?></td>
		<td> <?php echo $row['login']; ?></td>
		<td> <?php echo $row['password']; ?></td>
		<td> <?php echo $row['name']; ?></td>
			 <?php echo "<td>" . "<font color=RED>" . $row['dob'] . "</td>"; ?>
			 <?php echo "<td>" . "<font color=RED>" . $row['join_date'] . "</td>"; ?>
		<td> <?php echo $row['gender']; ?></td>
		<td> <?php echo $row['Address']; ?></td>
   
	</tr>
<?php
}

else if ($row['join_date'] > $row['dob'] && $row['dob'] != NULL ) { ?>
	<tr>
		<td> <?php echo $row['aid']; ?></td>
		<td> <?php echo $row['login']; ?></td>
		<td> <?php echo $row['password']; ?></td>
		<td> <?php echo $row['name']; ?></td>
			 <?php echo "<td>" . "<font color=BLUE>" . $row['dob'] . "</td>"; ?>
			 <?php echo "<td>" . "<font color=BLUE>" . $row['join_date'] . "</td>"; ?>
		<td> <?php echo $row['gender']; ?></td>
		<td> <?php echo $row['Address']; ?></td>
   
	</tr>
<?php
}

}
	
}
else {

 echo "<h2 style='font-size: 16px; font-weight: normal';> There are <b> $numrows1 </b> admin(s) in the database that the address contains search keyword <b> $keywordresult</b>.</h2>";


while ($row = mysqli_fetch_array($result1)){

if($row['dob'] == NULL){ ?>

<tr>
		<td> <?php echo $row['aid']; ?></td>
		<td> <?php echo $row['login']; ?></td>
		<td> <?php echo $row['password']; ?></td>
		<td> <?php echo $row['name']; ?></td>
			 <?php echo "<td>" . "<font color=RED>" . "NULL" . "</td>"; ?>
			 <?php echo "<td>" . "<font color=BLUE>" . $row['join_date'] . "</td>"; ?>
		<td> <?php echo $row['gender']; ?></td>
		<td> <?php echo $row['Address']; ?></td>
    
	</tr>
<?php
}

if($row['join_date'] < $row['dob']){ ?>

<tr>
		<td> <?php echo $row['aid']; ?></td>
		<td> <?php echo $row['login']; ?></td>
		<td> <?php echo $row['password']; ?></td>
		<td> <?php echo $row['name']; ?></td>
			 <?php echo "<td>" . "<font color=RED>" . $row['dob'] . "</td>"; ?>
			 <?php echo "<td>" . "<font color=RED>" . $row['join_date'] . "</td>"; ?>
		<td> <?php echo $row['gender']; ?></td>
		<td> <?php echo $row['Address']; ?></td>
   
	</tr>
<?php
}

else if ($row['join_date'] > $row['dob'] && $row['dob'] != NULL ) { ?>
	<tr>
		<td> <?php echo $row['aid']; ?></td>
		<td> <?php echo $row['login']; ?></td>
		<td> <?php echo $row['password']; ?></td>
		<td> <?php echo $row['name']; ?></td>
			 <?php echo "<td>" . "<font color=BLUE>" . $row['dob'] . "</td>"; ?>
			 <?php echo "<td>" . "<font color=BLUE>" . $row['join_date'] . "</td>"; ?>
		<td> <?php echo $row['gender']; ?></td>
		<td> <?php echo $row['Address']; ?></td>
   
	</tr>
<?php
}

}
}
}
?>

</table>

<?php

mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_close($con);
	
?>
	
</body>
</html>
