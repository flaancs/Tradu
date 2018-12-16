<?php
    if (!isset($_GET['action'])) {
        include_once("viewPanelIndex.php");
    } else {
        switch ($_GET['action']) {
            case "categorias":
                include_once("viewPanelCategorias.php");
                break;
            case "preguntas":
                include_once("viewPanelPreguntas.php");
                break;
            case "alternativas":
                include_once("viewPanelAlternativas.php");
                break;
            case "conexiones":
                include_once("viewPanelConexiones.php");
                break;
            default:
                $_SESSION['GLOBAL_MSG'] = "Ha ocurrido un error";
                echo '<script>location.href="/panel"</script>';
                break;
        }
    }
?>