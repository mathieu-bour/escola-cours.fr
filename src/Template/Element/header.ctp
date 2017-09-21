<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h1 class="main-title visible-xs-inline-block">
                    <?= $this->Html->link(
                        '<i class="fa fa-bars "></i> Escola',
                        '#', [
                            'class' => 'toggle-nav',
                            'escape' => false
                        ]
                    ); ?>
                </h1>
                <?= $this->Html->link(
                    $this->Html->image('escola-logo.png', ['height' => 50]),
                    '/',
                    ['class' => 'header-logo-link visible-md', 'escape' => false]
                ); ?>
            </div>
            <div class="col-md-9">
                <nav class="nav">
                    <ul class="nav-list">
                        <?php if ($isAdmin): ?>
                            <li class="nav-item">
                                <?= $this->Html->link('Administration', '/admin'); ?>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <?= $this->Html->link('Qui sommes-nous ?', [
                                'controller' => 'pages',
                                'action' => 'about'
                            ]); ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('Blog', [
                                'controller' => 'posts',
                                'action' => 'index'
                            ]); ?>
                        </li>
                        <?php if (!$isLogged): ?>
                            <li class="nav-item">
                                <?= $this->Html->link('Recrutement', [
                                    'controller' => 'users',
                                    'action' => 'teachers'
                                ]); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($isLogged): ?>
                            <li class="nav-item">
                                <?= $this->Html->link('Disponibilités', [
                                    'controller' => 'users',
                                    'action' => 'slots'
                                ]); ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('Mon compte', [
                                    'controller' => 'users',
                                    'action' => 'account'
                                ]); ?>
                            </li>
                            <li class="nav-item nav-item-primary">
                                <?= $this->Html->link('Déconnexion', [
                                    'controller' => 'users',
                                    'action' => 'logout'
                                ]); ?>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <?= $this->Html->link('Mon espace', [
                                    'controller' => 'users',
                                    'action' => 'login'
                                ]); ?>
                            </li>
                            <li class="nav-item nav-item-primary">
                                <?= $this->Html->link('Trouver un prof', [
                                    'controller' => 'users',
                                    'action' => 'register'
                                ]); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>