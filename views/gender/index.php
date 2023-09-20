<?php
$pageTitle = "Géneros";
ob_start();
?>
<section>
    <h2>Genero</h2>
    <p>Los géneros son como etiquetas que describen el tipo de historia que estás a punto de ver. Algunas series son graciosas y te hacen reír, mientras que otras son emocionantes o asustadizas. Los géneros te ayudan a saber qué esperar.</p>
</section>
<div class="col-6 p-4">
    <a class="btn btn-primary" href="gender/create">Crear Género</a>
</div>
<section>
    <h2>Lista de géneros</h2>
    <table border="1">
        <thead>
        <tr>
            <th></th>
            <th>Descripción del Género</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($genders as $key => $gender) { ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $gender->getDescription(); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Género">
                        <a class="btn btn-success" href="gender/edit?id=<?php echo $gender->getId();?>">Editar</a>
                        &nbsp;&nbsp;

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $gender->getId(); ?>">
                            Borrar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $gender->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar género</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar el género <?php echo $gender->getDescription(); ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" onclick="deleteElement(<?php echo $gender->getId(); ?>)" class="btn btn-danger">Borrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

<script>
    function deleteElement(id) {
        // Realiza una solicitud Ajax
        $.ajax({
            url: 'gender/delete',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                // Redirige a la página especificada por el archivo PHP
                window.location.href = response;
            }
        });
    }
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>
