<?php
    require_once("util/conexionDB/conexion.php");
    $conn = conectar();
    $sql = "SELECT * FROM platform";
    $query = mysqli_query($conn, $sql);
    //   echo "test";
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
    <title>Test Conect</title>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <h1 class="text-center">Tu-Escape</h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h3>Ingresar nueva plataforma</h3>
            <form action="insertar.php" method="post">
                <input type="text"
                       name="plat_name"
                       class="form-control mb-3"
                       placeholder="Escribe tu nombre de plataforma">
                <input type="submit"
                       value="Insertar"
                       class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-8">
            <div class="row">
                <h3 class="text-center">
                    Plataformas
                </h3>
            </div>
            <table class="table">
                <thead class="table-success table-striped">
                <tr>
                    <th>Código</th>
                    <th>Nombre Plataforma</th>
                    <th>
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['id_platform'] ?>
                        </td>
                        <td>
                            <?php echo $row['plat_name'] ?>
                        </td>
                        <td>
                            <a href="actualizar.php?id=<?php echo $row['id_platform'] ?>"
                               class="btn btn-warning">Editar</a>
                            |
                            <a href="delete.php?id=<?php echo $row['id_platform'] ?>"
                               class="btn btn-danger">Borrar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>

</html>

