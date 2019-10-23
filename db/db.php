<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'blog';
$user = 'root';
$password = 'root';

class Db {
	public $host;
	public $dbname;
	public $user;
	public $password;

	public function __construct($host, $dbname, $user=NULL, $password=NULL) {
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->password = $password;
	}

	public function getConnection() {
    	$dsn = "mysql:host={$this->host};dbname={$this->dbname}";
    	$db = new PDO($dsn, $this->user, $this->password);
    	$db->exec("set names utf8");

    	return $db;
  	}
}

$db = new Db($host, $dbname, $user, $password);