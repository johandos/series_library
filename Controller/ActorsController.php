<?php

namespace Controller;

use Models\Actors;
use Models\Series;
use Request;
use Validator;
use Controller\BaseController;

require_once __DIR__ . '/../Models/Actors.php';
require_once __DIR__ . '/../Helper/Validator.php';
require_once __DIR__ . '/../Helper/Request.php';
require_once __DIR__ . '/BaseController.php';

class ActorsController extends BaseController
{

    public function index()
    {
        // Obtener la lista de plataformas desde el modelo
        $model = new Actors();
        $actors = $model->getAll();

        $viewPath = __DIR__ . '/../views/actors/index.php';
        print $this->render($viewPath, ['actors' => $actors]);
    }

    public function create()
    {
        $series = new Series();
        $series = $series->getAll();

        $viewPath = __DIR__ . '/../views/actors/create.php';
        print $this->render($viewPath, ['series' => $series]);
    }

    public function validation(): array
    {
        $request = new Request();

        $rules = [
            'name' => 'required|max:25',
            'surname' => 'required|max:25',
            'dateBirth' => 'required|date',
            'nationality' => 'required|max:25',
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
            header("Location: /actors/create");
            exit();
        }

        $newActors = new Actors();
        $newActors->insert( $_POST['name'], $_POST['surname'], $_POST['dateBirth'], $_POST['nationality'], $_POST['serieId']);

        $_SESSION['success'] = [
            'value' => 'Actor creado correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
        header("Location: /actors");
        exit();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $actor = new Actors();
        $actor = $actor->findOne($id);

        $series = new Series();
        $series = $series->getAll();

        $viewPath = __DIR__ . '/../views/actors/edit.php';
        print $this->render($viewPath, ['actor' => $actor, 'series' => $series]);
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
            header("Location: /actors/edit?id={$_POST['id']}");
            exit();
        }

        $newActors = new Actors();
        $newActors->update($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['dateBirth'], $_POST['nationality'], $_POST['serieId']);

        $_SESSION['success'] = [
            'value' => 'Actor actualizado correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];
        header("Location: /actors");
        exit();
    }

    public function delete()
    {
        session_start();
        $newActors = new Actors();
        $newActors->delete($_POST['id']);

        $_SESSION['success'] = [
            'value' => 'Actor eliminado correctamente',
            'timeout' => time() + 5, // Set the expiration timestamp
        ];

        return 'ok';
    }
}
