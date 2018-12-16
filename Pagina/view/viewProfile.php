<?php
    require_once("model/Perfil.php");

    if (isset($_GET['user']) && strlen($_GET['user']) > 0) {
        $username = $_GET['user'];
        $profileData = $db->con->query("SELECT p.*, u.tipo_usuario FROM perfiles AS p INNER JOIN usuarios AS u ON p.idUsuario = u.idUsuario WHERE p.nombre_usuario = '$username'");
    } else {
        if ($f->isLoggedUser()) {
            $idUsuario = $_SESSION['ID'];
            $profileData = $db->con->query("SELECT p.*, u.tipo_usuario FROM perfiles AS p INNER JOIN usuarios AS u ON p.idUsuario = u.idUsuario WHERE u.idUsuario = '$idUsuario'");
        } else {
            echo '<script>location.href="/"</script>';
        }
    }

    if ($profileData->num_rows > 0) {
        $p = $profileData->fetch_assoc();
        $idPerfil = $p['idPerfil'];
        $categorias_completadas = $db->con->query("SELECT cc.idCategoria_completada, c.nombre FROM categorias_completadas AS cc INNER JOIN categorias AS c ON cc.idCategoria = c.idCategoria WHERE cc.idPerfil = '$idPerfil' ORDER BY cc.idCategoria_completada DESC LIMIT 5");
        $cc_rows = $categorias_completadas->num_rows;
    } else {
        echo '<script>location.href="/"</script>';
    }
?>
<body class="grey lighten-2">
    <div class="row">
        <div class="header-emojis blue bg-emojis"></div>
            <div class="container header-emojis-content">
                <div class="col s12 m12 l10 offset-l1 m-20">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s3">
                                    <img class="perfil-img circle responsive-img" src="<?php echo $p['foto_perfil']; ?>" alt="<?php echo $p['nombres']." ".$p['apellidos']." - ".$f->__get("SITE_NAME"); ?>">
                                </div>
                                <div class="col s9">
                                    <h4><?php echo $p['nombres']." ".$p['apellidos']; ?></h4>
                                    <button class="btn blue waves-effect waves-light m-5">@<?php echo $p['nombre_usuario']; ?></button> 
                                    <?php if ($p['tipo_usuario'] > 1): ?>
                                        <button class="btn blue waves-effect waves-light m-5">Administrador <i class="material-icons left">verified_user</i></button>
                                    <?php endif ?>
                                    <?php 
                                        if  ($f->isLoggedUser()) {
                                            if ($p['idUsuario'] == $_SESSION['ID']) { 
                                                echo '<a href="/account" class="btn blue waves-effect waves-light m-5">Editar perfil <i class="material-icons left">edit</i></a>'; 
                                            } 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l5 offset-l1">
                    <div class="card">
                        <div class="card-header grey lighten-3 grey-text text-darken-3">
                            <h5>Estadisticas</h5>
                        </div>
                        <div class="card-content center">
                            <div class="row">
                                <div class="col s6">
                                    <div class="card teal lighten-2 white-text z-depth-0">
                                        <div class="card-content">
                                            <h6>Experiencia</h6>
                                            <h3 class="bold"><?php echo $p['exp']; ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s6">
                                    <div class="card green lighten-1 white-text z-depth-0">
                                        <div class="card-content">
                                            <h6>Nivel</h6>
                                            <h3 class="bold"><?php echo Perfil::getNivel($p['idUsuario']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l5">
                    <div class="card">
                        <div class="card-header grey lighten-3 grey-text text-darken-3">
                            <h5>Ultimas 5 partidas</h5>
                        </div>
                        <?php if ($cc_rows > 0): ?>
                            <?php while ($cc = $categorias_completadas->fetch_assoc()) { ?>
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s2">
                                            <a class="btn-floating blue z-depth-0 white-text" href="#"><i class="material-icons">star</i></a>
                                        </div>
                                        <div class="col s10">
                                            <h5><?php echo $cc['nombre']; ?></h5>
                                            <p class="green-text"><strong>Completada</strong></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php else: ?>
                            <div class="card-content center">
                                <p>Aun no has completado ninguna categoria, juega para completar categorias y subir de nivel.</p><br>
                                <a href="/play" class="btn green waves-effect waves-light"><i class="material-icons left">local_play</i> Jugar</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
    </div>
</body>