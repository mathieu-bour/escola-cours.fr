<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p>Vous voulez participer à la vie d'Escola ? Inscrivez-vous ici pour enseigner avec nous !</p>
                <div>
                    <?= $this->Flash->render(); ?>
                </div>

                <?= $this->Form->create(); ?>

                <h3 class="title-lined"><span class="bg-gray-lighter">Informations personnelles</span></h3>
                <div class="form-block">
                    <?= $this->Form->input('type', ['type' => 'hidden', 'value' => 'teacher']); ?>
                    <?= $this->Form->input('firstname', ['label' => 'Prénom']); ?>
                    <?= $this->Form->input('lastname', ['label' => 'Nom']); ?>
                    <?= $this->Form->input('email', ['label' => 'Adresse e-mail']); ?>
                </div>

                <h3 class="title-lined"><span class="bg-gray-lighter">Les cours que vous pourriez dispenser</span></h3>
                <div class="form-block">
                    <?= $this->element('course-form'); ?>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-lg">Validert mon inscription</button>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
