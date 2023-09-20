<?php
$pageTitle = "Directores";
require_once 'Helper/StringHelper.php';
ob_start();
?>
<section>
    <h2>Resumen</h2>
    <p>Información resumida del panel de administración.</p>
</section>
<div class="col-6">
    <a class="btn btn-primary" href="directors/create">Crear Director</a>
</div>
<section>
    <h2>Directores</h2>
    <table border="1">
        <thead>
        <tr>
            <th></th>
            <th>Nombre del Director</th>
            <th>Apellido del Director</th>
            <th>Nacionalidad del Director</th>
            <th>Fecha nacimiento</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($directors as $key => $director) { ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $director->getName(); ?></td>
                <td><?php echo $director->getSurname(); ?></td>
                <td><?php echo $director->getNationality(); ?></td>
                <td><?php echo StringHelper::dateFormat($director->getDateBirth()); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Director">
                        <a class="btn btn-success" href="directors/edit?id=<?php echo $director->getId();?>">Editar</a>
                        &nbsp;&nbsp;

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $director->getId(); ?>">
                            Borrar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $director->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar director</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar al director <?php echo $director->getName(); ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" onclick="deleteElement(<?php echo $director->getId(); ?>)" class="btn btn-danger">Borrar</button>
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
            url: 'directors/delete',
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
