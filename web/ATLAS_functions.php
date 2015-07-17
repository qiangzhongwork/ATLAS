<?php
function database_connect() {
	$config = parse_ini_file('../.mysqlpasswd.ini');
	//Weird difference in parsing ini between Linux and Windows install
	$config['user'] = str_replace("'", "", $config['user']);
	$config['pass'] = str_replace("'", "", $config['pass']);
	$config['db'] = str_replace("'", "", $config['db']);
	$link = mysqli_connect('localhost', $config['user'], 
		  $config['pass'], $config['db']);
	if (!$link)   
	{   
	  $error = 'Unable to connect to the database server.';   
	  echo $error; 
	  exit();   
	}   
	if (!mysqli_set_charset($link, 'utf8'))   
	{   
	  $error = 'Unable to set database connection encoding.';   
	  echo $error;   
	  exit();   
	}  
	if (!mysqli_select_db($link, 'atlas'))   
	{   
	  $error3 = 'Unable to locate the atlas database.';   
	  echo $error;  
	  exit();   
	}
	return $link;
}
?>