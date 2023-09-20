<?php

namespace Controller;

use Models\Language;
use Request;
use Validator;

require_once __DIR__ . '/../Models/Language.php';
require_once __DIR__ . '/../Helper/Validator.php';
require_once __DIR__ . '/../Helper/Request.php';
require_once  __DIR__ . '/BaseController.php';

class LanguagesController extends BaseController
{
    public function index()
    {
        // Obtener la lista de plataformas desde el modelo
        $model = new Language();
        $languages = $model->getAll();

        $viewPath = __DIR__ . '/../views/language/index.php';

        print $this->render($viewPath, ['languages' => $languages]);
    }

    public function create()
    {
        $viewPath = __DIR__ . '/../views/language/create.php';
        print $this->render($viewPath);
    }

    public function validation(): array
    {
        $request = new Request();

        $rules = [
            'lenguage_sub' => 'required|max:25|unique:lenguage,id_leng',
            'iso_code' => 'required|max:25|unique:lenguage,id_leng',
            'lenguage_audio' => 'required|max:25',
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
            header("Location: /languages/create");
            exit();
        }

        $newLanguage = new Language();
        $newLanguage->insert($_POST['lenguage_sub'], $_POST['iso_code'], $_POST['lenguage_audio']);

        $_SESSION['success'] = [
            'value' => 'Lenguaje agregada correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
        header("Location: /languages");
        exit();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $language = new Language();
        $language = $language->findOne($id);

        $viewPath = __DIR__ . '/../views/language/edit.php';
        print $this->render($viewPath, ['language' => $language]);
    }

    public function update()
    {
        session_start();
        $validated = $this->validation();

        if (count($validated) > 0){
            // Antes de la redirección
            $_SESSION['errors'] = [
                'value' => $validated,
                'timeout' => time() + 5, // Set the expiration timestamp
            ];

            // Redirección
            header("Location: /languages/edit?id={$_POST['id']}");
            exit();
        }
        $newLanguage = new Language();

        $_SESSION['success'] = [
            'value' => 'Lenguaje actualizada correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
        $newLanguage->update($_POST['id'], $_POST['lenguage_sub'], $_POST['iso_code'], $_POST['lenguage_audio']);
        header("Location: /languages");
        exit();
    }

    public function delete()
    {
        $newLanguage = new Language();
        $newLanguage->delete($_POST['id']);

        return 'ok';
    }
}
