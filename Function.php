<?php

include "lala.php";

$connect = new mysqli($hostname, $my_name, $my_password, $database);

if (!$connect)
{
	echo "connect to database error!";
}

$connect->query("SET NAMES UTF8");

function destroySessionData()
{
	$_SESSION=array();

	if (session_id()!="" || isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(), '', time()-2592000, '/');
	}

	session_destroy();
}

function sanitize($var)
{
	$var=strip_tags($var);
	$var=htmlentities($var);
	$var=stripslashes($var);
	return $var;
}

function addPW($var)
{
	$pw1="ki@yf*w";
	$pw2="x%ola!q?";
	return sha1("$pw1$var$pw2");
}
?>