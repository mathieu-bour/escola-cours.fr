<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p>Vous voulez participer à la vie d'Escola ? Inscrivez-vous ici pour enseigner avec nous !</p>
                <div>
                    <?= $this->Flash->render(); ?>
                </div>

                <?= $this->Form->create(); ?>
                <?= $this->Form->input('type', ['type' => 'hidden', 'value' => 'teacher']); ?>
                <?= $this->Form->input('firstname', ['label' => 'Prénom']); ?>
                <?= $this->Form->input('lastname', ['label' => 'Nom']); ?>
                <?= $this->Form->input('email', ['label' => 'Adresse e-mail']); ?>
                <?= $this->Form->input('password', ['label' => 'Mot de passe']); ?>
                <?= $this->Form->input('password_confirm', ['label' => 'Confirmation du mot de passe']); ?>

                <?= $this->element('course-form'); ?>

                <button class="btn btn-primary">Envoyer</button>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
