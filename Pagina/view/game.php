<div id="categoria_completa" class="modal categoria_completa">
	<div class="modal-content center">
		<i class="material-icons small blue-text">star</i>
		<i class="material-icons medium blue-text">star</i>
		<i class="material-icons small blue-text">star</i>
		<h4>¡Has finalizado!</h4>
		<p>Has finalizado la categoria, puedes volver a jugar cuando quieras para practicar o juntar más puntos</p><hr>
		<p>Obtuviste</p>
		<h2 id="puntaje_final" class="green-text"></h2>
		<p>Puntos</p>
		<a href="#" class="waves-effect waves-light btn green final">Continuar</a>
	</div>
</div>
<div id="respuesta_correcta" class="modal respuesta_correcta">
	<div class="modal-content center">
		<i class="material-icons medium green-text">assignment_turned_in</i>
		<h4>¡Correcto!</h4>
		<p>¡Sigue así para conseguir más puntos!</p>
		<a href="#!" autofocus class="waves-effect waves-light btn green next">Siguiente pregunta</a>
	</div>
</div>
<div id="respuesta_incorrecta" class="modal respuesta_incorrecta">
	<div class="modal-content center">
		<i class="material-icons medium red-text">assistant_photo</i>
		<h4>¡Incorrecto!</h4>
		<p>Tu respuesta no fue correcta, no te preocupes, en la proxima te irá mejor</p>
		<a href="#!" autofocus class="waves-effect waves-light btn green next">Siguiente pregunta</a>
	</div>
</div>
<body class="grey lighten-3" id="games">
	<div class="row">
		<div class="container">
			<div class="col s12 m12 l10 offset-l1 game">
				<h3 class="grey-text text-darken-1"><strong><?php echo $c['nombre']; ?></strong></h3>
				<div class="progress blue lighten-3">
					<div class="determinate blue" style="width: 0%;" id="pregunta"></div>
				</div>
				<div class="card">
					<div class="card-content">
						<div class="imagen_pregunta">
							<img src="" id="pregunta_imagen" alt="" class="responsive-img">
						</div>
						<h5 class="grey-text"><strong id="pregunta_texto"></strong></h5>
						<div class="row">
							<div class="col s12 m12 l6 stop r1">
								<a href="#!" id="respuesta1" class="full-width m-20 btn-large blue"></a>
							</div>
							<div class="col s12 m12 l6 stop r2">
								<a href="#!" id="respuesta2" class="full-width m-20 btn-large orange"></a>
							</div>
							<div class="col s12 m12 l6 stop r3">
								<a href="#!" id="respuesta3" class="full-width m-20 btn-large green"></a>
							</div>
							<div class="col s12 m12 l6 stop r4">
								<a href="#!" id="respuesta4" class="full-width m-20 btn-large red"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>