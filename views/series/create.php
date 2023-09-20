<?php
$pageTitle = "Crear Serie";
require_once 'Helper/ViewHelper.php';
ob_start();
?>

<form name="create_series" action="/series/store" method="POST">
    <div class="mb-3">
        <label for="serieTitle" class="form-label">Título</label>
        <input type="text" class="form-control" id="serieTitle" name="title" required>
    </div>
    <div class="mb-3">
        <label for="serieSubtitle" class="form-label">Subtítulo</label>
        <input type="text" class="form-control" id="serieSubtitle" name="subtitle" required>
    </div>
    <div class="mb-3">
        <label for="serieImg" class="form-label">Imagen</label>
        <input type="file" class="form-control" id="serieImg" name="img" required>
    </div>
    <div class="mb-3">
        <label for="serieTrailer" class="form-label">Tráiler</label>
        <input type="text" class="form-control" id="serieTrailer" name="trailer" required>
    </div>
    <div class="mb-3">
        <label for="serieRating" class="form-label">Rating</label>
        <input type="number" class="form-control" max="9" min="0" id="serieRating" name="rating" required>
    </div>
    <div class="mb-3">
        <label for="serieSynopsis" class="form-label">Sinopsis</label>
        <textarea class="form-control" id="serieSynopsis" name="synopsis" required></textarea>
    </div>
    <div class="mb-3">
        <label for="serieReleaseDate" class="form-label">Fecha de Lanzamiento</label>
        <input type="date" class="form-control" id="serieReleaseDate" name="releaseDate" required>
    </div>
    <div class="mb-3">
        <label for="serieDirectorId" class="form-label">Director</label>
        <select class="form-control" id="serieDirectorId" name="directorId" required>
            <?php foreach ($directors as $director) { ?>
                <option value="<?php echo $director->getId(); ?>"><?php echo $director->getName(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="serieGenreId" class="form-label">Género</label>
        <select class="form-control" id="serieGenreId" name="genreId" required>
            <?php foreach ($genders as $gender) { ?>
                <option value="<?php echo $gender->getId(); ?>"><?php echo $gender->getDescription(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="serieRestrictionId" class="form-label">Restricción</label>
        <select class="form-control" id="serieRestrictionId" name="restrictionId" required>
            <?php foreach ($restrictions as $restriction) { ?>
                <option value="<?php echo $restriction->getId(); ?>"><?php echo $restriction->getRecomendations(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="serieStatus" class="form-label">Estado</label>
        <select class="form-control" id="serieStatus" name="status" required>
            <option value="1">Activa</option>
            <option value="0">Inactiva</option>
        </select>
    </div>
    <input type="submit" value="Crear Serie" class="btn btn-primary" >
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>
