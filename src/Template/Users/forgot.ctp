<section class="page-title-container">
    <h1 class="page-title">Mot de passe oublié</h1>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p>Pour réinitiliser votre mot de passe, veuillez nous fournir votre adresse e-mail.</p>
                <div>
                    <?= $this->Flash->render(); ?>
                </div>

                <?= $this->Form->create(); ?>
                <?= $this->Form->input('email'); ?>

                <button class="btn btn-primary">Envoyer</button>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
