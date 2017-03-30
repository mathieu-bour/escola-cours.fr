<header class="header" id="header">
    <div class="header-left">
        <h1 class="header-logo">Escola</h1>

        <div class="header-profile clearfix">
            <div class="header-profile-meta">
                <div class="header-profile-welcome">Bienvenue</div>
                <div class="header-profile-name">
                    <?= $this->request->session()->read('Auth.User.firstname'); ?>
                    <?= $this->request->session()->read('Auth.User.lastname'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="header-right">
        <?= $this->Html->link(
            'Déconnexion <i class="fa fa-sign-out"></i>',
            ['prefix' => false, 'controller' => 'users', 'action' => 'logout'],
            ['escape' => false]
        ); ?>
    </div>
</header>