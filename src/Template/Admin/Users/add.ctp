<div class="panel">
    <div class="panel-heading">
        <h2>Ajouter un utilisateur</h2>
    </div>

    <div class="panel-body">
        <?= $this->Form->create(null, ['id' => 'user-add-admin-form']); ?>
        <?php $this->Form->unlockField('courses'); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <?= $this->Form->input('lastname', ['label' => 'Nom']); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->input('firstname', ['label' => 'Prénom']); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->input('type', [
                            'label' => 'Type de compte',
                            'options' => [
                                'student' => 'Élève',
                                'teacher' => 'Professeur',
                                'admin' => 'Administrateur'
                            ],
                            'default' => 'student'
                        ]); ?>
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

                <div class="row">
                    <div class="col-md-7">
                        <?= $this->Form->input('address', ['label' => 'Adresse']); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->input('zip_code', ['label' => 'Code postal']); ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->input('city', ['label' => 'Ville']); ?>
                    </div>
                </div>

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

                <?= $this->Form->input('social_security_number', ['label' => 'Numéro de sécurité sociale']); ?>

                <?= $this->Form->input('notes', ['type' => 'textarea', 'label' => 'Notes']); ?>
            </div>

            <div class="col-md-6">
                <label class="control-label">Cours</label>

                <?= $this->element('../Element/course-form'); ?>
            </div>
        </div>

        <button class="btn btn-primary">Valider</button>
        <button class="btn btn-default">Annuler</button>

        <?= $this->Form->end(); ?>
    </div>
</div>