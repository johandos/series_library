<?php
$pageTitle = "Editar Género";
require_once 'Helper/ViewHelper.php';
ob_start();
include __DIR__ . '/../common/validate.php';
?>
<form name="edit_gender" action="/gender/update" method="POST">
    <div class="mb-3">
        <label for="genderId" class="form-label">ID del Género</label>
        <?php echo ViewHelper::input('genderId', 'hidden', value: $gender->getId()); ?>
    </div>
    <div class="mb-3">
        <label for="genderDescription" class="form-label">Descripción del Género</label>
        <?php echo ViewHelper::input('genderDescription', 'text', 'Ingrese la descripción del género', $gender->getDescription()); ?>
    </div>
    <input type="submit" value="Guardar" class="btn btn-primary" >
</form>


<?php
$content = ob_get_clean();

include __DIR__ . '/../common/layout.php';
?>
