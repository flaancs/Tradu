<?php
    $categorias = $db->con->query("SELECT * FROM categorias ORDER BY idCategoria ASC");
    $niveles = $db->con->query("SELECT * FROM niveles");
?>
<?php if (isset($_GET['edit'])): ?>
    <script>
        $(function() {
            $('.modal_edit').modal('open');
        });
    </script>
    <?php
        $idEditar = $_GET['edit'];
        $editar = $db->con->query("SELECT * FROM categorias WHERE idCategoria = '$idEditar'");
        $editarData = $editar->fetch_assoc();
    ?>
    <div id="modal_edit" class="modal modal_edit">
        <div class="modal-content">
            <form action="/controller/categoriasController.php" method="post">
                <div class="row">
                    <h5 class="bold grey-text text-darken-3">Editar categoria</h5>
                    <input type="hidden" class="browser-default" name="id" value="<?php echo $editarData['idCategoria']; ?>" required>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Nombre</p>
                        <input type="text" class="browser-default" name="nombre" value="<?php echo $editarData['nombre']; ?>" required>
                    </div>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Icono (Material Icons)</p>
                        <input type="text" class="browser-default" name="icono" value="<?php echo $editarData['icono']; ?>" required>
                    </div>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Nivel necesario</p>
                        <select name="nivel_necesario" class="browser-default">
                        <?php
                            while ($nivelesData = $niveles->fetch_assoc()) {
                                $selected = "";

                                if ($nivelesData[idNivel] == $editarData['nivel_necesario']) {
                                    $selected = "selected";
                                }

                                echo "<option value='{$nivelesData[idNivel]}' {$selected}>{$nivelesData[idNivel]}</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="input-field col s12">
                       <button type="submit" name="categoria" value="editar" class="btn green waves-effect waves-light right">Guardar</button> 
                       <button type="submit" name="categoria" value="eliminar" class="btn red waves-effect waves-light">Eliminar categoria</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>
<script>
    $(function() {
        $('#crear').click(function() {
            $('.modal_create').modal('open');
        });
    });
</script>
<div id="modal_create" class="modal modal_create">
    <div class="modal-content">
        <form action="/controller/categoriasController.php" method="post">
            <div class="row">
                <h5 class="bold grey-text text-darken-3">Crear categoria</h5>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Nombre</p>
                    <input type="text" class="browser-default" name="nombre" required>
                </div>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Icono (Material Icons)</p>
                    <input type="text" class="browser-default" name="icono" required>
                </div>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Nivel necesario</p>
                    <select name="nivel_necesario" class="browser-default">
                        <?php
                            while ($nivelesData = $niveles->fetch_assoc()) {
                                echo "<option value='{$nivelesData[idNivel]}'>{$nivelesData[idNivel]}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="input-field col s12">
                    <button type="submit" name="categoria" value="crear" class="btn green waves-effect waves-light right">Crear categoria</button> 
                </div>
            </div>
        </form>
    </div>
</div>
<body class="grey lighten-2">
    <div class="blue bg-emojis header-emojis"></div>
    <div class="row">
        <div class="container header-emojis-content">
            <div class="col m12 s12 l10 offset-l1">
                <div class="card">
                    <div class="card-content">
                        <a href="/panel" class="btn orange waves-effect waves-light">Volver <i class="material-icons left">keyboard_arrow_left</i></a>
                        <a href="#!" id="crear" class="btn green waves-effect waves-light">Crear nueva <i class="material-icons right">add</i></a>
                        <table>
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Icono (Material Icons)</th>
                                <th>Nivel necesario</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($categorias->num_rows > 0): ?>
                            <?php while($cData = $categorias->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $cData['nombre']; ?></td>
                                    <td><?php echo $cData['icono']; ?></td>
                                    <td><?php echo $cData['nivel_necesario']; ?></td>
                                    <td>
                                        <a href="/panel/categorias&edit=<?php echo $cData['idCategoria']; ?>" class="btn waves-effect waves-light orange"><i class="material-icons">edit</i></a> 
                                    </td>
                                </tr>
                            <?php endwhile ?>
                            <?php else: ?>
                            <td>Aun no hay categorias</td>
                            <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>