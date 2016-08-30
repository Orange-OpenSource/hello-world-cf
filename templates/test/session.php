<?php $this->layout('layout') ?>

<?php $this->title = 'Use session with redis' ?>

<h1>Use session with redis</h1>
<p>
    <?php include_once __DIR__ . "/../../cloud-php-samples/session/session.php"; ?>
    <br/>
    See code to know how to set up redis. (here we have 2 instances of this app running, see manifest.yml in the
    source)
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