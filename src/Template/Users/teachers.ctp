<section class="page-title-container">
    <h1 class="page-title">Recrutement</h1>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p>Vous voulez participer à la vie d'Escola ? Inscrivez-vous ici pour enseigner avec nous !</p>
                <div>
                    <?= $this->Flash->render(); ?>
                </div>

                <?= $this->Form->create(null, ['id' => 'user-recruitment-form']); ?>

                <h3 class="title-lined"><span class="bg-white">Informations personnelles</span></h3>
                <div class="form-block">
                    <?= $this->Form->input('firstname', ['label' => 'Prénom']); ?>
                    <?= $this->Form->input('lastname', ['label' => 'Nom']); ?>
                    <?= $this->Form->input('email', ['label' => 'Adresse e-mail']); ?>
                </div>

                <h3 class="title-lined"><span class="bg-white">Les cours que vous pourriez dispenser</span></h3>
                <div class="form-block">
                    <?= $this->element('course-form'); ?>
                </div>

                <h3 class="title-lined"><span class="bg-white">Vos disponibilités pour enseigner</span></h3>
                <div class="form-block">
                    <?= $this->Form->input('availabilities', ['type' => 'textarea', 'label' => 'Disponibilités']); ?>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-lg">Valider mon inscription</button>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
