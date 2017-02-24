<section>
    <div class="container">
        <?= $this->Form->create(null, ['id' => 'user-register-form']); ?>
        <?php $this->Form->unlockField('courses'); ?>

        <h3>Profil</h3>
        <h4>Je suis :</h4>
        <?= $this->Form->radio('type', ['student' => 'Élève', 'teacher' => 'Professeur']); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $this->Form->input('lastname', ['label' => 'Nom']); ?>
                <?= $this->Form->input('email', ['label' => 'Adresse e-mail']); ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('firstname', ['label' => 'Prénom']); ?>
                <?= $this->Form->input('telephone', ['label' => 'Téléphone']); ?>
            </div>
        </div>

        <?= $this->Form->input('address', [
            'type' => 'textarea',
            'label' => 'Adresse postale complète',
            'rows' => 2,
            'placeholder' => "6 rue de la Paix\n57000 Metz"
        ]); ?>


        <h3>Mot de passe</h3>
        <div class="row">
            <div class="col-md-6">
                <?= $this->Form->input('password', [
                    'label' => 'Mot de passe'
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('password_confirm', [
                    'type' => 'password',
                    'label' => 'Confirmation du mot de passe'
                ]); ?>
            </div>
        </div>


        <h3>Cours recherchés</h3>
        <div id="courses-container"></div>

        <?= $this->Form->input('courses', [
            'type' => 'hidden'
        ]); ?>


        <button class="btn btn-primary" id="add-course"> Ajouter un cours</button>

        <div class="text-center">
            <button class="btn btn-lg btn-success"> Valider mon inscription</button>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</section>