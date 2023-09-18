<?php

namespace Controller;

use Models\Platform;
use Controller\BaseController;
use Request;
use Validator;

require_once __DIR__ . '/../Models/Platform.php';
require_once __DIR__ . '/../Helper/Validator.php';
require_once __DIR__ . '/../Helper/Request.php';
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

    public function validation(): array
    {
        $request = new Request();

        $rules = [
            'platformName' => 'required|max:25|unique',
        ];


        $validator = new Validator($request->all(), $rules);
        return $validator->validate();
    }

    public function store()
    {
        $validated = $this->validation();
        session_start();

        if (count($validated) > 0){
            // Antes de la redirección
            $_SESSION['errors'] = [
                'value' => $validated,
                'timeout' => time() + 5, // Set the expiration timestamp
            ];

            // Redirección
            header("Location: /platforms/create");
        }

        $_SESSION['success'] = [
            'value' => 'Plataforma agregada correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
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
        session_start();
        $validated = $this->validation();

        if (count($validated) > 0){
            // Antes de la redirección
            $_SESSION['errors'] = [
                'value' => $validated,
                'timeout' => time() + 30, // Set the expiration timestamp
            ];

            // Redirección
            header("Location: /actors/edit?id={$_POST['id']}");
        }

        $newPlatform = new Platform();
        $newPlatform->update($_POST['platformId'], $_POST['platformName']);

        $_SESSION['success'] = [
            'value' => 'Plataforma actualizada correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
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
