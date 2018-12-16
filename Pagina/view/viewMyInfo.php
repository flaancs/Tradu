<?php 
	require_once("model/Perfil.php");
	$idUsuario = $_SESSION['ID'];
	$idNivel = Perfil::getNivel($idUsuario);

	$perfil = $db->con->query("SELECT * FROM perfiles WHERE idUsuario = '$idUsuario'");
	$niveles = $db->con->query("SELECT * FROM niveles WHERE idNivel = '$idNivel'");

	$p = $perfil->fetch_assoc();
	$n = $niveles->fetch_assoc();

	$idPerfil = $p['idPerfil'];
	$categorias_completadas = $db->con->query("SELECT cc.idCategoria_completada, c.nombre FROM categorias_completadas AS cc INNER JOIN categorias AS c ON cc.idCategoria = c.idCategoria WHERE cc.idPerfil = '$idPerfil' ORDER BY cc.idCategoria_completada DESC LIMIT 5");
	$cc_rows = $categorias_completadas->num_rows;
?>
<div class="row">
	<div class="col s12 m12 l5">
		<div class="card">
			<div class="card-header grey lighten-3 grey-text text-darken-3">
				<h5>Mis estadisticas</h5>
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
								<h3 class="bold"><?php echo $n['idNivel']; ?></h3>
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
				<h5>Mis ultimas 5 partidas</h5>
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