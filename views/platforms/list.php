<?php
//    require_once('../../controllers/PlatformController.php');
//    require('../../controllers/PlatformController.php');
    include('../../controllers/PlatformController.php');
    use function listPlatforms;
    echo "aaaa1";
    $platformList = listPlatforms();
    if(count($platformList) > 0) {
        echo "b";
    }
    foreach ($platformList as $platform) {
        echo $platform->getId();
        echo $platform->getName();
    }