<section>
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profil</a>
            </li>
            <li role="presentation">
                <a href="#password" aria-controls="password" role="tab" data-toggle="tab">Mot de passe</a>
            </li>
            <li role="presentation">
                <a href="#courses" aria-controls="messages" role="tab" data-toggle="tab">Cours</a>
            </li>
        </ul>

        <?= $this->Form->create($user, ['id' => 'user-account-form']); ?>
        <?php $this->Form->unlockField('courses'); ?>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="profile">
                <h3 class="title-lined"><span class="bg-white">Profil</span></h3>
                <div class="form-block">
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

                    <div class="row">
                        <div class="col-md-8">
                            <?= $this->Form->input('address', ['label' => 'Adresse']); ?>
                        </div>
                        <div class="col-md-2">
                            <?= $this->Form->input('zip_code', ['label' => 'Code postal']); ?>
                        </div>
                        <div class="col-md-2">
                            <?= $this->Form->input('city', ['label' => 'Ville']); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="password">
                <h3 class="title-lined"><span class="bg-white">Mot de passe</span></h3>
                <div class="form-block">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->Form->input('password', [
                                'label' => 'Mot de passe',
                                'required' => false
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->input('password_confirm', [
                                'type' => 'password',
                                'label' => 'Confirmation du mot de passe'
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="courses">
                <h3 class="title-lined"><span class="bg-white">Cours recherchés</span></h3>
                <div class="form-block">
                    <div id="courses-container">
                        <div class="callout callout-primary">
                            Pour supprimer un cours enregistré, cliquez sur le couton "Supprimer".
                        </div>
                        <?php foreach ($user->courses as $key => $course): ?>
                            <div class="course">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?= $this->Form->input('courses[' . $key . '][level_id]', [
                                            'label' => false,
                                            'type' => 'select',
                                            'options' => [$course->level->id => $course->level->name],
                                            'value' => $course->level->name
                                        ]); ?>
                                    </div>
                                    <div class="col-md-5">
                                        <?= $this->Form->input('courses[' . $key . '][discipline_id]', [
                                            'label' => false,
                                            'type' => 'select',
                                            'options' => [$course->discipline->id => $course->discipline->name],
                                            'value' => $course->discipline->name
                                        ]); ?>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-block remove-existing-course">
                                            Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?= $this->Form->input('courses', [
                    'type' => 'hidden',
                    'value' => ''
                ]); ?>

                <button type="button" class="btn btn-primary" id="add-course">Ajouter un cours</button>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary">Mettre à jour mon profil</button>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</section>
