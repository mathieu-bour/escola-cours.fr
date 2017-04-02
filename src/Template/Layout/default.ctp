<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Escola - <?= $pageTitle ?? 'Cours particuliers'; ?></title>

        <!-- CSS -->
        <?= $this->Html->css('public'); ?>
    </head>

    <body>
        <?= $this->element('header'); ?>

        <?php if (!empty($pageTitle)): ?>
            <section class="bg-graphing-paper">
                <div class="container">
                    <h1 class="page-title"><?= $pageTitle; ?></h1>
                </div>
            </section>
        <?php endif; ?>

        <?= $this->fetch('content'); ?>

        <?= $this->element('footer'); ?>

        <div id="overlay"></div>

        <!-- JS -->
        <?= $this->Html->script('public'); ?>
    </body>
</html>