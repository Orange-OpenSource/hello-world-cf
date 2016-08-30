<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 22/08/2014
 */
$services = require __DIR__ . '/../util/configExtractor.php';
$serviceDbaas = $services['my-super-database'];
$dbInfo = parse_url($serviceDbaas["uri"]);

try {
    $db = new PDO($dbInfo["scheme"] . ':host=' . $dbInfo["host"] . ';port=' . $dbInfo["port"] . ';dbname=' . str_replace("/", "", $dbInfo["path"]) . ';charset=utf8', $dbInfo["user"], $dbInfo["pass"]);
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}
// we create the table if not exists
if ($db->query("SHOW TABLES LIKE 'test'")->rowCount() == 0) {
    $sql = "CREATE table test(
     id INT(11) AUTO_INCREMENT PRIMARY KEY,
     `key` VARCHAR(50) NOT NULL, 
     `value` VARCHAR(250) NOT NULL)";
    $db->exec($sql);
}
if (!empty($_POST["key"]) && !empty($_POST["value"])) {
    $prep = $db->prepare("INSERT INTO test (`key`, `value`) VALUES(?, ?)");
    $prep->execute(array($_POST["key"], $_POST["value"]));
}

$query = $db->query("SELECT * FROM test");
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
        <th>id</th>
        <th>key</th>
        <th>value</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($data = $query->fetch()): ?>
        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['key']; ?></td>
            <td><?php echo $data['value']; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
