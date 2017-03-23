<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <?= $this->Html->css('admin'); ?>
    </head>

    <body>
        <div id="container">
            <?= $this->element('header'); ?>
            <?= $this->element('sidebar'); ?>

            <div id="content">
                <?= $this->fetch('content'); ?>
            </div>
        </div>

        <?= $this->Html->script('admin'); ?>
    </body>
</html>