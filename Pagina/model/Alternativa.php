<?php
    require_once("Config.php");

    class Alternativa {
        public static function editar($id, $alternativa, $alternativa_correcta, $idPregunta) {
            global $db;

            $pst = $db->con->prepare("UPDATE alternativas SET alternativa = ?, alternativa_correcta = ?, idPregunta = ? WHERE idAlternativa = ?");
            $pst->bind_param("siii", $alternativa, $alternativa_correcta, $idPregunta, $id);

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

            $eliminar = $db->con->query("DELETE FROM alternativas WHERE idAlternativa = '$id'");

            if ($eliminar) {
                return true;
            } else {
                return false;
            }
        }

        public static function crear($alternativa, $alternativa_correcta, $idPregunta) {
            global $db;

            $pst = $db->con->prepare("INSERT INTO alternativas (alternativa, alternativa_correcta, idPregunta) VALUES (?,?,?)");
            $pst->bind_param("sii", $alternativa, $alternativa_correcta, $idPregunta);

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