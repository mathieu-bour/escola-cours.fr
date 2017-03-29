<aside class="sidebar" id="sidebar">

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
            <li class="menu-item">
                <?= $this->Html->link(
                    '<i class="fa fa-fw fa-plus" aria-hidden="true"></i>Ajouter un utilisateur',
                    ['controller' => 'users', 'action' => 'add'],
                    ['escape' => false]
                ); ?>
            </li>
            <li class="menu-item">
                <?= $this->Html->link(
                    '<i class="fa fa-fw fa-users" aria-hidden="true"></i>Élèves',
                    ['controller' => 'users', 'action' => 'students'],
                    ['escape' => false]
                ); ?>
            </li>
            <li class="menu-item">
                <?= $this->Html->link(
                    '<i class="fa fa-fw fa-graduation-cap" aria-hidden="true"></i>Professeurs',
                    ['controller' => 'users', 'action' => 'teachers'],
                    ['escape' => false]
                ); ?>
            </li>
        </ul>
    </nav>
</aside>