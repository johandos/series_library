<?php
$pageTitle = "Plataformas";
ob_start();
?>
    <section>
        <h2>Resumen</h2>
        <p>Información resumida del panel de administración.</p>
    </section>
    <div class="col-6">
        <a class="btn btn-primary" href="platforms/create">Crear plataformas</a>
    </div>
    <section>
        <h2>Usuarios</h2>
        <table border="1">
            <thead>
            <tr>
                <th></th>
                <th>Nombre de la Plataforma</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($platforms as $key => $platform) { ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $platform->getName(); ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Platform">
                            <a class="btn btn-success" href="platforms/edit?id=<?php echo $platform->getId();?>">Editar</a>
                            &nbsp;&nbsp;

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $platform->getId(); ?>">
                                Borrar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $platform->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar plataforma</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Esta seguro de eliminar la plataforma <?php echo $platform->getName(); ?>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="deleteElement(<?php echo $platform->getId(); ?>)" class="btn btn-danger">Borrar</button>
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
                url: 'platforms/delete',
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