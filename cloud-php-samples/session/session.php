<?php
$services = require __DIR__ . "/../util/configExtractor.php";
if (isset($services["my-redis"])) {
    // we configure redis in case a my-redis service exists and we do it programtically to bind automatically to the correct redis
    $redisService = $services["my-redis"];
    ini_set("session.save_handler", "redis");
    ini_set("session.save_path", sprintf("tcp://%s:%s?auth=%s", $redisService["host"], $redisService["port"], $redisService["password"]));
}
$instance = "instance-local";

if (!empty($_ENV['VCAP_APPLICATION'])) {
    //we are under cloud foundry so we take the real instance id
    $vcapApplication = json_decode($_ENV["VCAP_APPLICATION"], true);
    $instance = $vcapApplication["instance_id"];
}
session_start();
echo sprintf("Instance id is <b>%s</b> and session id is still <b>%s</b>", $instance, session_id());
