<?php

namespace Controller;

use Controller\BaseController;
use Models\Gender;
use Request;
use Validator;

require_once __DIR__ . '/../Models/Gender.php';
require_once __DIR__ . '/../Helper/Validator.php';
require_once __DIR__ . '/../Helper/Request.php';
require_once __DIR__ . '/BaseController.php';

class GenderController extends BaseController
{
    public function index()
    {
        // Obtener la lista de plataformas desde el modelo
        $model = new Gender();
        $genders = $model->getAll();

        $viewPath = __DIR__ . '/../views/gender/index.php';

        print $this->render($viewPath, ['genders' => $genders]);
    }

    public function validation(): array
    {
        $request = new Request();

        $rules = [
            'genderDescription' => 'required|max:25',
        ];


        $validator = new Validator($request->all(), $rules);
        return $validator->validate();
    }

    public function create()
    {
        $viewPath = __DIR__ . '/../views/gender/create.php';
        print $this->render($viewPath);
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
            header("Location: /gender/create");
        }

        $newGender = new Gender();
        $newGender->insert($_POST['genderDescription']);

        $_SESSION['success'] = [
            'value' => 'Genero creado correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
        header("Location: /gender");
        exit();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $gender = new Gender();
        $gender = $gender->findOne($id);

        $viewPath = __DIR__ . '/../views/gender/edit.php';
        print $this->render($viewPath, ['gender' => $gender]);
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
            header("Location: /gender/edit?id={$_POST['id']}");
        }

        $newGender = new Gender();
        $newGender->update($_POST['genderId'], $_POST['genderDescription']);

        $_SESSION['success'] = [
            'value' => 'Genero actualizado correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
        header("Location: /gender");
        exit();
    }

    public function delete()
    {
        $newGender = new Gender();
        $newGender->delete($_POST['id']);

        return 'ok';
    }
}
