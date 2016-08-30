<?php $this->layout('layout') ?>

<?php $this->title = 'SOAP Webservice' ?>

<h1>How to use soap on cloudfoundry</h1>
<h2>Example</h2>
You can see the wsdl from this url: <a href="<?php echo $this->wsdlUrl; ?>"><?php echo $this->wsdlUrl; ?></a>.
<br/>
This is an example which use what you will see beside:
<br/>
<?php include __DIR__ . '/../../cloud-php-samples/wsc/clientWsNative.php'; ?>
<h2>Code</h2>
<p class="bg-info"><span style="font-weight: bold;">Note</span>: The file <code>configExtractor.php</code> come
    directly from config example.
</p>
<div class="row">
    <div class="col-md-6">
        <h3>Code of the server side</h3>
        <?php echo $this->codeWsp; ?>
    </div>
    <div class="col-md-6">
        <h3>Code of the client side</h3>
        <?php echo $this->codeWsc; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h3>Code of wsdl generation</h3>
        <?php echo $this->codeWsdl; ?>
    </div>
    <div class="col-md-6">
        <h3>The class Catalog (Catalog.php)</h3>
        <?php echo $this->codeCatalog; ?>
    </div>
</div>