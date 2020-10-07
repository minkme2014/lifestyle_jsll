<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;
$active_record = TRUE;//ci version 2.x
$hostname ="localhost";

if($_SERVER['HTTP_HOST']=="localhost"){	
	$username = "root";
	$password = "";
	$database = $_COOKIE["dbname"];	
} else {
	$username = $_COOKIE["dbuser"];//local
	$password = $_COOKIE["dbpass"];//local
	$database = $_COOKIE["dbname"];	
}	
	
$db['default'] = array(
    'dsn'   => '',
    'hostname' => $hostname,
	'username' => $username,
	'password' => $password,
	'database' => $database,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'autoinit' => TRUE,//ci version 2.x
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
 