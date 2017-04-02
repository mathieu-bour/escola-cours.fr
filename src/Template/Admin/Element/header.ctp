<header class="header" id="header">
    <div class="header-left">
        <h1 class="header-logo">
            <?= $this->Html->link(
                '<i class="fa fa-bars visible-xs-inline-block"></i>',
                '#', [
                    'class' => 'toggle-nav',
                    'escape' => false
                ]
            ); ?>
            <?= $this->Html->link('Escola', '/admin/'); ?>
        </h1>
    </div>

    <div class="header-right">
        <?= $this->Html->link(
            'Déconnexion <i class="fa fa-sign-out"></i>',
            ['prefix' => false, 'controller' => 'users', 'action' => 'logout'],
            ['escape' => false]
        ); ?>
    </div>
</header>