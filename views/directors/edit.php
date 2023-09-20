<?php
$pageTitle = "Editar Director";
require_once 'Helper/ViewHelper.php';
ob_start();
?>

    <form name="edit_director" action="/directors/update" method="POST">
        <div class="mb-3">
            <label for="directorName" class="form-label">Nombre director</label>
            <?php echo ViewHelper::input('directorId', 'hidden', value: $director->getId()); ?>
            <?php echo ViewHelper::input('directorName', 'text', 'Ingrese su nombre', $director->getName()); ?>
        </div>
        <div class="mb-3">
            <label for="directorSurname" class="form-label">Apellido director</label>
            <?php echo ViewHelper::input('directorSurname', 'text', 'Ingrese su apellido', $director->getSurname()); ?>
        </div>
        <div class="mb-3">
            <label for="directorNacionality" class="form-label">Nacionalidad director</label>
            <?php echo ViewHelper::input('directorNacionality', 'text', 'Ingrese su nacionalidad', $director->getNationality()); ?>
        </div>
        <div class="mb-3">
            <label for="dateBirth" class="form-label">Fecha nacimiento</label>
            <?php echo ViewHelper::input('dateBirth', 'date', '', $director->getdateBirth()); ?>
        </div>
        <input type="submit" value="Guardar" class="btn btn-primary" name="updateBtn">
    </form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>