<?php
    require_once("model/Perfil.php");
    $categorias = $db->con->query("SELECT * FROM categorias");
    $idNivel = Perfil::getNivel($_SESSION['ID']);
?>
<script>
    $(function() {
        $('.modal_finalizar').modal();
    });
</script>
<?php if (isset($_SESSION['GLOBAL_MODAL']) && $_SESSION['GLOBAL_MODAL'] == "Finalizar") { ?>
    <script>
        $(function() {
            $('.modal_finalizar').modal('open');
        });
    </script>
    <div id="modal_finalizar" class="modal modal_finalizar">
        <div class="modal-content center">
            <i class="material-icons green-text text-darken-1 large">school</i>
            <h4 class="bold green-text text-darken-1">Has finalizado</h4>
            <p>Sigue jugando para desbloquear nuevas categorias y subir de nivel</p>
            <h5 class="bold grey-text text-darken-1">Obtuviste</h5>
            <h2 class="green-text text-darken-2"><?php echo $_SESSION['gameData']['Puntos']; ?></h2>
            <h5 class="bold grey-text text-darken-1">Puntos</h5>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light btn green">Continuar</a>
        </div>
    </div>
<?php 
        unset($_SESSION['gameData']);
        unset($_SESSION['GLOBAL_MODAL']);
    } 
?>
<body class="bg-emojis blue">
    <div class="row">
        <div class="container">
            <div class="col s12 m12 l12 m-20">
                <?php
                    include_once("viewCategorias.php");
                    include_once("viewMyInfo.php");
                ?>
            </div>
        </div>
    </div>
</body>