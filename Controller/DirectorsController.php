<?php

namespace Controller;

use Models\Director;
use Controller\BaseController;
use Request;
use Validator;

require_once __DIR__ . '/../Models/Director.php';
require_once __DIR__ . '/../Helper/Validator.php';
require_once __DIR__ . '/../Helper/Request.php';
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

    public function validation(): array
    {
        $request = new Request();

        $rules = [
            'directorName' => 'required|max:25',
            'directorSurname' => 'required|max:25',
            'directorNacionality' => 'required|max:25',
            'dateBirth' => 'required|date',
        ];


        $validator = new Validator($request->all(), $rules);
        return $validator->validate();
    }

    public function create()
    {
        $viewPath = __DIR__ . '/../views/directors/create.php';
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
            header("Location: /directors/create");
            exit();
        }

        $name = $_POST['directorName'];
        $surname = $_POST['directorSurname'];
        $nacionality = $_POST['directorNacionality'];
        $dateBirth = $_POST['dateBirth'];

        $newDirector = new Director();
        $directorCreated = $newDirector->insert($name, $surname, $nacionality, $dateBirth);

        if ($directorCreated) {
            $_SESSION['success'] = [
                'value' => 'Director creado correctamente',
                'timeout' => time() + 5, // Set the expiration timestamp
            ];
            header("Location: /directors");
        } else {
            $_SESSION['errors'] = [
                'value' => ['error Inesperado'],
                'timeout' => time() + 5, // Set the expiration timestamp
            ];
            header("Location: /directors/create");
        }
        exit();

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
        session_start();
        $validated = $this->validation();

        if (count($validated) > 0){
            // Antes de la redirección
            $_SESSION['errors'] = [
                'value' => $validated,
                'timeout' => time() + 30, // Set the expiration timestamp
            ];

            // Redirección
            header("Location: /directors/edit?id={$_POST['directorId']}");
            exit();
        }

        // Lógica para actualizar un director
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['directorId'];
            $name = $_POST['directorName'];
            $surname = $_POST['directorSurname'];
            $nacionality = $_POST['directorNacionality'];
            $dateBirth = $_POST['dateBirth'];

            $director = new Director();
            $directorUpdated = $director->update($id, $name, $surname, $nacionality, $dateBirth);

            if ($directorUpdated) {
                $_SESSION['success'] = [
                    'value' => 'Director actualizado correctamente',
                    'timeout' => time() + 5, // Set the expiration timestamp
                ];
                header("Location: /directors");
                exit();
            } else {
                $_SESSION['errors'] = [
                    'value' => ['error Inesperado'],
                    'timeout' => time() + 5, // Set the expiration timestamp
                ];

                header("Location: /directors/edit?id={$_POST['directorId']}");
                exit();
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
