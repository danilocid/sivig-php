<?php
class DB
{
	private $host;
	private $db;
	private $user;
	private $password;
	private $amb = 'DEV';

	public function __construct()
	{
		if ($this->amb == 'DEV') {
			$this->host = 'localhost';
			$this->db = 'sivig';
			$this->user = 'root';
			$this->password = '';
		} else {
			$this->host = 'localhost';
			$this->db = 'orhanoik_SIVIG';
			$this->user = 'orhanoik_sivig';
			$this->password = 'sivig2021-';
		}
	}

	public function connect()
	{
		try {
			$connection = "mysql:host=" . $this->host . ";dbname=" . $this->db;
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			];
			$pdo = new PDO($connection, $this->user, $this->password, $options);

			return $pdo;
		} catch (PDOException $e) {
			print_r('Error conenection: ' . $e->getMessage());
		}
	}
}