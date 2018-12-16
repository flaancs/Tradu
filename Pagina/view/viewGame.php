<?php
    require_once("model/Juego.php");

    $idCategoria = $_SESSION['gameData']['Categoria'];
    $pregunta = $_SESSION['gameData']['Pregunta'];
    $puntos = $_SESSION['gameData']['Puntos'];
    $idUsuario = $_SESSION['ID'];

    $categoria = $db->con->query("SELECT * FROM categorias WHERE idCategoria = '$idCategoria'");
    $c = $categoria->fetch_assoc();

    $preguntas = $db->con->query("SELECT * FROM preguntas WHERE idCategoria = '$idCategoria'");
    $preguntasArray = array();
    while ($pData = $preguntas->fetch_assoc()) {
        array_push($preguntasArray, $pData['idPregunta']);
    }

    $idPreguntaActual = $preguntasArray[$pregunta];
    $pregunta_actual = $db->con->query("SELECT * FROM preguntas WHERE idPregunta = '$idPreguntaActual'");
    $paData = $pregunta_actual->fetch_assoc();

    $respuestas = $db->con->query("SELECT * FROM alternativas WHERE idPregunta = '$idPreguntaActual'");
    $colors = array("green", "red", "blue", "orange");
?>
<script>
    $(function() {
        $('.modal_correcto').modal();
        $('.modal_incorrecto').modal();
    });
</script>
<?php if (isset($_SESSION['GLOBAL_MODAL']) && $_SESSION['GLOBAL_MODAL'] == "Correcto") { ?>
    <script>
        $(function() {
            $('.modal_correcto').modal('open');
        });
    </script>
    <div id="modal_finalizar" class="modal modal_correcto">
        <div class="modal-content center">
            <i class="material-icons large green-text">assignment_turned_in</i>
            <h4 class="bold green-text text-darken-1">Correcto</h4>
            <p>Sigue asi para ganar mas puntos</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light btn green">Siguiente pregunta</a>
        </div>
    </div>
<?php } ?>
<?php if (isset($_SESSION['GLOBAL_MODAL']) && $_SESSION['GLOBAL_MODAL'] == "Incorrecto") { ?>
    <script>
        $(function() {
            $('.modal_incorrecto').modal('open');
        });
    </script>
    <div id="modal_incorrecto" class="modal modal_incorrecto">
        <div class="modal-content center">
        <i class="material-icons large red-text">flag</i>
            <h4 class="bold red-text text-darken-1">Incorrecto</h4>
            <p>Tranquilo! en la proxima pregunta te ira mejor</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light btn green">Siguiente pregunta</a>
        </div>
    </div>
<?php } ?>
<body class="grey lighten-3">
    <div class="row">
        <div class="container">
            <div class="col s12 m12 l12 m-20">
                <h3 class="bold grey-text text-darken-1"><?php echo $c['nombre']; ?></h3>
                <div class="progress">
                    <div class="determinate blue" style="width: <?php echo (100/sizeof($preguntasArray))*($pregunta); ?>%;"></div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="imagen_pregunta">
                            <img src="<?php echo $paData['imagen']; ?>" alt="">
                        </div>
                        <h5 class="grey-text text-darken-1"><?php echo $paData['pregunta']; ?></h5>
                        <div class="row">
                            <?php
                                $x = 0;
                                while ($r = $respuestas->fetch_assoc()) {
                                    if ($pregunta == (sizeof($preguntasArray)-1)) {
                                        $action = "finalizar";
                                    } else {
                                        $action = "comprobar";
                                    }

                                    echo '<div class="col s12 m12 l6">';
                                    echo "<form action='/controller/juegoController.php' method='post'>";
                                    echo "<input type='hidden' name='select' value='".SED::enc($r['idAlternativa'])."'>";
                                    echo "<button type='submit' value='".$action."' name='game' class='btn-large full-width ".$colors[$x]."'>".$r['alternativa']."</button>";
                                    echo "</form>";
                                    echo '</div>';
                                    $x++;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>