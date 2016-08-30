<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 29/08/2014
 */
$this->layout('layout') ?>

<?php $this->title = 'Get config code show' ?>

<h1>Get config code show</h1>
<div id="service" style="display: none;">
    <?php
    foreach ($this->services as $serviceName => $service):
        ?>
        <span id="<?php echo $serviceName ?>">
        <table class="table table-bordered table-hover">
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
<div class="row">
    <div class="col-md-8">
        <form method="get">
            <h2>Get services</h2>
            <select id="selectService" autocomplete="off">
                <option value=""></option>
                <?php foreach ($this->servicesName as $serviceName): ?>
                    <option value="<?php echo $serviceName ?>"><?php echo $serviceName; ?></option>
                <?php endforeach; ?>
            </select>

            <div id="show" style="margin-top: 15px;">

            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <h2>Env variables</h2>
        <table class="table table-bordered table-hover">
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

</div>
<h2>Code</h2>
<div class="row">
    <div class="col-md-6">
        <h3>Code of the configExtractor.php</h3>
        <?php echo $this->controllerCode; ?>
    </div>
    <div class="col-md-6">
        <h3>Code of these tables</h3>
        <?php echo $this->templateCode; ?>
    </div>
</div>
<p class="bg-info"><span style="font-weight: bold;">Note</span>: this website use an helper to get services from
    elpaaso, it's made by us and you can use it,
    take look on <a href="https://github.com/Orange-OpenSource/cf-helper-php">https://github.com/Orange-OpenSource/cf-helper-php</a>
</p>
<script type="text/javascript">
    $(function () {
        $('#selectService').change(function () {
            console.log('#' + $(this).val());
            $('#show').html($('#' + $(this).val()).html());
        });
    });
</script>

