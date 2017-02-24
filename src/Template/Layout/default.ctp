<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <!-- CSS -->
        <?= $this->Html->css([
            'https://fonts.googleapis.com/css?family=Open+Sans:400,600',
            '/plugins/bootstrap/dist/css/bootstrap',
            '/plugins/owl.carousel/dist/assets/owl.carousel.min',
            'public/main'
        ]); ?>
    </head>

    <body>
        <?= $this->element('header'); ?>

        <?= $this->fetch('content'); ?>

        <?= $this->element('footer'); ?>

        <!-- JS -->
        <?= $this->Html->script([
            '/plugins/jquery/dist/jquery',
            '/plugins/owl.carousel/dist/owl.carousel.min',
            'public/jquery.refresh',
            'public/register',
            'public/main'
        ]); ?>
    </body>
</html>