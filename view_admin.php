<?php
 
include 'dbconfig.php';
 
 if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}
 
 $sql = "Select * from TECH3740.Admin;";
 $result = mysqli_query($con, $sql);
 
?>
 
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

while ($row = mysqli_fetch_array($result)){

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

?>

</table>

<?php

mysqli_free_result($result);
mysqli_close($con);
	
?>
	
</body>
</html>



