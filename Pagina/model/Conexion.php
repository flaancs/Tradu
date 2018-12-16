<?php
	class Conexion {
		private $DB_HOST = "localhost";
		private $DB_USER = "root";
		private $DB_PASS = "";
		private $DB_NAME = "traduc";
		private $DB_CHARSET = "utf8";
		public $con = null;

		public function __construct() {
			$this->con = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

			if (!$this->con->connect_errno) {
				$this->con->set_charset($this->DB_CHARSET);
			} else {
				echo "Error: ".$this->con->connect_error;
				exit();
			}
		}
	}
?>