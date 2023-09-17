<?php
$pageTitle = "Series";
require_once 'Helper/ViewHelper.php';
ob_start();
include __DIR__ . '/../common/validate.php';
?>

<form name="edit_series" action="/series/update" method="POST">
    <input type="hidden" name="id" value="<?php echo $serie->getId(); ?>">
    <div class="mb-3">
        <label for="serieTitle" class="form-label">Título</label>
        <input type="text" class="form-control" id="serieTitle" name="title" value="<?php echo $serie->getTitle(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="serieSubtitle" class="form-label">Subtítulo</label>
        <input type="text" class="form-control" id="serieSubtitle" name="subtitle" value="<?php echo $serie->getSubtitle(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="serieImg" class="form-label">Imagen</label>
        <input type="text" class="form-control" id="serieImg" name="img" value="<?php echo $serie->getImg(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="serieTrailer" class="form-label">Tráiler</label>
        <input type="text" class="form-control" id="serieTrailer" name="trailer" value="<?php echo $serie->getTrailer(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="serieRating" class="form-label">Rating</label>
        <input type="number" class="form-control" id="serieRating" name="rating" value="<?php echo $serie->getRating(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="serieSynopsis" class="form-label">Sinopsis</label>
        <textarea class="form-control" id="serieSynopsis" name="synopsis" required><?php echo $serie->getSynopsis(); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="serieReleaseDate" class="form-label">Fecha de Lanzamiento</label>
        <input type="date" class="form-control" id="serieReleaseDate" name="releaseDate" value="<?php echo $serie->getReleaseDate(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="serieDirectorId" class="form-label">Director</label>
        <select class="form-control" id="serieDirectorId" name="directorId" required>
            <?php foreach ($directors as $director) { ?>
                <option value="<?php echo $director->getId(); ?>" <?php if ($director->getId() == $serie->getDirectorId()) echo 'selected'; ?>><?php echo $director->getName(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="serieGenreId" class="form-label">Género</label>
        <select class="form-control" id="serieGenreId" name="genreId" required>
            <?php foreach ($genders as $gender) { ?>

                <option value="<?php echo $gender->getId(); ?>" <?php if ($gender->getId() == $serie->getGenderId()) echo 'selected'; ?>><?php echo $gender->getDescription(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="serieRestrictionId" class="form-label">Restricción</label>
        <select class="form-control" id="serieRestrictionId" name="restrictionId" required>
            <?php foreach ($restrictions as $restriction) { ?>
                <option value="<?php echo $restriction->getId(); ?>" <?php if ($restriction->getId() == $serie->getRestrictionId()) echo 'selected'; ?>><?php echo $restriction->getRecomendations(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="serieStatus" class="form-label">Estado</label>
        <select class="form-control" id="serieStatus" name="status" required>
            <option value="1" <?php if ($serie->getStatus() == 1) echo 'selected'; ?>>Activa</option>
            <option value="0" <?php if ($serie->getStatus() == 0) echo 'selected'; ?>>Inactiva</option>
        </select>
    </div>
    <input type="submit" value="Guardar" class="btn btn-primary" name="updateBtn">
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../common/layout.php';
?>
