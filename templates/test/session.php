<?php $this->layout('layout') ?>

<?php $this->title = 'Use session with redis' ?>

    <h1>Use session with redis</h1>
    <p>
        <?php include_once __DIR__ . "/../../cloud-php-samples/session/session.php"; ?>
        <br/>
        See code to know how to set up redis. (here we have 2 instances of this app running, see manifest.yml in the
        source)
    </p>
<?php echo $this->code; ?>