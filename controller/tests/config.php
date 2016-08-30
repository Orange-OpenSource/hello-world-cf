<?php
use elpaaso\tester\SourceShower;


$services = require __DIR__ . '/../../cloud-php-samples/util/configExtractor.php';
$servicesName = array();
foreach ($services as $serviceName => $service) {
    $servicesName[] = $serviceName;
}
echo $template->render('test/config', array(
    'services' => $services,
    'servicesName' => $servicesName,
    'controllerCode' => new SourceShower(__DIR__ . '/../../cloud-php-samples/util/configExtractor.php'),
    'templateCode' => new SourceShower(__DIR__ . '/../../cloud-php-samples/config/index.php')
));