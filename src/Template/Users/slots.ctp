<h1 class="page-title">Disponibilités</h1>

<section>
    <div class="container">
        <div class="callout callout-primary">
            <p>Indiquez ici vos disponibilités types ; les ajustements seront faits avec l'équipe de coordinations au
                cas par cas.</p>
            <p>Cliquez sur une case pour en changer la valeur : rouge = indisponible et vert = disponible.</p>
        </div>

        <?= $this->Form->create(null, ['id' => 'user-slots-form']); ?>
        <div class="table-responsive">
            <table class="table table-bordered slots">
                <thead>
                    <tr>
                        <th>Heure</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                        <th>Dimanche</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < 24; $i++) { ?>
                        <tr>
                            <td>
                                <?= $i < 10 ? '0' . $i : $i; ?>:00 - <?= $i + 1 < 10 ? '0' . ($i + 1) : $i + 1; ?>:00
                            </td>
                            <?php for ($j = 0; $j < 7; $j++) { ?>
                                <td class="slot">
                                    <?= $this->Form->input('slots[' . $j . '][' . $i . ']', [
                                        'type' => 'checkbox',
                                        'hiddenField' => false,
                                        'label' => '',
                                        'checked' => !empty($slots[$j][$i])
                                    ]); ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary">Mettre à jour mes disponibilités</button>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</section>