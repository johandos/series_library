<?php
$pageTitle = "Plataformas";
require_once 'Helper/ViewHelper.php';
ob_start();
?>

    <form name="create_language" action="/languages/store" method="POST">
        <div class="mb-3">
            <label for="lenguage_sub" class="form-label">Lenguaje</label>
            <?php echo ViewHelper::input('lenguage_sub', 'text', 'Ingrese el nombre del lenguaje'); ?>
        </div>
        <div class="mb-3">
            <label for="iso_code" class="form-label">Código ISO</label>
            <?php echo ViewHelper::input('iso_code', 'text', 'Ingrese el código ISO'); ?>
        </div>
        <div class="mb-3">
            <label for="lenguage_audio" class="form-label">Audio del Lenguaje</label>
            <?php echo ViewHelper::input('lenguage_audio', 'text', 'Ingrese el audio del lenguaje'); ?>
        </div>
        <input type="submit" value="Crear" class="btn btn-primary">
    </form>

<?php
    $content = ob_get_clean();
    include __DIR__ . '/../common/layout.php';
?>