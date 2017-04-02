<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
                <h3>Niveaux scolaires</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($levels as $level): ?>
                            <tr>
                                <td><?= $level->name; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
                <h3>Ajouter un niveau</h3>
            </div>
            <div class="panel-body">
                <?= $this->Form->create(null, ['url' => ['controller' => 'levels', 'action' => 'add']]); ?>
                <?= $this->Form->input('name', [
                    'label' => 'Nom du niveau'
                ]); ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
                <h3>Disciplines scolaires</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($disciplines as $discipline): ?>
                            <tr>
                                <td><?= $discipline->name; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-heading">
                <h3>Ajouter une discipline</h3>
            </div>
            <div class="panel-body">
                <?= $this->Form->create(null, ['url' => ['controller' => 'disciplines', 'action' => 'add']]); ?>
                <?= $this->Form->input('name', [
                    'label' => 'Nom de la discipline'
                ]); ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>