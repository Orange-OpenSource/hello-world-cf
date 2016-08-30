<?php
/**
 * Copyright (C) 2016 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 30/08/2016
 */
$services = require __DIR__ . '/../util/configExtractor.php';
$redisInfo = $services['my-redis'];

try {
    $redis = new Redis();
    $redis->connect($redisInfo["host"], $redisInfo["port"]);
    $redis->auth($redisInfo["password"]);
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}
// we create the table if not exists

if (!empty($_POST["key"]) && !empty($_POST["value"])) {
    $redis->set($_POST["key"], $_POST["value"]);
}

$keys = $redis->keys("*");
?>
<form method="post">
    <div class="form-group">
        <label for="inputKey">Key</label>
        <input type="text" id="inputKey" class="form-control" name="key" placeholder="my key">
    </div>
    <div class="form-group">
        <label for="inputValue">Value</label>
        <input type="text" class="form-control" name="value" id="inputValue" placeholder="my value">
    </div>
    <button type="submit" class="btn btn-default">Add</button>
</form>
<br/>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>key</th>
        <th>value</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($keys as $key): ?>
        <tr>
            <td><?php echo $key; ?></td>
            <td><?php echo $redis->get($key); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
