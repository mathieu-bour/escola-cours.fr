<div class="panel">
    <div class="panel-heading">
        <h2>Éditer un utilisateur</h2>
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
            'default' => 'student',
            'value' => $user->type
        ]); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <?= $this->Form->input('lastname', ['label' => 'Nom', 'value' => $user->lastname]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('firstname', ['label' => 'Prénom', 'value' => $user->firstname]); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $this->Form->input('email', ['label' => 'Adresse e-mail', 'value' => $user->email]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('telephone', ['label' => 'Téléphone', 'value' => $user->telephone]); ?>
                    </div>
                </div>

                <?= $this->Form->input('address', ['label' => 'Adresse', 'value' => $user->address]); ?>

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

                <?= $this->Form->input('social_security_number', ['label' => 'Numéro de sécurité sociale', 'value' => $user->social_security_number]); ?>

                <?= $this->Form->input('notes', ['type' => 'textarea', 'label' => 'Notes', 'value' => $user->notes]); ?>
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