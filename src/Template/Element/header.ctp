<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="main-title"><?= $this->Html->link('Escola', '/'); ?></h1>
            </div>
            <div class="col-md-8">
                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item"><a href="#">Qui somme-nous ?</a></li>
                        <li class="nav-item"><a href="#">Recrutement</a></li>
                        <li class="nav-item"><a href="#">Enseigner</a></li>
                        <li class="nav-item"><a href="#">Nos partenaires</a></li>
                        <li class="nav-item nav-item-primary">
                            <?= $this->Html->link('Inscription', [
                                'controller' => 'users',
                                'action' => 'register'
                            ]); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>