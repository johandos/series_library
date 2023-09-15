<?php

namespace Controller;

use Exception;

class BaseController {
    public function render($viewPath, $data = []) {
        // Extraer los datos del arreglo $data
        extract($data);

        // Capturar el contenido de la vista en un búfer de salida
        ob_start();
        include($viewPath);
        $content = ob_get_contents();
        ob_end_clean();

        // Devolver el contenido de la vista
        return $content;
    }
}