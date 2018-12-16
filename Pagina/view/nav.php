<?php
	$f->getUserLoggedData();
?>
<?php if ($f->isLoggedUser()): ?>
	<ul id="account_desktop" class="dropdown-content">
		<div class="dropdown-header blue">
			<div class="row">
				<div class="col s3">
					<img src="<?php echo $userData["foto_perfil"]; ?>" class="circle img-nav" alt="<?php echo htmlspecialchars($userData["nombres"]); ?>">
				</div>
				<div class="col s9 white-text">
					<h6><?php echo "<strong>".htmlspecialchars($userData["nombres"])."</strong></br>".htmlspecialchars($userData["apellidos"]); ?></h6>
				</div>
			</div>
		</div>
		<?php if ($userData["tipo_usuario"] > 1): ?>
			<li><a href="/panel" class="grey-text text-darken-2">Panel de administración<i class="material-icons">settings</i></a></li>
		<?php endif ?>
		<li><a href="/profile" class="grey-text text-darken-2">Mi perfil<i class="material-icons">person</i></a></li>
		<li><a href="/account" class="grey-text text-darken-2">Configuración de la cuenta <i class="material-icons">settings</i></a></li>
		<li><a href="/logout" class="grey-text text-darken-2"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></li>
	</ul>

	<div id="account_mobile" class="modal">
		<div class="dropdown-header blue">
			<div class="row">
				<div class="col s3">
					<img src="<?php echo $userData["foto_perfil"]; ?>" class="circle img-nav" alt="<?php echo htmlspecialchars($userData["nombres"]); ?>">
				</div>
				<div class="col s9">
					<h5 class="white-text"><?php echo "<strong>".htmlspecialchars($userData["nombres"])."</strong> ".htmlspecialchars($userData["apellidos"]); ?></h5>
				</div>
			</div>
		</div>
		<div class="modal-content">
			<a href="/profile" class="btn-flat full-width waves-effect">Mi perfil<i class="material-icons left">person</i></a>
			<a href="/account" class="btn-flat full-width waves-effect">Configuración de la cuenta <i class="material-icons left">settings</i></a>
			<a href="/logout" class="btn-flat full-width waves-effect"><i class="material-icons left">exit_to_app</i>Cerrar sesión</a>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
		</div>
	</div>
<?php endif ?>

<nav class="white" id="nav">
	<div class="container nav-wrapper">
		<a href="/" class="brand-logo grey-text text-darken-2"><?php echo $f->__get("SITE_LOGO"); ?></a>
		<a href="#" data-target="mobile-demo" class="grey-text text-darken-2 sidenav-trigger"><i class="material-icons">menu</i></a>
		<ul class="right hide-on-med-and-down">
			<li><a class="tooltipped btn-floating transparent waves-effect z-depth-0" data-position="bottom" data-tooltip="Sobre <?php echo $f->__get("SITE_NAME"); ?>" href="/info"><i class="material-icons grey-text">info</i></a></li>
			<li><a class="btn green waves-effect waves-light" href="/play">Jugar <i class="material-icons right white-text">local_play</i></a></li>
			<?php if ($f->isLoggedUser()): ?>
				<li><img data-target="account_desktop" href="#" src="<?php echo $userData["foto_perfil"]; ?>" class="dropdown-account circle img-nav" alt="<?php echo htmlspecialchars($userData["nombres"]); ?>"></li>
			<?php else: ?>
				<li><a class="btn-flat blue-text waves-effect waves-light" href="/login"><strong>Ingresar</strong></a></li>
			<?php endif ?>
		</ul>
	</div>
</nav>

<ul class="sidenav" id="mobile-demo">
	<li class="center"><a href="/" class="grey-text text-darken-2"><?php echo $f->__get("SITE_NAME"); ?></a></li>
	<?php if ($f->isLoggedUser()): ?>
		<li><a class="btn green waves-effect waves-light" href="/play">Jugar <i class="material-icons right white-text">local_play</i></a></li>
		<li><a class="btn blue waves-effect waves-light modal-trigger" href="#account_mobile">Mi cuenta <i class="material-icons right white-text">settings</i></a></li>
	<?php else: ?>
		<li><a class="btn blue waves-effect waves-light" href="/login">Ingresar</a></li>
	<?php endif ?>
	<?php if ($f->isLoggedUser() && $userData["tipo_usuario"] > 1): ?>
		<li><a href="/panel" class="btn blue waves-effect waves-light">Panel de administración<i class="material-icons">settings</i></a></li>
	<?php endif ?>
	<li><a class="grey-text text-darken-3" href="#">Sobre <?php echo $f->__get("SITE_NAME"); ?> <i class="material-icons">info</i></a></li>
</ul>