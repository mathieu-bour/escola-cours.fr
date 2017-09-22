<section class="no-p">
    <div class="owl-carousel owl-theme" id="main-carousel">
        <div class="slide" id="slide-1">
            <div class="slide-outer">
                <?= $this->Html->image('slider/slide-1.png', ['class' => 'slide-bg']); ?>

                <div class="slide-inner container">
                    <h2 class="animated bounceIn">Bienvenue sur Escola</h2>
                    <?= $this->Html->link(
                        'Découvrez qui nous sommes',
                        ['controller' => 'pages', 'action' => 'about'],
                        ['class' => 'btn btn-ghost btn-lg animated bounceIn']
                    ); ?>
                </div>
            </div>
        </div>

        <div class="slide" id="slide-2">
            <div class="slide-outer">
                <?= $this->Html->image('slider/slide-2.png', ['class' => 'slide-bg']); ?>

                <div class="slide-inner container">
                    <?= $this->Html->link(
                        'Trouver un prof',
                        ['controller' => 'users', 'action' => 'register'],
                        ['class' => 'main-link']
                    ); ?>
                </div>
            </div>
        </div>

        <div class="slide" id="slide-3">
            <div class="slide-outer">
                <?= $this->Html->image('slider/slide-3.png', ['class' => 'slide-bg']); ?>

                <div class="slide-inner container">
                    <div class="title-container">
                        <h3>Escola est à</h3>
                        <h2>Metz</h2>
                        <?= $this->Html->link(
                            'En savoir plus',
                            ['controller' => 'posts', 'action' => 'index'],
                            ['class' => 'btn btn-ghost btn-lg hidden-xs']
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <h2 class="page-subtitle">
            <i class="fa fa-graduation-cap fa-flip-horizontal"></i>
            Retrouvez-nous
            <i class="fa fa-graduation-cap"></i>
        </h2>

        <div class="row">
            <div class="col-md-5">
                <div class="city">
                    <?= $this->Html->image('metz.png', ['class' => 'city-bg']); ?>

                    <div class="city-content">
                        <h3 class="city-name">Metz</h3>
                        <?= $this->Html->link(
                            'Trouver un prof',
                            ['controller' => 'users', 'action' => 'register'],
                            ['class' => 'city-link']
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
                <div class="city">
                    <?= $this->Html->image('nancy.png', ['class' => 'city-bg']); ?>

                    <div class="city-content">
                        <h3 class="city-name">Nancy</h3>
                        <a href="javascript:void(0)" class="city-link">Bientôt !</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-lighter">
    <div class="container">
        <h2 class="page-subtitle">Pourquoi choisir Escola ?</h2>

        <div class="features-container">
            <div class="row">
                <div class="col-md-4 col-md-offset-1 col-xs-6">
                    <div class="feature">
                        <div class="feature-icon"><span class="glyphicon glyphicon-home"></span></div>
                        <p class="feature-text">Des étudiants et enseignants compétents choisis par nos soins après
                            entretien.</p>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2 col-xs-6">
                    <div class="feature">
                        <div class="feature-icon"><span class="glyphicon glyphicon-time"></span></div>
                        <p class="feature-text">En quelques clics, faîtes votre demande de prof, et nous vous
                            sélectionnons un Super Prof
                            Escola en moins de 24 heures !</p>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-1 col-xs-6">
                    <div class="feature feature">
                        <div class="feature-icon"><span class="glyphicon glyphicon-tasks"></span></div>
                        <p class="feature-text">Un suivi approfondi de chaque élève selon leurs besoins, avec des bilans
                            réguliers.</p>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2 col-xs-6">
                    <div class="feature feature">
                        <div class="feature-icon"><span class="glyphicon glyphicon-euro"></span></div>
                        <p class="feature-text">Escola, c’est aucun frais de dossier ni d’inscription : les cours
                            particuliers à un prix enfin
                            raisonnable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php /*<section>
    <div class="container">
        <h2 class="page-subtitle">Partenaires</h2>
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <?= $this->Html->image('//placehold.it/255x120', ['class' => 'partner']); ?>
            </div>
            <div class="col-md-3 col-xs-6">
                <?= $this->Html->image('//placehold.it/255x120', ['class' => 'partner']); ?>
            </div>
            <div class="col-md-3 col-xs-6">
                <?= $this->Html->image('//placehold.it/255x120', ['class' => 'partner']); ?>
            </div>
            <div class="col-md-3 col-xs-6">
                <?= $this->Html->image('//placehold.it/255x120', ['class' => 'partner']); ?>
            </div>
        </div>
    </div>
</section>*/ ?>
