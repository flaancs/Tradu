<?php
	$colors = array("blue", "orange", "green", "red");
?>
<div class="col s12 m12 l6">
	<div class="card">
		<div class="card-header center grey lighten-3 grey-text text-darken-3">
			<h5>Selecciona una categoria</h5>
		</div>
		<div class="card-content center">
			<div class="row">
				<?php while ($c = $categorias->fetch_assoc()) { ?>
					<?php 
					if ($idNivel >= $c['nivel_necesario']) {
						$enabled = true;
					} else {
						$enabled = false;
					}
					?>	
					<a href="<?php if ($enabled) { echo "game?play=".SED::enc($c['idCategoria']); } else { echo "#"; } ?>" <?php if (!$enabled) { echo 'onclick="M.toast({html: '."'Necesitas ser nivel {$c['nivel_necesario']} para jugar esta categoria'".'})"'; } ?> >
						<div class="col s6 m12 l12 grey-text text-darken-2">
							<div class="card z-depth-0 <?php if ($enabled) { echo $colors[array_rand($colors, 1)]." lighten-1 white-text"; } else { echo "grey lighten-3 grey-text"; } ?>">
								<div class="card-content">
									<i class="material-icons center"><?php echo $c['icono']; ?></i>
									<p><strong><?php echo $c['nombre']; ?></strong></p>
								</div>
							</div>
						</div>					
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>