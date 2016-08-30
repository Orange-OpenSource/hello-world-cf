<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 24/09/2014
 */
use elpaaso\tester\SourceShower;

require_once __DIR__ . '/../../cloud-php-samples/wsp/const.php';
if (isset($_GET['server'])) {
    include __DIR__ . '/../../cloud-php-samples/wsp/server.php';
    exit();
}
$serverUrl = dirname(LOCATION) . '/soap';
$wsdlUrl = $serverUrl . '?wsdl';
if (isset($_GET['wsdl'])) {
    include_once __DIR__ . '/../../cloud-php-samples/wsp/catalogWsdl.php';
    exit();
}
echo $template->render('test/soap', array(
    'codeWsp' => new SourceShower(__DIR__ . '/../../cloud-php-samples/wsp/server.php'),
    'codeWsc' => new SourceShower(__DIR__ . '/../../cloud-php-samples/wsc/clientWsNative.php'),
    'codeWsdl' => new SourceShower(__DIR__ . '/../../cloud-php-samples/wsp/catalogWsdl.php'),
    'codeCatalog' => new SourceShower(__DIR__ . '/../../cloud-php-samples/wsp/Catalog.php'),
    'wsdlUrl' => $wsdlUrl
));