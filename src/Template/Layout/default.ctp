<?php
use Cake\Routing\Router;
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Escola - <?= $pageTitle ?? 'Cours particuliers'; ?></title>
        <meta name="description" content="<?= $pageDescription ?? 'Escola : cours particulier sur la région Grand Est'; ?>">

        <!-- Meta OG -->
        <meta property="og:url" content="<?= Router::url($here, true); ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Escola - <?= $pageTitle ?? 'Cours particuliers'; ?>" />
        <meta property="og:description" content="<?= $pageDescription ?? 'Escola : cours particulier sur la région Grand Est'; ?>" />

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
        <?= $this->fetch('js'); ?>
        <?= $this->Html->script('public'); ?>
    </body>
</html>