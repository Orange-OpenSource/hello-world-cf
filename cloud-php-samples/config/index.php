<?php
$services = require __DIR__ . '/../util/configExtractor.php';

?>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
        table, table td, table th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<div id="service" style="display: none;">
    <?php
    $servicesName = array();
    foreach ($services as $serviceName => $service):
        $servicesName[] = $serviceName;
        ?>
        <span id="<?php echo $serviceName ?>">
        <table>
            <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach ($service as $key => $value):
                ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value; ?></td>
                </tr>
                <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </span>
        <?php
    endforeach;
    ?>
</div>

<form method="get" style="float: left; width: 50%;">
    <h2>Get services</h2>
    <select id="selectService">
        <option value=""></option>
        <?php foreach ($servicesName as $serviceName): ?>
            <option value="<?php echo $serviceName ?>"><?php echo $serviceName; ?></option>
        <?php endforeach; ?>
    </select>

    <div id="show" style="margin-top: 15px;">

    </div>
</form>
<div style="margin-left: 51%">
    <h2>Env variables</h2>
    <table>
        <thead>
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($_ENV as $key => $value):
            ?>
            <tr>
                <td><?php echo $key; ?></td>
                <td><?php echo(empty($value) ? '&nbsp;' : $value); ?></td>
            </tr>
            <?php
        endforeach;
        ?>

        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(function () {
        $('#selectService').change(function () {
            console.log('#' + $(this).val());
            $('#show').html($('#' + $(this).val()).html());
        });
    });
</script>
</body>
</html>
