<aside class="sidebar" id="sidebar">
    <div class="sidebar-profile clearfix">
        <div class="sidebar-profile-meta">
            <div class="sidebar-profile-welcome">Bienvenue</div>
            <div class="sidebar-profile-name">
                <?= $this->request->session()->read('Auth.User.firstname'); ?>
                <?= $this->request->session()->read('Auth.User.lastname'); ?>
            </div>
        </div>
    </div>

    <h5 class="sidebar-title">Navigation</h5>

    <nav class="nav">
        <ul class="menu">
            <li class="menu-item">
                <?= $this->Html->link(
                    '<i class="fa fa-fw fa-bar-chart" aria-hidden="true"></i>Tableau de bord',
                    '/admin',
                    ['escape' => false]
                ); ?>
            </li>
            <li class="menu-item has-submenu">
                <a href="#"><i class="fa fa-fw fa-book" aria-hidden="true"></i>Cours</a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <?= $this->Html->link(
                            'Ajouter un cours',
                            ['controller' => 'lessons', 'action' => 'add']
                        ); ?>
                    </li>
                    <li class="submenu-item">
                        <?= $this->Html->link(
                            'Historique des cours',
                            ['controller' => 'lessons']
                        ); ?>
                    </li>
                </ul>
            </li>
            <li class="menu-item has-submenu">
                <a href="#"><i class="fa fa-fw fa-users" aria-hidden="true"></i>Utilisateurs</a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <?= $this->Html->link(
                            'Ajouter un utilisateur',
                            ['controller' => 'users', 'action' => 'add']
                        ); ?>
                    </li>
                    <li class="submenu-item">
                        <?= $this->Html->link(
                            'Élèves',
                            ['controller' => 'users', 'action' => 'students']
                        ); ?>
                    </li>
                    <li class="submenu-item">
                        <?= $this->Html->link(
                            'Professeurs',
                            ['controller' => 'users', 'action' => 'teachers']
                        ); ?>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <?= $this->Html->link(
                    '<i class="fa fa-fw fa-graduation-cap" aria-hidden="true"></i>Disciplines et niveaux',
                    ['controller' => 'pages', 'action' => 'settings'],
                    ['escape' => false]
                ); ?>
            </li>
        </ul>
    </nav>
</aside>