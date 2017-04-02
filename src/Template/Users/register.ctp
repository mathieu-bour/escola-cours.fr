<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="paper paper-curl-right">
                    <?= $this->Html->image('//placehold.it/320'); ?>
                </div>
            </div>
            <div class="col-md-8">
                <h2>Comment profiter des services d'Escola ?</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum eveniet odio placeat
                    praesentium recusandae rem, velit veritatis voluptates voluptatum! Consequuntur cum et eveniet
                    fugiat iste, maiores modi odit quaerat sint?</p>

                <div class="callout callout-primary">
                    <h4>Titre</h4>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum eveniet odio placeat
                        praesentium recusandae rem, velit veritatis voluptates voluptatum! Consequuntur cum et eveniet
                        fugiat iste, maiores modi odit quaerat sint?</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-lighter">
    <div class="container">
        <?= $this->Flash->render(); ?>

        <?= $this->Form->create($user ?? null, ['id' => 'user-register-form']); ?>
        <?php $this->Form->unlockField('courses'); ?>

        <h3 class="title-lined"><span class="bg-gray-lighter">Profil</span></h3>
        <div class="form-block">
            <h4>Je suis :</h4>
            <?= $this->Form->radio('type', [
                'student' => 'Élève',
                'teacher' => 'Professeur'
            ], [
                'default' => 'student'
            ]); ?>

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


        <h3 class="title-lined"><span class="bg-gray-lighter">Mot de passe</span></h3>
        <div class="form-block">
            <div class="row">
                <div class="col-md-6">
                    <?= $this->Form->input('password', [
                        'type' => 'password',
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
        </div>


        <h3 class="title-lined"><span class="bg-gray-lighter">Cours et matières</span></h3>
        <div class="form-block">
            <div id="courses-container"></div>

            <?= $this->Form->input('courses', [
                'type' => 'hidden'
            ]); ?>

            <a class="btn btn-primary" id="add-course">Ajouter un cours</a>
        </div>


        <div class="text-center">
            <button class="btn btn-lg btn-primary">Valider mon inscription</button>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</section>