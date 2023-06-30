<?php
    require_once('./controllers/PlatformController.php');
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
    <title>Biblioteca</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Biblioteca de plataformas</h1>
            </div>
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Plataformas</h5>
                                <p class="card-text">Listado y gestión de las plataformas creadas en BBDD.</p>
                                <a class="btn btn-primary" href="views/platforms/list.php">Listado de plataformas</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Idiomas</h5>
                                <p class="card-text">Listado y gestión de los idiomas.</p>
                                <a class="btn btn-primary" href="views/platforms/ejemplo.php">Ejemplo PHP</a>
                                <!--                                <a class="btn btn-primary" href="views/idioms/list.php">Listado de idiomas</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Directores</h5>
                                <p class="card-text">Listado y gestión de los directores creados.</p>
                                <a class="btn btn-primary" href="views/directors/list.php">Listado de directores</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Actores</h5>
                                <p class="card-text">Listado y gestión de los actores creados.</p>
                                <a class="btn btn-primary" href="views/actors/list.php">Listado de actores</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Series</h5>
                                <p class="card-text">Listado y gestión de los series creados.</p>
                                <a class="btn btn-primary" href="views/series/list.php">Listado de series</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>