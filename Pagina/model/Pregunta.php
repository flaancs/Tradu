<?php
    require_once("Config.php");

    class Pregunta {
        public static function editar($id, $pregunta, $imagen, $idCategoria) {
            global $db;

            $pst = $db->con->prepare("UPDATE preguntas SET pregunta = ?, imagen = ?, idCategoria = ? WHERE idPregunta = ?");
            $pst->bind_param("ssii", $pregunta, $imagen, $idCategoria, $id);

            if ($pst->execute()) {
                $pst->close();
                return true;
            } else {
                $pst->close();
                return false;
            }
        }

        public static function eliminar($id) {
            global $db;

            $eliminar = $db->con->query("DELETE FROM preguntas WHERE idPregunta = '$id'");

            if ($eliminar) {
                return true;
            } else {
                return false;
            }
        }

        public static function crear($pregunta, $imagen, $idCategoria) {
            global $db;

            $pst = $db->con->prepare("INSERT INTO preguntas (pregunta, imagen, idCategoria) VALUES (?,?,?)");
            $pst->bind_param("ssi", $pregunta, $imagen, $idCategoria);

            if ($pst->execute()) {
                $pst->close();
                return true;
            } else {
                $pst->close();
                return false;
            }
        }
    }
?>