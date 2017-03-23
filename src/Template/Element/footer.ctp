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
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta expedita explicabo necessitatibus</p>

                    <ul class="footer-socials">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h4 class="footer-title">Liens</h4>

                    <ul>
                        <li><?= $this->Html->link('Qui sommes-nous ?', ['controller' => 'pages', 'action' => 'about']); ?></li>
                        <li><?= $this->Html->link('C.G.U.', ['controller' => 'pages', 'action' => 'cgu']); ?></li>
                        <li><?= $this->Html->link('C.G.V.', ['controller' => 'pages', 'action' => 'cgv']); ?></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h4 class="footer-title">Développeurs</h4>

                    <p class="text-center">Proudly developped and maintained by the synthetica team</p>
                </div>
            </div>
        </div>
    </div>

    <p class="copyright">Copyright &copy; 2017 | Escola SARL</p>
</footer>