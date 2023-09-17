<?php

namespace Controller;

use Controller\BaseController;
use models\Gender;

require_once __DIR__ . '/../models/Gender.php';
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

    public function create()
    {
        $viewPath = __DIR__ . '/../views/gender/create.php';
        print $this->render($viewPath);
    }

    public function store()
    {
        $newGender = new Gender();
        $newGender->insert($_POST['genderDescription']);


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
        $newGender = new Gender();
        $newGender->update($_POST['genderId'], $_POST['genderDescription']);


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
