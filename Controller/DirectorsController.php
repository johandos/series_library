<?php

namespace Controller;

use Models\Director;
use Controller\BaseController;

require_once __DIR__ . '/../Models/Director.php';
require_once __DIR__ . '/BaseController.php';

class DirectorsController extends BaseController
{
    public function index()
    {
        // Obtener la lista de directores desde el modelo
        $directorModel = new Director();
        $directors = $directorModel->getAll();

        $viewPath = __DIR__ . '/../views/directors/index.php';
        print $this->render($viewPath, ['directors' => $directors]);
    }

    public function create()
    {
        $viewPath = __DIR__ . '/../views/directors/create.php';
        print $this->render($viewPath);
    }

    public function store()
    {
        // Lógica para crear un director
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['directorName'];
            $surname = $_POST['directorSurname'];
            $nacionality = $_POST['directorNacionality'];

            $newDirector = new Director();
            $directorCreated = $newDirector->insert($name, $surname, $nacionality);

            if ($directorCreated) {
                header("Location: /directors");
                exit();
            } else {
                // Manejo de errores
            }
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $director = new Director();
        $director = $director->findOne($id);

        $viewPath = __DIR__ . '/../views/directors/edit.php';
        print $this->render($viewPath, ['director' => $director]);
    }

    public function update()
    {
        // Lógica para actualizar un director
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['directorId'];
            $name = $_POST['directorName'];
            $surname = $_POST['directorSurname'];
            $nacionality = $_POST['directorNacionality'];

            $director = new Director();
            $directorUpdated = $director->update($id, $name, $surname, $nacionality);

            if ($directorUpdated) {
                header("Location: /directors");
                exit();
            } else {
                // Manejo de errores
            }
        }
    }

    public function delete()
    {
        // Lógica para eliminar un director
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $director = new Director();
            $directorDeleted = $director->delete($id);

            if ($directorDeleted) {
                return 'ok';
            } else {
                // Manejo de errores
                return 'error';
            }
        }
    }
}
