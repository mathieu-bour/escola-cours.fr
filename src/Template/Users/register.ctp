<?php use Cake\Core\Configure; ?>
<section class="page-title-container">
    <h1 class="page-title">Inscription</h1>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?= $this->Form->create(null, ['id' => 'user-register-form']) ?>
                <?= $this->Flash->render() ?>

                <div class="owl-carousel owl-theme" id="register-form-carousel">
                    <div class="form-page">
                        <h3>Tout d'abord, nous avons besoin de votre adresse</h3>

                        <?= $this->Form->input('dynamic-address', [
                            'class' => 'input-lg',
                            'placeholder' => '10 rue Einstein Metz',
                            'label' => false,
                            'append' => $this->Form->button('<i class="fa fa-search"></i>', [
                                'id' => 'locate-btn',
                                'class' => 'btn-lg btn-primary',
                                'type' => 'button'
                            ])
                        ]) ?>
                        <?= $this->Form->input('address', ['type' => 'hidden']) ?>
                        <?= $this->Form->input('city', ['type' => 'hidden']) ?>
                        <?= $this->Form->input('zip_code', ['type' => 'hidden']) ?>

                        <div id="register-form-map"></div>
                    </div>

                    <div class="form-page">
                        <h3>Nous avons maintenant besoin de quelques informations personnelles</h3>

                        <?= $this->Form->input('lastname', ['label' => 'Nom']) ?>
                        <?= $this->Form->input('firstname', ['label' => 'Prénom']) ?>
                        <?= $this->Form->input('email', ['label' => 'Adresse e-mail']) ?>
                        <?= $this->Form->input('telephone', ['label' => 'Téléphone']) ?>
                    </div>

                    <div class="form-page">
                        <h3>Excellent !</h3>
                        <p>Choisissez maintenant votre mot de passe</p>

                        <?= $this->Form->input('password', ['label' => 'Mot de passe']) ?>
                        <?= $this->Form->input('password_confirm', [
                            'type' => 'password',
                            'label' => 'Confirmation du mot de passe'
                        ]) ?>
                    </div>

                    <div class="form-page">
                        <h3>Parfait !</h3>
                        <p>Indiquez maintenant quels cours vous recherchez</p>

                        <div id="courses-container"></div>
                        <?php $this->Form->unlockFields("courses") ?>

                        <a class="btn btn-primary" id="add-course">Ajouter un cours</a>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Valider mon inscription</button>
                        </div>
                    </div>
                </div>

                <div>
                    <span id="register-form-message"></span>
                    <button class="btn btn-primary pull-right" id="register-form-next" style="display: none">
                        Continuer
                    </button>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<?php $this->start('js') ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= Configure::read('GoogleMapsAPI.key') ?>"></script>
<?php $this->end() ?>

