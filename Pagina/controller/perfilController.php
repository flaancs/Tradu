<?php
	require_once("../model/Config.php");
	require_once("../model/Perfil.php");

	$pc = new perfilController();
	$pc->init();

	class perfilController {
		public function init() {
			global $db;

			if (isset($_POST['btnPerfil'])) {
				$opt = $db->con->real_escape_string(htmlspecialchars($_POST['btnPerfil']));

				switch ($opt) {
					case "crear":
						$this->crearPerfil();
						break;
					default:
						$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
						break;
				}
			}
		}

		public function crearPerfil() {
			global $db;
			global $f;

			$success_route = "/";
			$error_route = "/createprofile";

			$p = new Perfil();

			$username = $db->con->real_escape_string($_POST['username']);
			$nombres = $db->con->real_escape_string($_POST['nombres']);
			$apellidos = $db->con->real_escape_string($_POST['apellidos']);
			$nivel_señas = $db->con->real_escape_string($_POST['nivel_señas']);
			$img = "/uploads/default.php?user=".substr($nombres, 0, 1);
			$fecha = date("Y-m-d H:i:s");
			$error = false;

			$expe = $db->con->query("SELECT * FROM niveles_lenguaje_señas WHERE idNivel_lenguaje_señas = '$nivel_señas'");
			$e = $expe->fetch_assoc();
			$exp = $e['exp_extra'];

			if ($_FILES['foto']['name'] != null) {
				$nombre_archivo = $_FILES['foto']['name'];
			    $tipo_archivo = $_FILES['foto']['type'];
			    $tamano_archivo = $_FILES['foto']['size'];
			    $archivo = $_FILES['foto']['tmp_name'];
			    $target_dir = "../uploads/";
			    $target_file = $target_dir.$username."_".date("Y_m_d_H_i_s")."_".strtolower(str_replace(" ", "_", $nombre_archivo));

			    $permitidos = array("image/jpg", "image/png", "image/jpeg", "image/PNG");

			    if (in_array($tipo_archivo, $permitidos)) {
			    	if ($tamano_archivo < 50000000) {
			    		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
			    			$img =  "/uploads/".$username."_".date("Y_m_d_H_i_s")."_".strtolower(str_replace(" ", "_", $nombre_archivo));
			    		} else {
			    			$error = true;
			    			$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
			    		}

			    	} else {
			    		$error = true;
			    		$_SESSION['GLOBAL_MSG'] = "Tu imagen sobrepasa el limite (5MB)";
						header("Location: ".$error_route);
			    	}
			    } else {
			    	$error = true;
			    	$_SESSION['GLOBAL_MSG'] = "Tipo de archivo no permitido";
					header("Location: ".$error_route);
			    }
			}

			if (empty($username) || empty($nombres) || empty($apellidos)) {
				$error = true;
				$_SESSION['GLOBAL_MSG'] = "Debes rellenar todos los campos";
				header("Location: ".$error_route);
			} else if ($p->buscarPerfil($username)) {
				$error = true;
				$_SESSION['GLOBAL_MSG'] = "El nombre de usuario ya existe, escoge otro";
				header("Location: ".$error_route);
			} else if (!$error) {
				$p->__set("nombre_usuario", $username);
				$p->__set("nombres", $nombres);
				$p->__set("apellidos", $apellidos);
				$p->__set("fecha_creacion", $fecha);
				$p->__set("exp", $exp);
				$p->__set("foto_perfil", $img);
				$p->__set("idUsuario", $_SESSION['ID']);
				$p->__set("idNivel_lenguaje_señas", $nivel_señas);

				if ($p->crear()) {
					$_SESSION['GLOBAL_MSG'] = "Perfil creado exitosamente";
					$_SESSION['NOMBRES'] = $nombres;
					$_SESSION['APELLIDOS'] = $apellidos;
					$_SESSION['FOTO_PERFIL'] = $img;
					header("Location: ".$success_route);
				} else {
					$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
					header("Location: ".$error_route);
				}

			}
		}
	}
?>