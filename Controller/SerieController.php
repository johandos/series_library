<?php

namespace Controller;

use models\Platform;

require_once __DIR__ . '/../models/Platform.php';
require_once  __DIR__ . '/BaseController.php';

class SerieController extends BaseController
{
    public function index()
    {
        // Obtener la lista de plataformas desde el modelo
        $model = new Platform();
        $platformList = $model->getAll();

        // Renderizar la vista y pasar los datos
        return $this->render('platforms/index.php', ['platformList' => $platformList]);
    }

    public function create()
    {
        // Renderizar la vista
        ob_start();
        include('./views/platforms/create.php');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function store()
    {
        $newPlatform = new Platform();
        $newPlatform->insert($_POST['platformName']);


        header("Location: /");
        exit();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $platform = new Platform();
        $platform = $platform->findOne($id);

        // Renderizar la vista
        ob_start();
        include('./views/platforms/edit.php');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function updated()
    {
        $newPlatform = new Platform();
        $newPlatform->updated($_POST['platformId'], $_POST['platformName']);


        header("Location: /");
        exit();
    }

    public function delete()
    {
        $newPlatform = new Platform();
        $newPlatform->delete($_POST['platformId']);

        header("Location: /");
        exit();
    }
}
