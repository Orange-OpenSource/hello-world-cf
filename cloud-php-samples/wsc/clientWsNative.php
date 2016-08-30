<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 18/08/2014
 */
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
$services = require __DIR__ . '/../util/configExtractor.php';

//getting app url from vcap_application
$vcapApplication = json_decode($_ENV["VCAP_APPLICATION"], true);
if (empty($_SERVER["REQUEST_SCHEME"])) {
    if (!empty($_SERVER["HTTPS"])) {
        $_SERVER["REQUEST_SCHEME"] = 'https';
    } else {
        $_SERVER["REQUEST_SCHEME"] = 'http';
    }
}
$uri = "localhost";
if (isset($vcapApplication["uris"][0])) {
    $uri = $vcapApplication["uris"][0];
}
$path = $_SERVER["REQUEST_SCHEME"] . "://" . $uri . "/soap";
//caching inside temp folder the wsdl cause soapclient can't access to wsdl by url
$fileWsdlTmp = sys_get_temp_dir() . '/wsdl.wsdl';
$wsdlContent = file_get_contents($path . '?wsdl');
file_put_contents($fileWsdlTmp, $wsdlContent);

$client = new SoapClient($fileWsdlTmp, array(
    'trace' => 1,
    'login' => $_ENV["WSC_LOGIN"],
    'password' => $_ENV["WSC_PASSWD"]
));
$catalogId = (empty($_GET['catalog']) ? 'catalog1' : $_GET['catalog']);
try {
    $response = $client->getCatalogEntry($catalogId);
} catch (Exception $e) {
    var_dump($e);
}
echo $response;