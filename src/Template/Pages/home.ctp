<section>
    <div class="owl-carousel owl-theme">
        <div>
            <?= $this->Html->image('//placehold.it/1920x600'); ?>
        </div>
        <div>
            <?= $this->Html->image('//placehold.it/1920x600'); ?>
        </div>
        <div>
            <?= $this->Html->image('//placehold.it/1920x600'); ?>
        </div>
        <div>
            <?= $this->Html->image('//placehold.it/1920x600'); ?>
        </div>
    </div>
</section>

<div class="container">
    <section class="clearfix">
        <h2>Trouvez votre professeur</h2>

        <?= $this->Form->create(null, ['url' => ['controller' => 'lessons', 'action' => 'search']]); ?>
        <div class="col-md-3">
            <?= $this->Form->select('course', ['maths' => 'Mathématiques', 'physique' => 'Physique']); ?>
        </div>
        <div class="col-md-3">
            <?= $this->Form->select('level', ['6e' => '6e', '5e' => '5e']); ?>
        </div>
        <div class="col-md-3">
            <?= $this->Form->select('city', ['metz' => 'Metz', 'nancy' => 'Nancy']); ?>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary btn-block">Valider</button>
        </div>
        <?= $this->Form->end(); ?>
    </section>

    <section>
        <div class="col-md-4 col-md-offset-1">
            <?= $this->Html->image('metz.jpg'); ?>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <?= $this->Html->image('//placehold.it/350'); ?>
        </div>
    </section>
</div>
