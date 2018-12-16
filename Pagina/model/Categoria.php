<?php
    require_once("Config.php");

    class Categoria {
        public static function editar($id, $nombre, $icono, $nivel_necesario) {
            global $db;

            $pst = $db->con->prepare("UPDATE categorias SET nombre = ?, icono = ?, nivel_necesario = ? WHERE idCategoria = ?");
            $pst->bind_param("ssii", $nombre, $icono, $nivel_necesario, $id);

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

            $eliminar = $db->con->query("DELETE FROM categorias WHERE idCategoria = '$id'");

            if ($eliminar) {
                return true;
            } else {
                return false;
            }
        }

        public static function crear($nombre, $icono, $nivel_necesario) {
            global $db;

            $pst = $db->con->prepare("INSERT INTO categorias (nombre, icono, nivel_necesario) VALUES (?,?,?)");
            $pst->bind_param("ssi", $nombre, $icono, $nivel_necesario);

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