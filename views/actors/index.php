<?php
$pageTitle = "Actores";
require_once 'Helper/StringHelper.php';
ob_start();
?>
<section>
    <h2>Resumen</h2>
    <p>Información resumida del panel de administración.</p>
</section>
<div class="col-6">
    <a class="btn btn-primary" href="actors/create">Crear Actor</a>
</div>
<section>
    <h2>Actores</h2>
    <table border="1">
        <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de Nacimiento</th>
            <th>Nacionalidad</th>
            <th>Serie Asociada</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($actors as $key => $actor) { ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $actor->getName(); ?></td>
                <td><?php echo $actor->getSurname(); ?></td>
                <td><?php echo StringHelper::dateFormat($actor->getDateBirth()); ?>
                <td><?php echo $actor->getNationality(); ?></td>
                <td><?php echo $actor->getSeriesName(); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Actor">
                        <a class="btn btn-success" href="actors/edit?id=<?php echo $actor->getId();?>">Editar</a>
                        &nbsp;&nbsp;

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $actor->getId(); ?>">
                            Borrar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $actor->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar actor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar el actor <?php echo $actor->getName(); ?> <?php echo $actor->getSurname(); ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" onclick="deleteElement(<?php echo $actor->getId(); ?>)" class="btn btn-danger">Borrar</button>
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
            url: 'actors/delete',
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
