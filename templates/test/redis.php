<?php $this->layout('layout') ?>

<?php $this->title = 'Redis' ?>

<h1>Redis storage</h1>
<p>
    Connection with redis:
    <br/>
    <?php include_once __DIR__ . '/../../cloud-php-samples/redis/redis.php'; ?>
</p>
<h2>Code</h2>
<p class="bg-info"><span style="font-weight: bold;">Note</span>: The file <code>configExtractor.php</code> come
    directly from config example.
</p>
<div class="row">
    <div class="col-md-12">
        <?php echo $this->code; ?>
    </div>
</div>
