<?php
$pageTitle = "Plataformas";
require_once 'Helper/ViewHelper.php';
ob_start();
?>

    <form name="create_platform" action="/platforms/store" method="POST">
        <div class="mb-3">
            <label for="plat_name" class="form-label">Nombre plataforma</label>
            <?php echo ViewHelper::input('plat_name', 'text', 'Ingrese su nombre'); ?>
        </div>
        <input type="submit" value="Crear" class="btn btn-primary" >
    </form>

<?php
    $content = ob_get_clean();
    include __DIR__ . '/../common/layout.php';
?>