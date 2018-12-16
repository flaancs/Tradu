<?php
    $alternativas = $db->con->query("SELECT * FROM alternativas ORDER BY idAlternativa ASC");
    $preguntas = $db->con->query("SELECT * FROM preguntas");
?>
<?php if (isset($_GET['edit'])): ?>
    <script>
        $(function() {
            $('.modal_edit').modal('open');
        });
    </script>
    <?php
        $idEditar = $_GET['edit'];
        $editar = $db->con->query("SELECT * FROM alternativas WHERE idAlternativa = '$idEditar'");
        $editarData = $editar->fetch_assoc();
    ?>
    <div id="modal_edit" class="modal modal_edit">
        <div class="modal-content">
            <form action="/controller/alternativasController.php" method="post">
                <div class="row">
                    <h5 class="bold grey-text text-darken-3">Editar alternativa</h5>
                    <input type="hidden" class="browser-default" name="id" value="<?php echo $editarData['idAlternativa']; ?>" required>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Alternativa</p>
                        <input type="text" class="browser-default" name="alternativa" value="<?php echo $editarData['alternativa']; ?>" required>
                    </div>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Tipo de alternativa</p>
                        <select name="alternativa_correcta" class="browser-default">
                            <?php
                                $correcta = false;
                                if ($editarData['alternativa_correcta'] == 1) {
                                    $correcta = true;
                                }
                            ?>
                            <option value="1" <?php if ($correcta){ echo "selected"; } ?>>Alternativa correcta</option>
                            <option value="0" <?php if (!$correcta){ echo "selected"; } ?>>Alternativa incorrecta</option>
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <p class="grey-text text-darken-2">Pregunta</p>
                        <select name="idPregunta" class="browser-default">
                        <?php
                            while ($preguntasData = $preguntas->fetch_assoc()) {
                                $selected = "";

                                if ($preguntasData['idPregunta'] == $editarData['idPregunta']) {
                                    $selected = "selected";
                                }

                                echo "<option value='{$preguntasData[idPregunta]}' {$selected}>{$preguntasData[pregunta]}</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="input-field col s12">
                       <button type="submit" name="alternativas" value="editar" class="btn green waves-effect waves-light right">Guardar</button> 
                       <button type="submit" name="alternativas" value="eliminar" class="btn red waves-effect waves-light">Eliminar categoria</button> 
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
        <form action="/controller/alternativasController.php" method="post">
            <div class="row">
                <h5 class="bold grey-text text-darken-3">Crear alternativa</h5>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Alternativa</p>
                    <input type="text" class="browser-default" name="alternativa" required>
                </div>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Tipo de alternativa</p>
                    <select name="alternativa_correcta" class="browser-default" required>
                        <option value="1">Alternativa correcta</option>
                        <option value="0">Alternativa incorrecta</option>
                    </select>
                </div>
                <div class="input-field col s12">
                    <p class="grey-text text-darken-2">Pregunta</p>
                    <select name="idPregunta" class="browser-default">
                        <?php
                            while ($preguntasData = $preguntas->fetch_assoc()) {
                                echo "<option value='{$preguntasData[idPregunta]}'>{$preguntasData[pregunta]}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="input-field col s12">
                    <button type="submit" name="alternativas" value="crear" class="btn green waves-effect waves-light right">Crear categoria</button> 
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
                                <th>Alternativa</th>
                                <th>Tipo de alternativa</th>
                                <th>Pregunta</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($alternativas->num_rows > 0): ?>
                            <?php while($aData = $alternativas->fetch_assoc()): 
                                $idPregunta = $aData['idPregunta'];
                                $p = $db->con->query("SELECT * FROM preguntas WHERE idPregunta = '$idPregunta'");
                                $pData = $p->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?php echo $aData['alternativa']; ?></td>
                                    <td><?php if ($aData['alternativa_correcta'] == 1){ echo "Alternativa Correcta"; } else { echo "Alternativa incorrecta"; }?></td>
                                    <td><?php echo $pData['pregunta']; ?></td>
                                    <td>
                                        <a href="/panel/alternativas&edit=<?php echo $aData['idAlternativa']; ?>" class="btn waves-effect waves-light orange"><i class="material-icons">edit</i></a> 
                                    </td>
                                </tr>
                            <?php endwhile ?>
                            <?php else: ?>
                            <td>Aun no hay alternativas</td>
                            <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>