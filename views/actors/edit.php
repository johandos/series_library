<?php
$pageTitle = "Actores";
require_once 'Helper/ViewHelper.php';
ob_start();
?>

<form name="edit_actor" action="/actors/update" method="POST">
    <input type="hidden" name="id" value="<?php echo $actor->getId(); ?>">
    <div class="mb-3">
        <label for="actorName" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="actorName" name="name" value="<?php echo $actor->getName(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="actorSurname" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="actorSurname" name="surname" value="<?php echo $actor->getSurname(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="actorDateOfBirth" class="form-label">Fecha de Nacimiento</label>
        <input type="date" class="form-control" id="actorDateOfBirth" name="dateBirth" value="<?php echo $actor->getDateBirth(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="actorNationality" class="form-label">Nacionalidad</label>
        <input type="text" class="form-control" id="actorNationality" name="nationality" value="<?php echo $actor->getNationality(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="serieId" class="form-label">Serie</label>
        <select class="form-control" id="serieId" name="serieId" required>
            <?php foreach ($series as $serie) { ?>
                <option value="<?php echo $serie->getId(); ?>" <?php if ($serie->getId() == $actor->getSerieId()) echo 'selected'; ?>><?php echo $serie->getTitle(); ?></option>
            <?php } ?>
        </select>
    </div>
    <input type="submit" value="Guardar" class="btn btn-primary" name="updateBtn">
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>
