<?php
	class GlobalFuncs {
		private $SITE_NAME;
		private $SITE_LOGO;
		private $SITE_DEBUG;
		private $SITE_MAINTENANCE;
		private $SITE_MOBILE_COLOR;
		private $SITE_FAVICON;
		private $SITE_TITLE;
		private $SITE_DESCRIPTION;
		private $SITE_KEYWORDS;

		//Toast
		public function displayMsg($msg) {
			$toast = "<script>M.toast({html: '{$msg}'});</script>"; 
			echo $toast;
		}

		public function isLoggedUser() {
			if (isset($_SESSION['LOGGED']) && $_SESSION['LOGGED'] == true) {
				return true;
			} else {
				return false;
			}
		}

		public function isLoggedAdmin() {
			global $db;

			if ($this->isLoggedUser()) {
				$idUsuario = $_SESSION['ID'];
				$usuario = $db->con->query("SELECT * FROM usuarios WHERE idUsuario = '$idUsuario'");
				$uData = $usuario->fetch_assoc();

				if ($uData['tipo_usuario'] > 1) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public function getUserLoggedData() {
			global $db;

			if ($this->isLoggedUser()) {
				$idUsuario = $_SESSION['ID'];
				$usuario = $db->con->query("SELECT * FROM usuarios WHERE idUsuario = '$idUsuario'");
				$perfil = $db->con->query("SELECT * FROM perfiles WHERE idUsuario = '$idUsuario'");
				$u = $usuario->fetch_assoc();
				$p = $perfil->fetch_assoc();

				$GLOBALS['userData'] = array('tipo_usuario' => $u['tipo_usuario'], 'foto_perfil' => $p['foto_perfil'], 'nombres' => $p['nombres'], 'apellidos' => $p['apellidos']);
			} else {
				return null;
			}
		}

		//Metodo magicos get y set
		public function __get($property) {
		    if (property_exists($this, $property)) {
		      return $this->$property;
		    }
		}

		public function __set($property, $value) {
		    if (property_exists($this, $property)) {
		      	$this->$property = $value;
		    }
		}
	}
?>