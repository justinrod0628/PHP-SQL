<?php

$cookie_name = "aid";

if(isset($_COOKIE[$cookie_name])){
echo $_COOKIE[$cookie_name] . " has been successfully logged out.";
unset($_COOKIE[$cookie_name]);
// empty value and expiration one hour before
$res = setcookie($cookie_name, '', time()-3600 );
echo "<br>";
echo "<br><a href='index.html'>Project home page</a>\n";
die();
}

if(!isset($_COOKIE[$cookie_name])){
	echo "You didn't login. Please click <a href='index.html'>here</a> to login.";
	echo "<br><a href='index.html'>Project home page</a>\n";
}

?>