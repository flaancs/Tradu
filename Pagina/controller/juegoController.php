<?php
	require_once("../model/Config.php");
	require_once("../model/Juego.php");

	$jc = new juegoController();
	$jc->init();

	class juegoController {
		public function init() {
			global $db;

			if (isset($_POST['game'])) {
				$opt = $db->con->real_escape_string(htmlspecialchars($_POST['game']));

				switch ($opt) {
					case "comprobar":
						$this->comprobar();
                        break;
                    case "finalizar":
						$this->finalizar();
						break;
					default:
						$_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
						break;
				}
			}
		}

		public function comprobar() {
			global $db;

            $route = "/game";
            $respuesta_seleccionada = $db->con->real_escape_string(htmlspecialchars(SED::dec($_POST['select'])));

            if (Juego::comprobarRespuesta($respuesta_seleccionada)) {
                $_SESSION['gameData']['Puntos'] += 10;
                $_SESSION['GLOBAL_MODAL'] = "Correcto";
            } else {
                $_SESSION['GLOBAL_MODAL'] = "Incorrecto";
            }

            $_SESSION['gameData']['Pregunta'] += 1;
            header("Location: ".$route);
        }
        
        public function finalizar() {
            global $db;

            $route = "/play";
            $id = $_SESSION['ID'];
            $puntaje = $_SESSION['gameData']['Puntos'];
            $categoria = $_SESSION['gameData']['Categoria'];

            Juego::subirPuntaje($id, $puntaje, $categoria);
            $_SESSION['GLOBAL_MODAL'] = "Finalizar";
            header("Location: ".$route);
        }
	}
?>