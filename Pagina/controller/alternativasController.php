<?php
	require_once("../model/Config.php");
	require_once("../model/Alternativa.php");

	$ac = new alternativasController();
	$ac->init();

	class alternativasController {
		public function init() {
			global $db;

			if (isset($_POST['alternativas'])) {
				$opt = $db->con->real_escape_string(htmlspecialchars($_POST['alternativas']));

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

            $route = "/panel/alternativas";
            $id = $db->con->real_escape_string(htmlspecialchars($_POST['id']));
            $alternativa = $db->con->real_escape_string(htmlspecialchars($_POST['alternativa']));
            $alternativa_correcta = $db->con->real_escape_string(htmlspecialchars($_POST['alternativa_correcta']));
            $idPregunta = $db->con->real_escape_string(htmlspecialchars($_POST['idPregunta']));

            if (Alternativa::editar($id, $alternativa, $alternativa_correcta, $idPregunta)) {
                $_SESSION['GLOBAL_MSG'] = "Alternativa editada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }

        public function eliminar() {
			global $db;

            $route = "/panel/alternativas";
            $id = $db->con->real_escape_string(htmlspecialchars($_POST['id']));

            if (Alternativa::eliminar($id)) {
                $_SESSION['GLOBAL_MSG'] = "Alternativa eliminada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }

        public function crear() {
			global $db;

            $route = "/panel/alternativas";
            $alternativa = $db->con->real_escape_string(htmlspecialchars($_POST['alternativa']));
            $alternativa_correcta = $db->con->real_escape_string(htmlspecialchars($_POST['alternativa_correcta']));
            $idPregunta = $db->con->real_escape_string(htmlspecialchars($_POST['idPregunta']));

            if (Alternativa::crear($alternativa, $alternativa_correcta, $idPregunta)) {
                $_SESSION['GLOBAL_MSG'] = "Alternativa creada exitosamente";
                header("Location: ".$route);
            } else {
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                header("Location: ".$route);
            }
        }
    }
?>