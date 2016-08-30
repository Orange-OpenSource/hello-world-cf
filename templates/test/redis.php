<?php $this->layout('layout') ?>

<?php $this->title = 'Redis' ?>

<h1>Redis storage</h1>
<p>
    Connection with redis:
    <br/>
    <?php include_once __DIR__ . '/../../cloud-php-samples/redis/redis.php'; ?>
</p>
<p class="bg-info"><span style="font-weight: bold;">Note</span>: The file <code>configExtractor.php</code> come
    directly from config example.
</p>
<?php echo $this->code; ?>
