<?php
    $pageTitle = "Plataformas";
    ob_start();
?>

    <form name="create_platform" action="/platforms/updated" method="POST">
        <div class="mb-3">
            <label for="platformName" class="form-label">Nombre plataforma</label>
            <input id="platformName" name="platformName" type="text" placeholder="Ingrese nombre de Plataforma" class="form-control" required/>
        </div>
        <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
    </form>

<?php
    $content = ob_get_clean();
    include __DIR__ . '/../common/layout.php';
?>