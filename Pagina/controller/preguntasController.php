<?php
	require_once("../model/Config.php");
	require_once("../model/Pregunta.php");

	$pc = new preguntasController();
	$pc->init();

	class preguntasController {
		public function init() {
			global $db;

			if (isset($_POST['preguntas'])) {
				$opt = $db->con->real_escape_string(htmlspecialchars($_POST['preguntas']));

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

            $route = "/panel/preguntas";
            $id = $db->con->real_escape_string(htmlspecialchars($_POST['id']));
            $pregunta = $db->con->real_escape_string(htmlspecialchars($_POST['pregunta']));
            $imagen = $db->con->real_escape_string(htmlspecialchars($_POST['imagen']));
            $idCategoria = $db->con->real_escape_string(htmlspecialchars($_POST['idCategoria']));

            if (Pregunta::editar($id, $pregunta, $imagen, $idCategoria)) {
                $_SESSION['GLOBAL_MSG'] = "Pregunta editada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }

        public function eliminar() {
			global $db;

            $route = "/panel/preguntas";
            $id = $db->con->real_escape_string(htmlspecialchars($_POST['id']));

            if (Pregunta::eliminar($id)) {
                $_SESSION['GLOBAL_MSG'] = "Pregunta eliminada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }

        public function crear() {
			global $db;

            $route = "/panel/preguntas";
            $pregunta = $db->con->real_escape_string(htmlspecialchars($_POST['pregunta']));
            $imagen = $db->con->real_escape_string(htmlspecialchars($_POST['imagen']));
            $idCategoria = $db->con->real_escape_string(htmlspecialchars($_POST['idCategoria']));

            if (Pregunta::crear($pregunta, $imagen, $idCategoria)) {
                $_SESSION['GLOBAL_MSG'] = "Pregunta creada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }
    }
?>