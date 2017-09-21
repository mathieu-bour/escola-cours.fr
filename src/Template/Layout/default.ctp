<?php use Cake\Routing\Router; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Escola - <?= $pageTitle ?? 'Cours particuliers'; ?></title>
    <meta name="description" content="<?= $pageDescription ?? 'Escola : cours particulier sur la région Grand Est'; ?>">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Router::url('/img/icons/apple-touch-icon.png'); ?>') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Router::url('img/icons/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Router::url('img/icons/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= Router::url('img/icons/manifest.json') ?>">
    <link rel="mask-icon" href="<?= Router::url('img/icons/safari-pinned-tab.svg" color="#5bbad5') ?>">
    <link rel="shortcut icon" href="<?= Router::url('img/icons/favicon.ico') ?>">
    <meta name="msapplication-config" content="<?= Router::url('/img/icons/browserconfig.xml') ?>">
    <meta name="theme-color" content="#ffffff">

    <!-- Meta OG -->
    <meta property="og:url" content="<?= Router::url($here, true); ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Escola - <?= $pageTitle ?? 'Cours particuliers'; ?>"/>
    <meta property="og:description"
          content="<?= $pageDescription ?? 'Escola : cours particulier sur la région Grand Est'; ?>"/>

    <!-- CSS -->
    <?= $this->Html->css([
        '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700',
        '//fonts.googleapis.com/css?family=Yellowtail',
        'public'
    ]); ?>
</head>

<body>
<?= $this->element('header'); ?>

<?= $this->fetch('content'); ?>

<?= $this->element('footer'); ?>

<div id="overlay"></div>

<!-- JS -->
<?= $this->fetch('js'); ?>
<?= $this->Html->script('public'); ?>
</body>
</html>