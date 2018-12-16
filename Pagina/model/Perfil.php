<?php
	require_once("Config.php");

	class Perfil {		
		private $nombre_usuario;
		private $nombres;
		private $apellidos;
		private $fecha_creacion;
		private $exp;
		private $foto_perfil;
		private $idUsuario;
		private $idNivel_lenguaje_señas;

		public function crear() {
			global $db;

			$pst = $db->con->prepare("INSERT INTO perfiles (nombre_usuario, nombres, apellidos, fecha_creacion, exp, foto_perfil, idUsuario, idNivel_lenguaje_señas) VALUES (?,?,?,?,?,?,?,?)");
			$pst->bind_param("ssssisii", $this->nombre_usuario, $this->nombres, $this->apellidos, $this->fecha_creacion, $this->exp, $this->foto_perfil, $this->idUsuario, $this->idNivel_lenguaje_señas);

			if ($pst->execute()) {
				$pst->close();
				return true;
			} else {
				$pst->close();
				return false;	
			}
		}

		public function buscarPerfil($username) {
			global $db;

			$pst = $db->con->prepare("SELECT * FROM perfiles WHERE nombre_usuario = ?");
			$pst->bind_param("s", $username);
			$pst->execute();
			$pst->store_result();
			$rows = $pst->num_rows;

			if ($rows > 0) {
				$pst->close();
				return true;
			} else {
				$pst->close();
				return false;
			}
		}

		public static function checkProfile() {
			global $db;

			$pst = $db->con->prepare("SELECT * FROM perfiles WHERE idUsuario = ?");
			$pst->bind_param("i", $_SESSION['ID']);
			$pst->execute();
			$pst->store_result();
			$rows = $pst->num_rows;

			if ($rows == 1) {
				$pst->close();
				return true;
			} else {
				$pst->close();
				return false;
			}
		}

		public static function profileIsActive() {
			global $db;

			$pst = $db->con->prepare("SELECT estado FROM perfiles WHERE idUsuario = ?");
			$pst->bind_param("i", $_SESSION['ID']);
			$pst->execute();
			$pst->store_result();
			$pst->bind_result($estado);
			$rows = $pst->num_rows;
			$pst->fetch();

			if ($rows == 1) {
				if ($estado == 1) {
					$pst->close();
					return true;
				} else {
					$pst->close();
					return false;
				}
			}
		}

		public static function getNivel($id) {
			global $db;

			$perfil = $db->con->query("SELECT * FROM perfiles WHERE idUsuario = '$id'");
			$niveles = $db->con->query("SELECT * FROM niveles ORDER BY idNivel ASC");
			$nivel = 1;
			$p = $perfil->fetch_assoc();

			while ($n = $niveles->fetch_assoc()) {
				if ($p['exp'] >= $n['exp_necesaria']) {
					$nivel = $n['idNivel'];
				}
			}

			return $nivel;
		}

		public function __get($property) {
			if (property_exists($this, $property)) {
				return $this->$property;
			}
		}

		public function __set($property, $value) {
			if (property_exists($this, $property)) {
				$this->$property = $value;
			}
			return $this;
		}
	}
?>