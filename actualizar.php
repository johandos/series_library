<?php
    require_once("util/conexionDB/conexion.php");
    $conn = conectar();
    $id = $_GET['id'];
    //   echo $id;
    $sql = "SELECT * FROM platform WHERE id_platform='$id'";
    $query = mysqli_query($conn, $sql);
    $platform = mysqli_fetch_array($query);
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
    <title>Actualizar</title>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <h1 class="text-center">Actualizar Plataforma</h1>
    </div>
    <form action="update.php" method="post">
        <input type="text"
               name="id_platform"
               class="form-control mb-3"
               readonly
               value="<?php echo $platform['id_platform'] ?>"
        >
        <input type="text"
               name="plat_name"
               class="form-control mb-3"
               placeholder="Escribe tu nombre de plataforma"
               value="<?php echo $platform['plat_name'] ?>"
        >
        <input type="submit"
               value="Actualizar"
               class="btn btn-primary btn-block"
        >
        <button class="btn btn-dark" @onclick="location.redirect('indexTest.php')">
            Regresar
        </button>
    </form>
</body>
</html>
