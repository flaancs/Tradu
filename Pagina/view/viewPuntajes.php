<?php
    $puntajes = $db->con->query("SELECT ptj.*, p.foto_perfil, p.nombres, p.apellidos, p.nombre_usuario FROM puntajes AS ptj INNER JOIN perfiles AS p ON ptj.idPerfil = p.idPerfil ORDER BY puntuacion DESC LIMIT 5");
?>
<div class="row">
    <div class="container">
        <h1 class="bold green-text text-darken-2 center">Ultimas partidas</h1>
        <div class="col s12 m12 l10 offset-l1">
            <div class="card">
                <div class="card-content">
                    <ul class="collection">
                        <?php 
                            if ($puntajes->num_rows > 0) {
                                while ($p = $puntajes->fetch_assoc()) { 
                        ?>
                            <li class="collection-item avatar">
                                <img src="<?php echo $p['foto_perfil']; ?>" alt="" class="circle">
                                <span class="title"><?php echo "{$p['nombres']} {$p['apellidos']} (@{$p['nombre_usuario']})"; ?></span>
                                <p><?php echo "{$p['puntuacion']} Puntos"; ?></p>
                                <a href="/profile/<?php echo $p['nombre_usuario']; ?>" class="secondary-content btn blue">Ver perfil <i class="material-icons right">person</i></a>
                            </li>
                        <?php 
                                } 
                            } else {
                                echo '<p class="center">Aun no hay mejores puntajes</p>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>