<?php

namespace Controller;

use models\Actor;
use Controller\BaseController;

require_once __DIR__ . '/../models/Actor.php';
require_once __DIR__ . '/BaseController.php';

class ActorController extends BaseController
{
    public function index()
    {
        // Obtener la lista de actores desde el modelo y mostrar en la vista
    }

    public function create()
    {
        // Mostrar el formulario para crear un actor
    }

    public function store()
    {
        // Procesar el formulario para crear un actor
    }

    public function edit()
    {
        // Mostrar el formulario para editar un actor
    }

    public function update()
    {
        // Procesar el formulario para actualizar un actor
    }

    public function delete()
    {
        // Eliminar un actor
    }
}
