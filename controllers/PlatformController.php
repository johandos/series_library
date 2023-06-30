<?php
require_once('../models/Platform.php');

    function listPlatforms()
    {

        $model = new Platform();
//        echo "entro";

        $platformList = $model->getAll();
        $platformObjectArray = [];

        foreach ($platformList as $platformItem) {
            $platformObject = new Platform($platformItem->getId(), $platformItem->getName());
            array_push($platformObjectArray, $platformObject);
//            echo " - ".$platformItem->getId();
//            echo " - ".$platformItem->getName();
        }
        return $platformObjectArray;
    }

    function storePlatform ($plat_name){

        $newPlatform = new Platform(null, $plat_name);
        $platformCreated = $newPlatform->store();

        return $platformCreated;
    }


