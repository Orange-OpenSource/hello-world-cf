<?php
use elpaaso\tester\SourceShower;

echo $template->render('test/session', array(
    'code' => new SourceShower(__DIR__ . '/../../cloud-php-samples/session/session.php'),
));