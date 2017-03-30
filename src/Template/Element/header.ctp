<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h1 class="main-title"><?= $this->Html->link('Escola', '/'); ?></h1>
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
                                <?= $this->Html->link('Connexion', [
                                    'controller' => 'users',
                                    'action' => 'login'
                                ]); ?>
                            </li>
                            <li class="nav-item nav-item-primary">
                                <?= $this->Html->link('Inscription', [
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