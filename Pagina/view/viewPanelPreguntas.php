<?php
    $preguntas = $db->con->query("SELECT * FROM preguntas ORDER BY idPregunta ASC");
    $categorias = $db->con->query("SELECT * FROM categorias");
?>
<?php if (isset($_GET['edit'])): ?>
    <script>
        $(function() {
            $('.modal_edit').modal('open');
        });
    </script>
    <?php
        $idEditar = $_GET['edit'];
        $editar = $db->con->query("SELECT * FROM preguntas WHERE idPregunta = '$idEditar'");
        $editarData = $editar->fetch_assoc();
    ?>
    <div id="modal_edit" class="modal modal_edit">
        <div class="modal-content">
            <form action="/controller/preguntasController.php" method="post">
                <div class="row">
                    <h5 class="bold grey-text text-darken-3">Editar pregunta</h5>
                    <input type="hidden" class="browser-default" name="id" value="<?php echo $editarData['idPregunta']; ?>" required>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Pregunta</p>
                        <input type="text" class="browser-default" name="pregunta" value="<?php echo $editarData['pregunta']; ?>" required>
                    </div>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Imagen (URL)</p>
                        <input type="text" class="browser-default" name="imagen" value="<?php echo $editarData['imagen']; ?>" required>
                    </div>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Categoria</p>
                        <select name="idCategoria" class="browser-default">
                        <?php
                            while ($categoriasData = $categorias->fetch_assoc()) {
                                $selected = "";

                                if ($categoriasData['idCategoria'] == $editarData['idCategoria']) {
                                    $selected = "selected";
                                }

                                echo "<option value='{$categoriasData['idCategoria']}' {$selected}>{$categoriasData['nombre']}</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="input-field col s12">
                       <button type="submit" name="preguntas" value="editar" class="btn green waves-effect waves-light right">Guardar</button> 
                       <button type="submit" name="preguntas" value="eliminar" class="btn red waves-effect waves-light">Eliminar categoria</button> 
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
        <form action="/controller/preguntasController.php" method="post">
            <div class="row">
                <h5 class="bold grey-text text-darken-3">Crear categoria</h5>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Pregunta</p>
                    <input type="text" class="browser-default" name="pregunta" required>
                </div>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Imagen (URL)</p>
                    <input type="text" class="browser-default" name="imagen" required>
                </div>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Categoria</p>
                    <select name="idCategoria" class="browser-default">
                        <?php
                             while ($categoriasData = $categorias->fetch_assoc()) {
                                echo "<option value='{$categoriasData['idCategoria']}'>{$categoriasData['nombre']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="input-field col s12">
                    <button type="submit" name="preguntas" value="crear" class="btn green waves-effect waves-light right">Crear pregunta</button> 
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
                                <th>Pregunta</th>
                                <th>Imagen</th>
                                <th>Categoria</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($preguntas->num_rows > 0): ?>
                            <?php while($pData = $preguntas->fetch_assoc()): 
                                $idCategoria = $pData['idCategoria'];
                                $cat = $db->con->query("SELECT * FROM categorias WHERE idCategoria = '$idCategoria'");
                                $c = $cat->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?php echo $pData['pregunta']; ?></td>
                                    <td><img src="<?php echo $pData['imagen']; ?>" width="100" alt="<?php echo $pData['imagen']; ?>"></td>
                                    <td><?php echo $c['nombre']; ?></td>
                                    <td>
                                        <a href="/panel/preguntas&edit=<?php echo $pData['idPregunta']; ?>" class="btn waves-effect waves-light orange"><i class="material-icons">edit</i></a> 
                                    </td>
                                </tr>
                            <?php endwhile ?>
                            <?php else: ?>
                                <td>Aun no hay preguntas</td>
                            <?php endif?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>