<?php
$pageTitle = "Series";
ob_start();
?>
<section>
    <h2>Series</h2>
    <p> Las series son como libros que se dividen en capítulos llamados episodios. En lugar de leerlos, los ves en tu televisor o dispositivo. Cada episodio es como un pedazo de la historia más grande.</p>
</section>
<div class="col-6 p-4">
    <a class="btn btn-primary" href="series/create">Crear Serie</a>
</div>
<section>
    <h2>Lista de series</h2>
    <table border="1">
        <thead>
        <tr>
            <th></th>
            <th>Título</th>
            <th>Subtítulo</th>
            <th>Imagen</th>
            <th>Sinopsis</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($seriesList as $key => $series) { ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $series->getTitle(); ?></td>
                <td><?php echo $series->getSubtitle(); ?></td>
                <td><img src="<?php echo $series->getImg(); ?>" alt="Imagen de la serie"></td>
                <td><?php echo $series->getSynopsis(); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Serie">
                        <a class="btn btn-success" href="series/edit?id=<?php echo $series->getId();?>">Editar</a>
                        &nbsp;&nbsp;

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $series->getId(); ?>">
                            Borrar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $series->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar serie</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar la serie <?php echo $series->getTitle(); ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" onclick="deleteElement(<?php echo $series->getId(); ?>)" class="btn btn-danger">Borrar</button>
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
            url: 'series/delete',
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