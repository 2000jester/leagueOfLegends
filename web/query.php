<?php
class _query{

		public $dbPassword = "to do";
		public $dbServer = "to do";
		public $dbUserName = "to do";
		public $dbName = "riot_api_users";

		public $connection;

		function __construct(){

			$this->connection = new mysqli($this->dbServer, $this->dbUserName, $this->dbPassword, $this->dbName);

			if($this->connection->connect_errno){

			exit( "Database Connection Failed. Reason: ".$this->connection->connect_error);

			}
		}
	};
