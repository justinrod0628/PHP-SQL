<?php
 
include 'dbconfig.php';
 
 if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}
 
 $sql = "Select * from dreamhome.Staff;";
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
	<table border="1px" style="width:475px; line-height:20px; text-align: center;"> 
	<tr colspan="8";> 
			  <th> staffno </th> 
			  <th> fname </th> 
			  <th> lname </th> 
			  <th> position </th>
			  <th> sex </th> 
			  <th> DOB </th> 
			  <th> salary </th>
			  <th> branchno </th> 
	</tr> 
 
<?php 

while ($row = mysqli_fetch_array($result)){

if($row['sex'] == "M"){ ?>

<tr>
		<td> <?php echo $row['staffNo']; ?></td>
		<td> <?php echo $row['fName']; ?></td>
		<td> <?php echo $row['lName']; ?></td>
		<td> <?php echo $row['position']; ?></td>
			 <?php echo "<td>" . "<font color=BLUE>" . $row['sex'] . "</td>"; ?>
		<td> <?php echo $row['DOB']; ?></td>
		<td> <?php echo $row['salary']; ?></td>
		<td> <?php echo $row['branchNo']; ?></td>
    
	</tr>
<?php
}

if($row['sex'] == "F"){ ?>

<tr>
		<td> <?php echo $row['staffNo']; ?></td>
		<td> <?php echo $row['fName']; ?></td>
		<td> <?php echo $row['lName']; ?></td>
		<td> <?php echo $row['position']; ?></td>
			 <?php echo "<td>" . "<font color=RED>" . $row['sex'] . "</td>"; ?>
		<td> <?php echo $row['DOB']; ?></td>
		<td> <?php echo $row['salary']; ?></td>
		<td> <?php echo $row['branchNo']; ?></td>
   
	</tr>
<?php
}

else if ($row['sex'] != "M" && $row['sex'] !=  "F"){ ?>
	<tr>
		<td> <?php echo $row['staffNo']; ?></td>
		<td> <?php echo $row['fName']; ?></td>
		<td> <?php echo $row['lName']; ?></td>
		<td> <?php echo $row['position']; ?></td>
	    <td> <?php echo $row['sex']; ?> </td>
		<td> <?php echo $row['DOB']; ?></td>
		<td> <?php echo $row['salary']; ?></td>
		<td> <?php echo $row['branchNo']; ?></td>
   
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





	