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
/**
 * e.g VCAP_SERVICE:
{
    "VCAP_SERVICES": {
    "p-mysql": [
      {
          "credentials": {
          "hostname": "192.168.111.151",
          "jdbcUrl": "jdbc:mysql://192.168.111.151:3306/cf_uuid\u0026password=titi",
          "name": "cf_uuid",
          "password": "titi",
          "port": 3306,
          "uri": "mysql://toto:titi@192.168.111.151:3306/cf_40bb0120_9bff_4350_9c72_7f619eb8b160?reconnect=true",
          "username": "toto"
        },
        "label": "p-mysql",
        "name": "mysql-pt-mirror",
        "plan": "100mb",
        "provider": null,
        "syslog_drain_url": null,
        "tags": [
          "mysql"
      ],
        "volume_mounts": []
      }
    ],
    "user-provided": [
      {
          "credentials": {
          "password": "pa55woRD",
          "username": "admin"
        },
        "label": "user-provided",
        "name": "my-db-mine",
        "syslog_drain_url": "",
        "tags": [],
        "volume_mounts": []
      }
    ]
  }
}
*/
$vcapServices = json_decode($_ENV['VCAP_SERVICES'], true);
$services = array();
foreach ($vcapServices as $definedService) {
    foreach ($definedService as $service) {
        $services[$service["name"]] = $service["credentials"];
    }
}
return $services;
