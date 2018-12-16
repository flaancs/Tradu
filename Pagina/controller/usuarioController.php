<?php
	require_once("../model/Config.php");
	require_once("../model/Usuario.php");
	require_once("../model/Perfil.php");

	$uc = new usuarioController();
	$uc->init();

	class usuarioController {
		public function init() {
			global $db;

			if (isset($_POST['btnUser'])) {
				$opt = $db->con->real_escape_string(htmlspecialchars($_POST['btnUser']));

				switch ($opt) {
					case "ingresar":
						$this->ingresar();
						break;
					case "registrar":
						$this->registrar();
						break;
					case "actualizar":
						$this->actualizar();
						break;
					default:
						$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
						break;
				}
			}
		}

		public function registrar() {
			global $db;

			$success_route = "/login";
			$error_route = "/register";

			$u = new Usuario();

			$email = $db->con->real_escape_string($_POST['email']);
			$password = $db->con->real_escape_string($_POST['password']);
			$repassword = $db->con->real_escape_string($_POST['repassword']);
			$discapacidad = $db->con->real_escape_string($_POST['discapacidad']);
			$fecha = date("Y-m-d H:i:s");
			$error = false;

			if (empty($email) || empty($password) || empty($repassword)) {
				$error = true;
				$_SESSION['GLOBAL_MSG'] = "Debes rellenar todos los campos";
				header('Location: '.$error_route);
			} else if ($password != $repassword) {
				$error = true;
				$_SESSION['GLOBAL_MSG'] = "Tus contraseñas no coinciden";
				header('Location: '.$error_route);
			} else if ($u->buscarUsuario($email)) {
				$error = true;
				$_SESSION['GLOBAL_MSG'] = "Esta cuenta ya está registrada";
				header('Location: '.$error_route);
			} else if (!$error) {
				$passHash = SED::enc($password);
				$u->__set("email", $email);
				$u->__set("contraseña", $passHash);
				$u->__set("discapacidad_auditiva", $discapacidad);
				$u->__set("fecha_creacion", $fecha);

				if ($u->registrar()) {
					$_SESSION['GLOBAL_MSG'] = "Cuenta creada con exito";
					header('Location: '.$success_route);
				} else {
					$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
					header('Location: '.$error_route);
				}
			}
		}
		
		public function ingresar() {
			global $db;

			if ($_POST['continue'] != "") {
				$success_route = SED::dec($_POST['continue']);
			} else {
				$success_route = "/";
			}

			$error_route = "/login";

			$u = new Usuario();
			$mail = $db->con->real_escape_string($_POST['email']);
			$pass = $db->con->real_escape_string($_POST['password']);
			$error = false;

			if (empty($mail) || empty($pass)) {
				$error = true;
				$_SESSION['GLOBAL_MSG'] = "Debes rellenar todos los campos";
				header('Location: '.$error_route);
			} else if (!$error) {
				if ($u->login($mail, $pass)) {
					if (Perfil::checkProfile()) {
						if (Perfil::profileIsActive()) {
							header('Location: '.$success_route);
						} else {
							session_destroy();
							$_SESSION['GLOBAL_MSG'] = "Tu cuenta se encuentra desactivada, por favor contacta con un Administrador";
							header("Location: /");
						}
					} else {
						header("Location: /createprofile");
					}
				} else {
					header('Location: '.$error_route);
				}
			}
		}

		public function actualizar() {
			global $db;

			$success_route = "/profile";
			$error_route = "/account";

			$nombre = $db->con->real_escape_string($_POST['nombre']);
			$apellidos = $db->con->real_escape_string($_POST['apellidos']);
			$email = $db->con->real_escape_string($_POST['email']);
			$password = $db->con->real_escape_string($_POST['password']);
			$repassword = $db->con->real_escape_string($_POST['repassword']);
			$error = false;
			$passwordChange = false;

			if (empty($nombre) || empty($apellidos)  || empty($email)) {
				$error = true;
				$_SESSION['GLOBAL_MSG'] = "Debes rellenar todos los campos";
				header('Location: '.$error_route);
			}
			
			if (!empty($password)) {
				if ($password == $repassword) {
					$password = SED::enc($password);
					$passwordChange = true;
				} else {
					$error = true;
					$_SESSION['GLOBAL_MSG'] = "Tus contraseñas no coinciden";
					header('Location: '.$error_route);
				}
			}
			
			if (!$error) {
				$updateUser = array('Nombre' => $nombre, 'Apellidos' => $apellidos, 'Email' => $email, 'Password' => $password, 'passwordChange' => $passwordChange);
				
				if (Usuario::actualizarDatos($updateUser)) {
					$_SESSION['GLOBAL_MSG'] = "Tus datos fueron actualizados exitosamente";
					header('Location: '.$success_route);
				} else {
					$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
					header('Location: '.$error_route);
				}
			}
		}
	}
?>