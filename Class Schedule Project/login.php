<?php

$ip = $_SERVER['REMOTE_ADDR'];   
echo "<BR>Your IP: $ip\n";

 $blogin=$_POST['username'];
 $bpassword=$_POST['password'];

$IPv4 = explode(".",$ip);   #split token

if (($IPv4[0]=="10") || ($IPv4[0] . "." . $IPv4[1] =="131.125") ) { 
  echo "<br>You are from Kean University.\n"; 
} else { 
	echo "<br>You are NOT from Kean University.\n";
}

include 'dbconfig.php';

$con = mysqli_connect($host, $username, $password, $dbname) or die("<br>Cannot connect to DB:$dbname on $host\n");

$sql1= "SELECT * FROM TECH3740.Admin where login= '$blogin' ";

$sql2= "SELECT timestampdiff(year, dob, now() ) as age from TECH3740.Admin where login='$blogin' ";

$result1 = mysqli_query($con, $sql1); 


//watch for sql injection

if ($result1) {
	if (mysqli_num_rows($result1) > 0) {
	    while($row1 = mysqli_fetch_array($result1)){
	        $dblogin = $row1["login"];
	        $dbpassword=$row1["password"];
	        $result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_array($result2);
			if ($dblogin == $blogin && $dbpassword == $bpassword){
	        	echo "<br><a href='logout.php'>logout</a>\n";
	        	$aid = $row1["aid"];
				setcookie("aid", $aid, time() + 3600);
				echo "<br> Welcome user: " . $row1['name'];
				echo "<br> dob: " . $row1['dob'];
				echo "<br> Address: " . $row1['Address'];
				echo "<br> Gender: " . $row1['gender'];
				echo "<br> Age: " . $row2['age'];
				echo "<br> Join date: " . $row1['join_date'];
				
	        }
			if ($dblogin == $blogin && $dbpassword != $bpassword){
				echo "<br> User: $blogin is in the database, but wrong password was entered.";
				die();
			}
			
	    }
	    echo "</TABLE>\n";
	} 
	else {
		echo "<br>User: $blogin is not in the database.";
		die();
	}
} 

else {
	echo "<br>Something wrong with the SQL." . mysqli_error($con);
	die();
}

?>

<br>
<br>
<a href="add_course.php">Add a course</a>
<form action="search_course.php" method="get">
Search course (id or name):
<br>
<input type="text" name="keyword" size="20" required="">
<input type="submit" value="Search">
</form>

<?php

mysqli_free_result($result1);
mysqli_close($con);

?>



