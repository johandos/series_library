<?php

namespace Controller;

use Models\Director;
use Models\Gender;
use Models\Restriction;
use Models\Series;
use Request;
use Validator;
use Controller\BaseController;

require_once __DIR__ . '/../Models/Series.php';
require_once __DIR__ . '/../Models/Restriction.php';
require_once __DIR__ . '/../Helper/Validator.php';
require_once __DIR__ . '/../Helper/Request.php';
require_once __DIR__ . '/BaseController.php';

class SeriesController extends BaseController
{
    public function index()
    {
        $model = new Series();
        $series = $model->getAll();

        $viewPath = __DIR__ . '/../views/series/index.php';

        print $this->render($viewPath, ['seriesList' => $series]);
    }

    public function create()
    {
        $directors = new Director();
        $directors = $directors->getAll();

        $genders = new Gender();
        $genders = $genders->getAll();

        $restrictions = new Restriction();
        $restrictions = $restrictions->getAll();

        $viewPath = __DIR__ . '/../views/series/create.php';
        print $this->render($viewPath, [
            'directors' => $directors,
            'genders' => $genders,
            'restrictions' => $restrictions
        ]);
    }

    public function validation(): array
    {
        $request = new Request();

        $rules = [
            'title' => 'required|max:25',
            'subtitle' => 'required|max:25',
            'img' => 'required',
            'trailer' => 'required|max:25',
            'rating' => 'required|numeric|max:1',
            'synopsis' => 'required|max:25',
            'releaseDate' => 'required|date',
            'directorId' => 'required',
            'genreId' => 'required',
            'restrictionId' => 'required',
        ];


        $validator = new Validator($request->all(), $rules);
        return $validator->validate();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $serie = new Series();
        $serie = $serie->findOne($id);


        $directors = new Director();
        $directors = $directors->getAll();

        $genders = new Gender();
        $genders = $genders->getAll();

        $restrictions = new Restriction();
        $restrictions = $restrictions->getAll();

        $viewPath = __DIR__ . '/../views/series/edit.php';
        print $this->render($viewPath, [
            'directors' => $directors,
            'genders' => $genders,
            'restrictions' => $restrictions,
            'serie' => $serie
        ]);
    }

    private function getFormData()
    {
        // Lista de campos del formulario
        $fields = ['title', 'subtitle', 'img', 'trailer', 'rating', 'synopsis', 'releaseDate', 'directorId', 'genreId', 'restrictionId'];

        $data = [];

        // Recorre los campos y agrega sus valores al array $data
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                $data[$field] = $_POST[$field];
            } else {
                // Manejar el caso en el que falte algún campo requerido
                // Puedes mostrar un mensaje de error o redirigir a otra página
                // según tus requerimientos.
                return null;
            }
        }

        return $data;
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
            header("Location: /series/create");
        }

        $data = $this->getFormData();

        if ($data === null) {
            // Manejar el caso en el que faltan campos requeridos en el formulario
            return;
        }

        // Crea una instancia de Series y guarda los datos
        $series = new Series();
        $seriesCreated = $series->insert($data);

        if ($seriesCreated) {
            $_SESSION['success'] = [
                'value' => 'Serie creada correctamente',
                'timeout' => time() + 5, // Set the expiration timestamp
            ];
            // Redirige a la página de listado de series después de crear la serie exitosamente
            header("Location: /series");
            exit();
        } else {
            $_SESSION['errors'] = [
                'value' => ['error Inesperado'],
                'timeout' => time() + 5, // Set the expiration timestamp
            ];

            header("Location: /series/create");
        }
    }

    public function update()
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
            header("Location: /series/edit?id={$_POST['id']}");
        }

        $data = $this->getFormData();
        if ($data === null) {
            // Manejar el caso en el que faltan campos requeridos en el formulario
            return;
        }

        // Obtén el ID de la serie a actualizar desde el formulario
        $seriesId = $_POST['id'];

        // Crea una instancia de Series y actualiza los datos
        $series = new Series();
        $seriesUpdated = $series->update($seriesId, $data);


        if ($seriesUpdated) {
            $_SESSION['success'] = [
                'value' => 'Serie actualizado correctamente',
                'timeout' => time() + 5, // Set the expiration timestamp
            ];
            // Redirige a la página de detalles de la serie actualizada
            header("Location: /series");
            exit();
        } else {
            $_SESSION['errors'] = [
                'value' => ['error Inesperado'],
                'timeout' => time() + 5, // Set the expiration timestamp
            ];

            header("Location: /series/edit?id={$_POST['id']}");
        }
    }


    public function delete()
    {
        $newPlatform = new Series();
        $newPlatform->delete($_POST['id']);

        return 'ok';
    }
}
