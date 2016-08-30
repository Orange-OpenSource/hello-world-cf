<?php
use elpaaso\tester\SourceShower;

include_once __DIR__ . '/../../cloud-php-samples/logs/logs.php';
echo $template->render('test/logs', array(
    'code' => new SourceShower(__DIR__ . '/../../cloud-php-samples/logs/logs.php'),
));