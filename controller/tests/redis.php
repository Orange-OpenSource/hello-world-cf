<?php
use elpaaso\tester\SourceShower;


echo $template->render('test/redis', array(
    'code' => new SourceShower(__DIR__ . '/../../cloud-php-samples/redis/redis.php'),
));