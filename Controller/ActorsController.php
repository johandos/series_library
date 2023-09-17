<?php

namespace Controller;

use models\Actors;
use Controller\BaseController;
use models\Series;

require_once __DIR__ . '/../models/Actors.php';
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
        $viewPath = __DIR__ . '/../views/actors/create.php';
        print $this->render($viewPath);
    }

    public function store()
    {
        $newActors = new Actors();
        $newActors->insert($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['dateBirth'], $_POST['nationality'], $_POST['serieId']);


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
        $newActors = new Actors();
        $newActors->update($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['dateBirth'], $_POST['nationality'], $_POST['serieId']);

        header("Location: /actors");
        exit();
    }

    public function delete()
    {
        $newActors = new Actors();
        $newActors->delete($_POST['id']);

        return 'ok';
    }
}
