<?php

namespace Controller;

use Models\Platform;
use Controller\BaseController;

require_once __DIR__ . '/../Models/Platform.php';
require_once  __DIR__ . '/BaseController.php';

class PlatformsController extends BaseController
{
    public function index()
    {
        // Obtener la lista de plataformas desde el modelo
        $model = new Platform();
        $platforms = $model->getAll();

        $viewPath = __DIR__ . '/../views/platforms/index.php';

        print $this->render($viewPath, ['platforms' => $platforms]);
    }

    public function create()
    {
        $viewPath = __DIR__ . '/../views/platforms/create.php';
        print $this->render($viewPath);
    }

    public function store()
    {
        $newPlatform = new Platform();
        $newPlatform->insert($_POST['platformName']);


        header("Location: /platforms");
        exit();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $platform = new Platform();
        $platform = $platform->findOne($id);

        $viewPath = __DIR__ . '/../views/platforms/edit.php';
        print $this->render($viewPath, ['platform' => $platform]);
    }

    public function update()
    {
        $newPlatform = new Platform();
        $newPlatform->update($_POST['platformId'], $_POST['platformName']);

        header("Location: /platforms");
        exit();
    }

    public function delete()
    {
        $newPlatform = new Platform();
        $newPlatform->delete($_POST['id']);

        return 'ok';
    }
}
