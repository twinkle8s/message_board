<?php
$hostname='localhost';
$database='Secret';
$my_name='twinkle8s';
$my_password='cindy';
$website_name="My SECERT";

mysql_connect($hostname, $my_name, $my_password) or die(mysql_error());
mysql_query("SET NAMES 'UTF8'");
mysql_select_db($database) or die(mysql_error());

function queryMysql($query)
{
	$result=mysql_query($query) or die(mysql_error());
	return $result;
}

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
	return mysql_real_escape_string($var);
}

function addPW($var)
{
	$pw1="ki@yf*w";
	$pw2="x%ola!q?";
	return sha1("$pw1$var$pw2");
}

function changeProfile($field, $new, $old)
{
	$query="UPDATE profile SET $field='$new' WHERE $field='$old'";
	$result=queryMysql($query);

	return $result;
}

?>