<?php
	require_once("Config.php");

	class Usuario {		
		private $email;
		private $contraseña;
		private $discapacidad_auditiva;
		private $fecha_creacion;

		public function registrar() {
			global $db;

			$pst = $db->con->prepare("INSERT INTO usuarios (email, contraseña, discapacidad_auditiva, fecha_creacion) VALUES (?,?,?,?)");
			$pst->bind_param("ssis", $this->email, $this->contraseña, $this->discapacidad_auditiva, $this->fecha_creacion);

			if ($pst->execute()) {
				$pst->close();
				return true;
			} else {
				$pst->close();
				return false;	
			}
		}

		public function login($mail, $pass) {
			global $db;
			$passHash = SED::enc($pass);

			$pst = $db->con->prepare("SELECT idUsuario,contraseña FROM usuarios WHERE email = ? AND contraseña = ?");
			$pst->bind_param("ss", $mail, $passHash);
			$pst->execute();
			$pst->store_result();
			$rows = $pst->num_rows;
			$pst->bind_result($idusuario, $contraseña);

			if ($rows == 1) {
				$pst->fetch();
				$_SESSION['LOGGED'] = true;
				$_SESSION['ID'] = $idusuario;
				$_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
				$fecha = date("Y-m-d H:i:s");

				$stmt = $db->con->prepare("INSERT INTO conexiones (ip, fecha, idUsuario) VALUES (?,?,?)");
				$stmt->bind_param("ssi", $_SERVER['REMOTE_ADDR'], $fecha, $idusuario);

				if ($stmt->execute()) {
					$pst->close();
					return true;
					
				} else {
					$pst->close();
					$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
					return false;
				}
			} else {
				$_SESSION['GLOBAL_MSG'] = "Tus datos son incorrectos";
				$pst->close();
				return false;
			}
		}

		public function buscarUsuario($mail) {
			global $db;

			$pst = $db->con->prepare("SELECT * FROM usuarios WHERE email = ?");
			$pst->bind_param("s", $mail);
			$result = $pst->execute();
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

		public static function actualizarDatos($datos) {
			global $db;

			$pstPerfiles = $db->con->prepare("UPDATE perfiles SET nombres = ?, apellidos = ? WHERE idUsuario = ?");
			$pstPerfiles->bind_param("ssi", $datos['Nombre'], $datos['Apellidos'], $_SESSION['ID']);

			if ($datos['passwordChange']) {
				$pstUsuario = $db->con->prepare("UPDATE usuarios SET email = ?, contraseña = ? WHERE idUsuario = ?");
				$pstUsuario->bind_param("ssi", $datos['Email'], $datos['Password'], $_SESSION['ID']);
			} else {
				$pstUsuario = $db->con->prepare("UPDATE usuarios SET email = ? WHERE idUsuario = ?");
				$pstUsuario->bind_param("si", $datos['Email'], $_SESSION['ID']);
			}

			if ($pstPerfiles->execute() && $pstUsuario->execute()) {
				return true;
				$pstPerfiles->close();
				$pstUsuario->close();
			} else {
				return false;
				$pstPerfiles->close();
				$pstUsuario->close();
			}
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