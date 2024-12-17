<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SleepLog> $sleepLogs
 * @var int $totalCycles
 * @var int $maxConsecutiveDays
 * @var string $currentWeekStart
 * @var string $currentWeekEnd
 * @var string $previousWeekStart
 * @var string $previousWeekEnd
 * @var string $nextWeekStart
 * @var string $nextWeekEnd
 */
?>

<div class="sleepLogs weekData content">
    <h3><?= __('Données de la semaine') ?></h3>

    <!-- Affichage des données de la semaine en cours -->
    <div class="week-indicator">
        <h4>Semaines de : <?= h($currentWeekStart) ?> à <?= h($currentWeekEnd) ?></h4>
    </div>

    <!-- Navigation entre les semaines -->
    <div class="week-navigation">
        <div class="previous-week">
            <?= $this->Html->link(__('Semaine précédente'), ['action' => 'weekData', '?' => ['start' => $previousWeekStart, 'end' => $previousWeekEnd]], ['class' => 'button']) ?>
        </div>
        <div class="next-week">
            <?= $this->Html->link(__('Semaine suivante'), ['action' => 'weekData', '?' => ['start' => $nextWeekStart, 'end' => $nextWeekEnd]], ['class' => 'button']) ?>
        </div>
    </div>

    <!-- Indicateur de total des cycles de sommeil -->
    <div class="indicator">
        <h4>Total des cycles de sommeil cette semaine : <?= $totalCycles ?></h4>
        <?php if ($totalCycles >= 42): ?>
            <div class="indicator green">Objectif total atteint !</div>
        <?php else: ?>
            <div class="indicator red">Objectif total non atteint</div>
        <?php endif; ?>
    </div>

    <!-- Indicateur des jours consécutifs avec 5 cycles -->
    <div class="indicator">
        <h4>Jours consécutifs avec au moins 5 cycles : <?= $maxConsecutiveDays ?></h4>
        <?php if ($maxConsecutiveDays >= 4): ?>
            <div class="indicator green">Objectif consécutif atteint !</div>
        <?php else: ?>
            <div class="indicator red">Objectif consécutif non atteint</div>
        <?php endif; ?>
    </div>

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
                        <td><?= $this->Number->format($sleepLog->cycles_count) ?></td>
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
</div>
