<?php
    include('../Controller/PlatformController.php');
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
            <h1>Crear plataforma</h1>
        </div>
        <div class="col-12">
            <form name="create_platform" action="" method="POST">
                <div class="mb-3">
                    <label for="platformName" class="form-label">Nombre plataforma</label>
                    <input id="platformName" name="platformName" type="text" placeholder="Ingrese nombre de Plataforma" class="form-control" required/>
                </div>
                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
            </form>
            <?php
                $sendData = false;
                $platformCreated = false;
                if (isset($_POST['createBtn'])){
                    $sendData = true;
                }
                if ($sendData){
                    if (isset($_POST['platformName'])){
                        $platformCreated = storePlatform($_POST['platformName']);
                    }
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>
