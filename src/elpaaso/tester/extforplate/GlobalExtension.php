<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 17/07/2014
 */


namespace elpaaso\tester\extforplate;


use League\Plates\Extension\ExtensionInterface;

class GlobalExtension implements ExtensionInterface
{

    public function getFunctions()
    {
        return array(
            'link' => 'getLink',
            'asset' => 'getAsset'
        );
    }

    function getAsset($asset, $folder = "/assets")
    {
        return $this->getLink($folder . '/' . $asset);
    }

    public function getLink($res)
    {
        $port = '';
        if ($_SERVER['SERVER_PORT'] != 80) {
            $port = ':' . $_SERVER['SERVER_PORT'];
        }
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = ($dirname == '/') ? "" : $dirname;
        if (empty($_SERVER["REQUEST_SCHEME"])) {
            if (!empty($_SERVER["HTTP_X_FORWARDED_PROTO"])) {
                $_SERVER["REQUEST_SCHEME"] = $_SERVER["HTTP_X_FORWARDED_PROTO"];
            } else if (!empty($_SERVER["HTTPS"])) {
                $_SERVER["REQUEST_SCHEME"] = 'https';
            } else {
                $_SERVER["REQUEST_SCHEME"] = 'http';
            }
        }
        $path = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . $port . $dirname . $res;
        return $path;
    }
}