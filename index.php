<?php

require_once __DIR__ . '/Controller/ActorController.php';
require_once __DIR__ . '/Controller/DirectorController.php';
require_once __DIR__ . '/Controller/GenderController.php';
require_once __DIR__ . '/Controller/LanguageController.php';
require_once __DIR__ . '/Controller/PlatformsController.php';
require_once __DIR__ . '/Controller/RestrictionController.php';
require_once __DIR__ . '/Controller/SeasonController.php';
require_once __DIR__ . '/Controller/SerieController.php';
require_once __DIR__ . '/Controller/TranslateController.php';

// Cargar el autoloader u otras configuraciones necesarias

// Obtener la ruta de la solicitud
$requestUri = $_SERVER['REQUEST_URI'];

// Determinar el controlador y la acción basados en la ruta
$controller = 'PlatformsController';
$action = 'index';

// Separar la ruta en segmentos
$segments = explode('/', $requestUri);

// Obtener el controlador y la acción de los segmentos de la ruta
if (isset($segments[1]) && !empty($segments[1])) {
    $controller = ucfirst($segments[1]) . 'Controller';
}

if (isset($segments[2]) && !empty($segments[2])) {
    $action = explode('?', $segments[2]);
    $action = $action[0];
}
// Crear el nombre completo de la clase del controlador
$controllerClass = 'Controller\\' . $controller;

//'Controller\PlatformsController';
//'Controller\DirectorController';

// Verificar si la clase del controlador existe
if (class_exists($controllerClass)) {
    // Crear una instancia del controlador
    $controllerInstance = new $controllerClass();
    // Verificar si el la accion y controlador existen
    if (method_exists($controllerInstance, $action)) {
        // Llamar al accion del controller
        $controllerInstance->$action();
    } else {
        // Manejar error: acción no encontrada
        echo "Error: Acción no encontrada.";
    }
} else {
    // Manejar error: controlador no encontrado
    echo "Error: Controlador no encontrado.";
}
