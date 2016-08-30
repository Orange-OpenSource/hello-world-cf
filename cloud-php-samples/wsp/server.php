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
include_once __DIR__ . '/const.php';
require_once __DIR__ . '/Catalog.php';
if (isset($_GET['wsdl'])) {
    include_once __DIR__ . '/catalogWsdl.php';
    exit();
}

//caching inside temp folder the wsdl cause soapserver can't access to wsdl by url
$fileWsdlTmp = sys_get_temp_dir() . '/wsdl.wsdl';
file_put_contents($fileWsdlTmp, file_get_contents(LOCATION . '?wsdl'));


$server = new SoapServer($fileWsdlTmp); //create a new soap server with wsdl file referenced
$server->setClass('Catalog');

$server->handle(); //handle soap message coming