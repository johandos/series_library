<?php
//    require_once('../../controllers/PlatformController.php');
include('PlatformController.php');
    echo "aaaa1";
    $platformList = listPlatforms();
    if(count($platformList) > 0) {
        echo "b";
    }
    foreach ($platformList as $platform) {
        echo $platform->getId();
        echo $platform->getName();
    }