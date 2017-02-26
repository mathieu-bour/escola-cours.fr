<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= $this->Flash->render('auth'); ?>

                <?= $this->Form->create(); ?>
                <?= $this->Form->input('email'); ?>
                <?= $this->Form->input('password'); ?>

                <button class="btn btn-primary">Connexion</button>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
