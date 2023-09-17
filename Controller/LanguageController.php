<?php

namespace Controller;

use Models\Language;

require_once __DIR__ . '/../Models/Language.php';
require_once  __DIR__ . '/BaseController.php';

class LanguageController extends BaseController
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

    public function store()
    {
        $newLanguage = new Language();
        $newLanguage->insert($_POST['languageName'], $_POST['languageName'], $_POST['languageName']);


        header("Location: /language");
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
        $newLanguage = new Language();
        $newLanguage->update($_POST['id'], $_POST['subtitle'], $_POST['isoCode'], $_POST['audio']);
        header("Location: /language");
        exit();
    }

    public function delete()
    {
        $newLanguage = new Language();
        $newLanguage->delete($_POST['id']);

        return 'ok';
    }
}
