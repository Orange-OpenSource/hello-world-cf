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
$vcapApplication = json_decode($_ENV["VCAP_APPLICATION"], true);
if (!empty($_SERVER["HTTP_X_FORWARDED_PROTO"])) {
    $_SERVER["REQUEST_SCHEME"] = $_SERVER["HTTP_X_FORWARDED_PROTO"];
}
if (empty($_SERVER["REQUEST_SCHEME"])) {
    if (!empty($_SERVER["HTTP_X_FORWARDED_PROTO"])) {
        $_SERVER["REQUEST_SCHEME"] = $_SERVER["HTTP_X_FORWARDED_PROTO"];
    } else if (!empty($_SERVER["HTTPS"])) {
        $_SERVER["REQUEST_SCHEME"] = 'https';
    } else {
        $_SERVER["REQUEST_SCHEME"] = 'http';
    }
}
$uri = "localhost";
if (isset($vcapApplication["uris"][0])) {
    $uri = $vcapApplication["uris"][0];
}
define("LOCATION", $_SERVER["REQUEST_SCHEME"] . '://' . $uri . "/soap");