<?php
// alter table tbl_login add column privelage text NOT NULL after nama;
//defined('BASEPATH') or exit('No direct script access allowed');
 
$hostname  =  'localhost';
$username  =  'root';
$password  =  '';
$database  =  'gaibai';  
// User: gaiw6978_aa
// Database: gaiw6978_gabi


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $hostname,
	'username' => $username,
	'password' => $password,
	'database' => $database,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
); 

// DB_CONNECTION=mysql
// DB_HOST=remotemysql.com
// DB_PORT=3306
// DB_DATABASE=xLsPT1t5xP
// DB_USERNAME=xLsPT1t5xP
// DB_PASSWORD=IndoigmKTO
