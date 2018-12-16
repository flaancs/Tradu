<?php
	require_once("Config.php");

	class Juego {
		public static function subirPuntaje($id, $puntaje, $categoria) {
			global $db;

			$perfil = $db->con->query("SELECT * FROM perfiles WHERE idUsuario = '$id'");
			$p = $perfil->fetch_assoc();
			$puntaje_final = $puntaje + $p['exp'];

			$subir = $db->con->query("UPDATE perfiles SET exp = '$puntaje_final' WHERE idUsuario = '$id'");

			if ($subir) {
				$categoria_completada = $db->con->query("INSERT INTO categorias_completadas (idPerfil, idCategoria) VALUES ('$id', '$categoria')");
				if ($categoria_completada) {
					$fecha = date("Y-m-d H:i:s");
					$idPerfil = $p['idPerfil'];
					$puntaje_add = $db->con->query("INSERT INTO puntajes (puntuacion, fecha, idPerfil, idCategoria) VALUES ('$puntaje_final', '$fecha', '$idPerfil', '$categoria')");
					if ($puntaje_add) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public static function cargarPreguntas($categoria) {
			global $db;

			$preguntas = array();
			$pregunta = $db->con->query("SELECT * FROM preguntas WHERE idCategoria = '$categoria'");

			while ($p = $pregunta->fetch_assoc()) {
				array_push($preguntas, $p['idPregunta']);
			}

			return $preguntas;
		}

		public static function cargarRespuestas($pregunta) {
			global $db;

			$respuestas = array();
			$respuesta = $db->con->query("SELECT * FROM alternativas WHERE idPregunta = '$pregunta'");

			while ($r = $respuesta->fetch_assoc()) {
				array_push($respuestas, $r['idAlternativa']);
			}

			return $respuestas;
		}

		public static function comprobarRespuesta($respuesta) {
			global $db;

			$respuesta = $db->con->query("SELECT * FROM alternativas WHERE idAlternativa = '$respuesta'");
			$r = $respuesta->fetch_assoc();

			if ($r['alternativa_correcta'] > 0) {
				return true;
			} else {
				return false;
			}
		}
	}
?>