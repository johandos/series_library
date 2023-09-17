<?php
$pageTitle = "Idiomas";
require_once 'Helper/ViewHelper.php';
ob_start();
include __DIR__ . '/../common/validate.php';
?>

<form name="edit_language" action="/language/update" method="POST">
    <div class="mb-3">
        <label for="lenguageId" class="form-label">ID del Idioma</label>
        <?php echo ViewHelper::input('id', 'hidden', value: $language->getId()); ?>
        <?php echo $language->getId(); ?> <!-- Muestra el ID actual -->
    </div>
    <div class="mb-3">
        <label for="lenguageSub" class="form-label">Nombre del Idioma</label>
        <?php echo ViewHelper::input('subtitle', 'text', 'Ingrese el nombre', $language->getSubtitle()); ?>
    </div>
    <div class="mb-3">
        <label for="isoCode" class="form-label">Código ISO</label>
        <?php echo ViewHelper::input('isoCode', 'text', 'Ingrese el código ISO', $language->getIsoCode()); ?>
    </div>
    <div class="mb-3">
        <label for="lenguageAudio" class="form-label">Idioma de Audio</label>
        <?php echo ViewHelper::input('audio', 'text', 'Ingrese el idioma de audio', $language->getAudio()); ?>
    </div>
    <input type="submit" value="Guardar" class="btn btn-primary" name="updateBtn">
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>
