<?php
error_reporting(E_ALL);

$timezone = "Asia/Calcutta";
date_default_timezone_set($timezone);
$datetime = date('d-m-Y H:i:s');
$date = date('Y-m-d');

function &getConnection()
{
	//localhost
    $host = 'localhost';
    $db_name = 'scholargraph_facebook';
    $username = 'root';
    $password = '12345';

	//Heroku
	// $url = parse_url(getenv("DATABASE_URL"));
	// $host = $url["host"];
	// $db_name = substr($url["path"], 1);
	// $username = $url["user"];
	// $password = $url["pass"];

	try {
      $db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    	echo "Connection failed: " . $e->getMessage();
    }
    return $db;
}

function qExecute($sql)
{
	// echo $sql;
	global $db;
	return $db->query($sql);
}

function qExecuteAssocArray($sql)
{
	global $db;
	$rs = $db->query($sql);
	return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function qExecuteObject($sql)
{
	// echo $sql;
	global $db;
	$rs = $db->query($sql);
	return $rs->fetch(PDO::FETCH_OBJ);
}

function closeConnection ($db)
{
	$db = NULL;
}

?>
