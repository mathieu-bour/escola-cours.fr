<footer class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Html->image('escola-logo.png', ['class' => 'footer-logo', 'height' => '60']); ?>
                    <p>Escola, la réussite imminente !</p>
                </div>

                <div class="col-md-3">
                    <h4 class="footer-title">Suivez-nous !</h4>
                    <p>Escola est sur Facebook ! Restez connecté pour recevoir les dernières informations !</p>

                    <ul class="footer-socials clearfix">
                        <li>
                            <?= $this->Html->link(
                                '<i class="fa fa-facebook"></i>',
                                'https://www.facebook.com/Escola-1731493677142558',
                                ['escape' => false, 'target' => '_blank']
                            ); ?>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h4 class="footer-title">Liens</h4>

                    <ul>
                        <li>
                            <?= $this->Html->link('Connexion', [
                                'controller' => 'users',
                                'action' => 'login'
                            ]); ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Inscription', [
                                'controller' => 'users',
                                'action' => 'register'
                            ]); ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Qui sommes-nous ?', [
                                'controller' => 'pages',
                                'action' => 'about'
                            ]); ?>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h4 class="footer-title">Contact</h4>

                    <p>Pour toute question, contactez-nous par mail à l’adresse suivante :</p>

                    <p><?= $this->Html->link('contact@escola-cours.fr', 'mailto:contact@escola-cours.fr'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <p class="copyright">Copyright &copy; 2017 | Escola SARL - Baked with love by Mathieu Bour</p>
</footer>