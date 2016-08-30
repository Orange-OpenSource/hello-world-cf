<?php
$services = require __DIR__ . '/../util/configExtractor.php';
$wsc = $services['CONSUMER_WSC'];
?>
    <html>
    <body>
    <h2>Soap info</h2>
    <table>
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>value</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($wsc as $key => $value): ?>
            <tr>
                <td>Soap <?php echo $key; ?></td>
                <td><?php echo $value; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Soap wsdl url</td>
            <td><a href="<?php echo $wsc['PATH']; ?>?wsdl"><?php echo $wsc['PATH']; ?>?wsdl</a></td>
        </tr>
        </tbody>
    </table>
    </body>
    </html>
<?php
include_once __DIR__ . '/clientWsNative.php';
