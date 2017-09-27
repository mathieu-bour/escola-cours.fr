<section class="page-title-container">
    <h1 class="page-title">Réinitialisation</h1>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= $this->Flash->render('auth'); ?>

                <?= $this->Form->create(); ?>
                <?= $this->Form->input('password', [
                    'label' => 'Mot de passe'
                ]); ?>
                <?= $this->Form->input('password_confirm', [
                    'label' => 'Confirmation du mot de passe'
                ]); ?>

                <button class="btn btn-primary">Réinitialiser mon mot de passe</button>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
