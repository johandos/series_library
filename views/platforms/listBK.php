<?php
require_once('../../controllers/PlatformController.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0"
          crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de plataformas</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Listado de plataformas</h1>
            </div>
            <div class="col-6">
                <a class="btn btn-primary" href="create.php">Crear plataformas</a>
            </div>
            <div class="col-12">
                <?php
                    $platformList = listPlatforms();

                    if( count($platformList) > 0 ){
                ?>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($platformList as $platform) {
                        ?>
                            <tr>
                                <td><?php echo $platform->getId();?></td>
                                <td><?php echo $platform->getName();?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Platform">
                                        <a class="btn btn-success" href="edit.php?id=<?php echo $platform->getId();?>">Editar</a>
                                        &nbsp;&nbsp;
                                        <form name="delete_platform" action="delete.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="platformId" value="<?php echo $platform->getId();?>" />
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    } else {
                ?>
                <div class="alert alert-warning" role="alert">
                    Aún no existen plataformas.
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>