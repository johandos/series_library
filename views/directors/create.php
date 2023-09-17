<?php
$pageTitle = "Directores";
require_once 'Helper/ViewHelper.php';
ob_start();
?>

    <form name="create_director" action="/directors/store" method="POST">
        <div class="mb-3">
            <label for="directorName" class="form-label">Nombre director</label>
            <?php echo ViewHelper::input('directorName', 'text', 'Ingrese su nombre'); ?>
        </div>
        <div class="mb-3">
            <label for="directorSurname" class="form-label">Apellido director</label>
            <?php echo ViewHelper::input('directorSurname', 'text', 'Ingrese su apellido'); ?>
        </div>
        <div class="mb-3">
            <label for="directorNacionality" class="form-label">Nacionalidad director</label>
            <?php echo ViewHelper::input('directorNacionality', 'text', 'Ingrese su nacionalidad'); ?>
        </div>
        <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
    </form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>