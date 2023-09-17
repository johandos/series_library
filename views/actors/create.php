<?php
$pageTitle = "Actores";
require_once 'Helper/ViewHelper.php';
ob_start();

include __DIR__. '/../common/validate.php';
?>

<form name="create_actor" action="/actors/store" method="POST">
    <div class="mb-3">
        <label for="actorName" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="actorName" name="name" placeholder="Ingrese el nombre" required>
    </div>
    <div class="mb-3">
        <label for="actorSurname" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="actorSurname" name="surname" placeholder="Ingrese el apellido" required>
    </div>
    <div class="mb-3">
        <label for="actorDateOfBirth" class="form-label">Fecha de Nacimiento</label>
        <input type="date" class="form-control" id="actorDateOfBirth" name="dateBirth" required>
    </div>
    <div class="mb-3">
        <label for="actorNationality" class="form-label">Nacionalidad</label>
        <input type="text" class="form-control" id="actorNationality" name="nationality" placeholder="Ingrese la nacionalidad" required>
    </div>
    <div class="mb-3">
        <label for="serieId" class="form-label">Serie</label>
        <select class="form-control" id="serieId" name="serieId" required>
            <?php foreach ($series as $serie) { ?>
                <option value="<?php echo $serie->getId(); ?>"><?php echo $serie->getTitle(); ?></option>
            <?php } ?>
        </select>
    </div>
    <input type="submit" value="Crear" class="btn btn-primary" >
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>
