<?php
use elpaaso\tester\SourceShower;


echo $template->render('test/databases', array(
    'code' => new SourceShower(__DIR__ . '/../../cloud-php-samples/rdbms/rdbms.php'),
));