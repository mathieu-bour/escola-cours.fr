<section class="page-title-container">
    <h1 class="page-title">Mon compte</h1>
</section>


<section>
    <div class="container">
        <?= $this->Flash->render(); ?>

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profil</a>
            </li>
            <li role="presentation">
                <a href="#password" aria-controls="password" role="tab" data-toggle="tab">Mot de passe</a>
            </li>
            <li role="presentation">
                <a href="#courses" aria-controls="messages" role="tab" data-toggle="tab">Cours et matières</a>
            </li>
        </ul>

        <?= $this->Form->create($user, ['id' => 'user-account-form']); ?>
        <?php $this->Form->unlockField('courses'); ?>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="profile">
                <h3 class="title-lined"><span class="bg-white">Profil</span></h3>
                <div class="form-block">
                    <div class="callout callout-primary">
                        Ces informations sont strictement confidentielles et uniquement visibles par les administrateurs
                        d'Escola.
                    </div>

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
                    <div class="callout callout-primary">
                        Vous pouvez changer ici votre mot de passe.
                    </div>

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
                <h3 class="title-lined"><span class="bg-white">Cours et matières</span></h3>
                <div class="form-block">
                    <div id="courses-container">
                        <div class="callout callout-primary">
                            Pour supprimer un cours enregistré, cliquez sur le couton "Supprimer".
                        </div>

                        <?php foreach ($user->courses as $key => $course): ?>
                            <div class="course">
                                <?= $this->Form->input('courses[id]', [
                                    'type' => 'hidden',
                                    'value' => $course->id
                                ]); ?>
                                <div class="row">
                                    <div class="col-md-5">
                                        <?= $this->Form->input('courses[level_id]', [
                                            'label' => false,
                                            'type' => 'select',
                                            'options' => $levels,
                                            'value' => $course->level_id
                                        ]); ?>
                                    </div>
                                    <div class="col-md-5">
                                        <?= $this->Form->input('courses[discipline_id]', [
                                            'label' => false,
                                            'type' => 'select',
                                            'options' => $disciplines,
                                            'value' => $course->discipline_id
                                        ]); ?>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-block remove-course">
                                            Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="add-course">Ajouter un cours</button>
            </div>

            <div class="text-center">
                <button class="btn btn-lg btn-primary">Mettre à jour mon profil</button>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</section>
