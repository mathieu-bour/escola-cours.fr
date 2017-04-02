<footer class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Html->image('//placehold.it/200x80', ['class' => 'footer-logo']); ?>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta expedita explicabo necessitatibus
                        ipsum dolor sit amet.</p>
                </div>

                <div class="col-md-3">
                    <h4 class="footer-title">Suivez-nous !</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta expedita explicabo
                        necessitatibus</p>

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
                        <li>
                            <?= $this->Html->link('C.G.U.', [
                                'controller' => 'pages',
                                'action' => 'cgu'
                            ]); ?>
                        </li>
                        <li>
                            <?= $this->Html->link('C.G.V.', [
                                'controller' => 'pages',
                                'action' => 'cgv'
                            ]); ?>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h4 class="footer-title">Développeurs</h4>

                    <p>Proudly developped and maintained by</p>

                    <?= $this->Html->link(
                        $this->Html->image('synthetica-logo.png'),
                        'https://synthetica.fr', [
                        'escape' => false
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <p class="copyright">Copyright &copy; 2017 | Escola SARL</p>
</footer>