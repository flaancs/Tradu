<?php
	require_once("../model/Config.php");
	require_once("../model/Categoria.php");

	$cc = new categoriasController();
	$cc->init();

	class categoriasController {
		public function init() {
			global $db;

			if (isset($_POST['categoria'])) {
				$opt = $db->con->real_escape_string(htmlspecialchars($_POST['categoria']));

				switch ($opt) {
					case "editar":
						$this->editar();
                        break;
                    case "eliminar":
						$this->eliminar();
                        break;
                    case "crear":
						$this->crear();
						break;
					default:
						$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
						break;
				}
			}
		}

		public function editar() {
			global $db;

            $route = "/panel/categorias";
            $id = $db->con->real_escape_string(htmlspecialchars($_POST['id']));
            $nombre = $db->con->real_escape_string(htmlspecialchars($_POST['nombre']));
            $icono = $db->con->real_escape_string(htmlspecialchars($_POST['icono']));
            $nivel_necesario = $db->con->real_escape_string(htmlspecialchars($_POST['nivel_necesario']));

            if (Categoria::editar($id, $nombre, $icono, $nivel_necesario)) {
                $_SESSION['GLOBAL_MSG'] = "Categoria editada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }

        public function eliminar() {
			global $db;

            $route = "/panel/categorias";
            $id = $db->con->real_escape_string(htmlspecialchars($_POST['id']));

            if (Categoria::eliminar($id)) {
                $_SESSION['GLOBAL_MSG'] = "Categoria eliminada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }

        public function crear() {
			global $db;

            $route = "/panel/categorias";
            $nombre = $db->con->real_escape_string(htmlspecialchars($_POST['nombre']));
            $icono = $db->con->real_escape_string(htmlspecialchars($_POST['icono']));
            $nivel_necesario = $db->con->real_escape_string(htmlspecialchars($_POST['nivel_necesario']));

            if (Categoria::crear($nombre, $icono, $nivel_necesario)) {
                $_SESSION['GLOBAL_MSG'] = "Categoria creada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }
    }
?>