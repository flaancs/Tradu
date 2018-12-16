<?php
    $idUsuario = $_SESSION['ID'];
    $profileData = $db->con->query("SELECT p.*, u.* FROM perfiles AS p INNER JOIN usuarios AS u ON p.idUsuario = u.idUsuario WHERE p.idUsuario = '$idUsuario'");
    $pD = $profileData->fetch_assoc();
?>
<body class="grey lighten-2">
    <div class="header-emojis blue bg-emojis"></div>
    <div class="row">
        <div class="container header-emojis-content">
            <div class="col s12 m12 l10 offset-l1">
                <div class="card">
                    <div class="card-header grey lighten-3 grey-text text-darken-3">
                        <h5>Actualizar datos</h5>
                    </div>
                    <div class="card-content">
                        <form action="controller/usuarioController.php" method="post">
                            <div class="row">
                                <div class="col s12 m12 l7">
                                    <div class="input-field col s12">
                                        <p class="grey-text text-darken-2">Nombre</p>
                                        <input type="text" class="browser-default" name="nombre" value="<?php echo $pD['nombres']; ?>" required>
                                    </div>
                                    <div class="input-field col s12">
                                        <p class="grey-text text-darken-2">Apellidos</p>
                                        <input type="text" class="browser-default" name="apellidos" value="<?php echo $pD['apellidos']; ?>" required>
                                    </div>
                                    <div class="input-field col s12">
                                        <p class="grey-text text-darken-2">Email</p>
                                        <input type="email" class="browser-default" name="email" value="<?php echo $pD['email']; ?>" required>
                                    </div>
                                    <div class="input-field col s12">
                                        <p class="grey-text text-darken-2">Contraseña</p>
                                        <input type="password" class="browser-default" name="password">
                                    </div>
                                    <div class="input-field col s12">
                                        <p class="grey-text text-darken-2">Confirmar contraseña</p>
                                        <input type="password" class="browser-default" name="repassword">
                                    </div>
                                    <div class="input-field col s12">
										<button type="submit" name="btnUser" value="actualizar" class="btn right green waves-effect waves-light full-width">Actualizar datos</button>
									</div>
                                </div>
                                <div class="col s12 m12 l5">
                                    <h5><strong>Importante</strong></h5>
                                    <p>Si no quieres actualizar tu contraseña simplemente deja el campo de texto vacio.</p>                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>