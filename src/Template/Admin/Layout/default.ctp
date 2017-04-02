<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Escola - Administraion - <?= $pageTitle ?? ''; ?></title>

        <!-- CSS -->
        <?= $this->Html->css('admin'); ?>
    </head>

    <body>
        <div id="container">
            <?= $this->element('header'); ?>
            <?= $this->element('sidebar'); ?>

            <div id="content">
                <div class="panel">
                    <?php if (!empty($pageTitle)): ?>
                        <div class="panel-heading">
                            <h2 class="page-title"><?= $pageTitle; ?></h2>
                        </div>
                    <?php endif; ?>
                    <div class="panel-body">
                        <?= $this->Breadcrumbs->render($crumbList); ?>

                        <?= $this->Flash->render(); ?>
                        <?= $this->fetch('content'); ?>
                    </div>
                </div>
            </div>

            <div id="overlay"></div>
        </div>

        <!-- JS -->
        <?= $this->Html->script('admin'); ?>
        <?= $this->fetch('script'); ?>
    </body>
</html>