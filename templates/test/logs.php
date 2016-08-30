<?php $this->layout('layout') ?>

<?php $this->title = 'How to log' ?>

    <h1>How to log</h1>
    <p>
        You can log and push your logs simply by writing on <code>stdout</code> or/and <code>stderr</code>.
        <br/>
        Run `cf logs <?php echo \elpaaso\tester\App::appName(); ?> --recent` to see logs written here.
        <?php include_once __DIR__ . "/../../cloud-php-samples/logs/logs.php"; ?>
    </p>
<?php echo $this->code; ?>