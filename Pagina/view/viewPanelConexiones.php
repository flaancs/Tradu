<?php
    $conexiones = $db->con->query("SELECT * FROM conexiones ORDER BY idConexion ASC");
?>
<body class="grey lighten-2">
    <div class="blue bg-emojis header-emojis"></div>
    <div class="row">
        <div class="container header-emojis-content">
            <div class="col m12 s12 l10 offset-l1">
                <div class="card">
                    <div class="card-content">
                        <a href="/panel" class="btn orange waves-effect waves-light">Volver <i class="material-icons left">keyboard_arrow_left</i></a>
                        <table>
                            <thead>
                            <tr>
                                <th>Direccion IP</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($conexiones->num_rows > 0): ?>
                            <?php while($cData = $conexiones->fetch_assoc()): 
                                $idUsuario = $cData['idUsuario'];
                                $perfil = $db->con->query("SELECT * FROM perfiles WHERE idUsuario = '$idUsuario'");
                                $pData = $perfil->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?php echo $cData['ip']; ?></td>
                                    <td><?php echo $cData['fecha']; ?></td>
                                    <td>@<?php echo $pData['nombre_usuario']; ?></td>
                                </tr>
                            <?php endwhile ?>
                            <?php else: ?>
                            <td>Aun no hay conexiones</td>
                            <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>