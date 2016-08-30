<!DOCTYPE html>
<html>
<head>
    <title>ElPaaso tester - <?php echo $this->title ?></title>
    <link rel="shortcut icon" href="<?php echo $this->asset('img/favicon.ico'); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo $this->asset('img/favicon.ico'); ?>" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo $this->asset('css/bootstrap-theme.css'); ?>" rel="stylesheet">
    <link href="<?php echo $this->asset('css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo $this->asset('css/prism.css'); ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo $this->asset('js/html5shiv.js'); ?>"></script>
    <script src="<?php echo $this->asset('js/respond.min.js'); ?>"></script>

    <![endif]-->
    <script src="<?php echo $this->asset('js/jquery.min.js'); ?>"></script>
    <script src="<?php echo $this->asset('js/jquery-ui.min.js'); ?>"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->link(null); ?>"><img
                    src="<?php echo $this->asset('img/elpaaso.png'); ?>"/>ElPaaso php tester
                - <?php echo $this->title ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav navbar-nav nav-sidebar">
                <?php foreach (\elpaaso\tester\App::$TESTS_MENU as $menu): ?>
                    <li>
                        <a class="needDropdown" href="<?php echo $this->link('/' . $menu); ?>"><?php echo $menu; ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
            <footer class="bs-docs-footer" role="contentinfo"
                    style="color: white;position: absolute;bottom: 0;text-align: center;width: 100%;left:0;">
                <p>
                    Powered by ElPaaso team
                </p>
            </footer>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <?php echo $this->content() ?>

        </div>
    </div>
</div>
</div>


<script src="<?php echo $this->asset('js/prism.js'); ?>"></script>
</body>
</html>