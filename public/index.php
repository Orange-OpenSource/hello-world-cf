<?php
/*
 * For the next dev after me, you will be happy to see this
 * How this website works:
 * -----
 *
 * This websites work with a router, you can set your routes inside `routes.json`
 * The `controller` value inside routes.json make the correspondance with a php file inside controller
 * Each of this controller return $template->render(<a template which is inside templates without php extension>)
 *
 * Everything in controllers/tests are indexed in menu bar and route are automatically created
 */
require_once __DIR__ . '/../vendor/autoload.php';
define("ROOT", __DIR__ . '/..');
$app = \elpaaso\tester\App::getInstance();
$app->start();