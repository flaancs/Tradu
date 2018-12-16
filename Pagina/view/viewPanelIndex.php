<?php
    $usuarios = $db->con->query("SELECT * FROM usuarios");
    $partidas = $db->con->query("SELECT * FROM puntajes");
    $categorias = $db->con->query("SELECT * FROM categorias");

    $uCount = $usuarios->num_rows;
    $pCount = $partidas->num_rows;
    $cCount = $categorias->num_rows;
?>
<body class="grey lighten-2">
    <div class="header-emojis blue bg-emojis"></div>
    <div class="container header-emojis-content">
        <div class="col s12 m12 l12">
            <div class="card m-20">
                <div class="card-header grey lighten-3 grey-text text-darken-3">
					<h5>Panel de control</h5>
				</div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m12 l4">
                            <div class="card green lighten-1 z-depth-0">
                                <div class="card-content">
                                    <a href="/panel/categorias" class="btn white green-text waves-effect waves-light full-width m-5">Administrar Categorias</a>
                                    <a href="/panel/preguntas" class="btn white green-text waves-effect waves-light full-width m-5">Administrar preguntas</a>
                                    <a href="/panel/alternativas" class="btn white green-text waves-effect waves-light full-width m-5">Administrar alternativas</a>
                                    <a href="/panel/conexiones" class="btn white green-text waves-effect waves-light full-width m-5">Ver conexiones</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m12 l8">
                            <div class="row">
                                <div class="col s12 m12 l4">
                                    <div class="card blue z-depth-0">
                                        <div class="card-content white-text center">
                                            <h4><?php echo $uCount; ?></h4>
                                            <h6>Usuarios registrados</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m12 l4">
                                    <div class="card orange z-depth-0">
                                        <div class="card-content white-text center">
                                            <h4><?php echo $pCount; ?></h4>
                                            <h6>Partidas jugadas</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m12 l4">
                                    <div class="card green z-depth-0">
                                        <div class="card-content white-text center">
                                            <h4><?php echo $cCount; ?></h4>
                                            <h6>Categorias</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>