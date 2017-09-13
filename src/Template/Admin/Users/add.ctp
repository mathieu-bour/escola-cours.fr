<div class="panel">
    <div class="panel-heading">
        <h2>Ajouter un utilisateur</h2>
    </div>

    <div class="panel-body">
        <?= $this->Form->create(null, ['id' => 'user-add-admin-form']); ?>
        <?php $this->Form->unlockField('courses'); ?>
        <?= $this->Form->input('type', [
            'type' => 'radio',
            'label' => 'Type de compte',
            'options' => [
                'student' => 'Élève',
                'teacher' => 'Professeur'
            ],
            'default' => 'student'
        ]); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <?= $this->Form->input('lastname', ['label' => 'Nom']); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('firstname', ['label' => 'Prénom']); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $this->Form->input('email', ['label' => 'Adresse e-mail']); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('telephone', ['label' => 'Téléphone']); ?>
                    </div>
                </div>

                <?= $this->Form->input('address', ['label' => 'Adresse']); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $this->Form->input('new_password', [
                            'type' => 'password',
                            'label' => 'Mot de passe'
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('new_password_confirm', [
                            'type' => 'password',
                            'label' => 'Confirmation du mot de passe'
                        ]); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="control-label">Cours</label>
                <div id="courses-container"></div>

                <?= $this->Form->input('courses', [
                    'type' => 'hidden'
                ]); ?>

                <a class="btn btn-primary" id="add-course">Ajouter un cours</a>
            </div>
        </div>

        <button class="btn btn-primary">Valider</button>
        <button class="btn btn-default">Annuler</button>

        <?= $this->Form->end(); ?>
    </div>
</div>