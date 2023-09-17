<?php


    $pageTitle = "Plataformas";
    require_once 'Helper/ViewHelper.php';
    ob_start();
    include __DIR__ . '/../common/validate.php';
?>

    <form name="create_platform" action="/platforms/store" method="POST">
        <div class="mb-3">
            <label for="platformName" class="form-label">Nombre plataforma</label>
            <?php echo ViewHelper::input('platformName', 'text', 'Ingrese su nombre'); ?>
        </div>
        <input type="submit" value="Crear" class="btn btn-primary" >
    </form>

<?php
    $content = ob_get_clean();
    include __DIR__ . '/../common/layout.php';
?>