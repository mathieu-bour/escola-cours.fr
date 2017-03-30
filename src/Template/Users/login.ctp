<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= $this->Flash->render('auth'); ?>
                <?= $this->Form->create(null, [
                    'url' => [
                        'controller' => 'users',
                        'action' => 'login',
                        '?' => !empty($redirect) ? ['redirect' => $redirect] : null
                    ]
                ]); ?>
                <?= $this->Form->input('email', [
                    'label' => 'Adresse e-mail'
                ]); ?>
                <?= $this->Form->input('password', [
                    'label' => 'Mot de passe'
                ]); ?>

                <?= $this->Html->link(
                    'Vous avez oublié votre mot de passe ?', [
                    'controller' => 'users',
                    'action' => 'forgot'
                ], [
                    'class' => 'forgot-password'
                ]); ?>

                <button class="btn btn-primary">Connexion</button>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
