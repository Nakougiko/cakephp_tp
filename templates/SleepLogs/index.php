<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SleepLog> $sleepLogs
 */
?>
<div class="sleepLogs index content">
    <?= $this->Html->link(__('Nouveau journal de sommeil'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Mes journaux de sommeil') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('date', 'Date') ?></th>
                    <th><?= $this->Paginator->sort('bedtime', 'Heure du coucher') ?></th>
                    <th><?= $this->Paginator->sort('wake_time', 'Heure du réveil') ?></th>
                    <th><?= $this->Paginator->sort('cycles_count', 'Nombre de cycles') ?></th>
                    <th><?= $this->Paginator->sort('morning_form_score', 'Forme matinale') ?></th>
                    <th><?= $this->Paginator->sort('sports_activity', 'Activité sportive') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sleepLogs as $sleepLog): ?>
                <tr>
                    <td><?= h($sleepLog->date) ?></td>
                    <td><?= h($sleepLog->bedtime) ?></td>
                    <td><?= h($sleepLog->wake_time) ?></td>
                    <td>
                        <?= $this->Number->format($sleepLog->cycles_count) ?>
                        <?php
                        // Durée d'un cycle en minutes
                        $cycleDuration = 90;
                        // Nombre minimum de cycles pour avoir l'indicateur vert
                        $minimumCycles = 5;
                        // Temps minimum en minutes (450 minutes pour 5 cycles)
                        $minimumSleepTime = $minimumCycles * $cycleDuration;

                        // Récupération des timestamps Unix
                        $bedtimeTimestamp = $sleepLog->bedtime->format('U');
                        $wakeTimeTimestamp = $sleepLog->wake_time->format('U');

                        // Calcul de la durée de sommeil en minutes
                        $sleepDurationMinutes = ($wakeTimeTimestamp - $bedtimeTimestamp) / 60;

                        // Vérification si la durée respecte les conditions pour un bon sommeil
                        if ($sleepDurationMinutes >= $minimumSleepTime - 10) {
                            echo '<span style="color: green; margin-left: 5px;">🟢</span>'; // Indicateur vert
                        } else {
                            echo '<span style="color: red; margin-left: 5px;">🔴</span>'; // Indicateur rouge
                        }
                        ?>
                    </td>
                    <td><?= $this->Number->format($sleepLog->morning_form_score) ?></td>
                    <td><?= h($sleepLog->sports_activity) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $sleepLog->id]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $sleepLog->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $sleepLog->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer l\'élément #{0}?', $sleepLog->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Première')) ?>
            <?= $this->Paginator->prev('< ' . __('Précédente')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Suivante') . ' >') ?>
            <?= $this->Paginator->last(__('Dernière') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, affichant {{current}} enregistrement(s) sur un total de {{count}}')) ?></p>
    </div>
</div>
