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
 * @var string $sleepDataByDays
 */
?>

<!-- Ligne de navigation : Données de la semaine + Boutons de navigation -->
<div class="d-flex justify-content-between mb-4" style="border-bottom: 2px solid #ddd; padding-bottom: 15px;">
    <div class="h3" style="font-weight: bold; color: #333;"><?= __('Données de la semaine') ?></div>
    <div class="d-flex">
        <?= $this->Html->link(__('Semaine précédente'), ['action' => 'weekData', '?' => ['start' => $previousWeekStart, 'end' => $previousWeekEnd]], ['class' => 'button']) ?>
        <?= $this->Html->link(__('Semaine suivante'), ['action' => 'weekData', '?' => ['start' => $nextWeekStart, 'end' => $nextWeekEnd]], ['class' => 'button']) ?>
    </div>
</div>

<!-- Semaine de : [dates] -->
<div class="alert alert-info text-center">
    <h4 style="font-weight: bold;">Semaine de : <?= h($currentWeekStart) ?> à <?= h($currentWeekEnd) ?></h4>
</div>

<!-- Tableau des logs des 7 derniers jours -->
<div class="table-responsive mb-4">
    <table>
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('date', 'Date') ?></th>
                <th><?= $this->Paginator->sort('bedtime', 'Heure du coucher') ?></th>
                <th><?= $this->Paginator->sort('wake_time', 'Heure du réveil') ?></th>
                <th><?= $this->Paginator->sort('cycles_count', 'Nombre de cycles') ?></th>
                <th><?= $this->Paginator->sort('morning_form_score', 'Forme matinale') ?></th>
                <th><?= $this->Paginator->sort('sports_activity', 'Activité sportive') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sleepLogs as $sleepLog): ?>
                <tr style="text-align: center;">
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

<!-- Objectifs et accomplissements -->
<div class="mb-4">
    <h3 style="font-weight: bold; color: #2c3e50; text-align: center;">Objectifs de la semaine</h3>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-right: 15px; justify-content: center;">
                <div class="card-body" style="padding: 20px;">
                    <h5 style="color: #2c3e50;">Total des cycles de sommeil</h5>
                    <p class="display-4" style="font-size: 2rem; font-weight: bold; color: #333; text-align: center;"><?= $totalCycles ?></p>
                    <div class="<?= $totalCycles >= 42 ? 'text-success' : 'text-danger' ?>" style="font-weight: bold; font-size: 1.2rem; text-align: center;">
                        <?= $totalCycles >= 42 ? 'Objectif atteint !' : 'Objectif non atteint' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-right: 15px; justify-content: center;">
                <div class="card-body" style="padding: 20px;">
                    <h5 style="color: #2c3e50;">Jours consécutifs avec au moins 5 cycles</h5>
                    <p class="display-4" style="font-size: 2rem; font-weight: bold; color: #333; text-align: center;"><?= $maxConsecutiveDays ?></p>
                    <div class="<?= $maxConsecutiveDays >= 4 ? 'text-success' : 'text-danger' ?>" style="font-weight: bold; font-size: 1.2rem; text-align: center;">
                        <?= $maxConsecutiveDays >= 4 ? 'Objectif atteint !' : 'Objectif non atteint' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section pour les graphiques -->
<div class="mb-4">
    <h3 style="font-weight: bold; color: #2c3e50; text-align: center;">Graphiques de la semaine</h3>
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-right: 30px;">
            <div class="card-body" style="padding: 20px;">
                <h5 style="color: #2c3e50;">Cycles de sommeil par jour</h5>
                <div style="height: 200px; background-color: #f1f1f1; border-radius: 10px;">
                    <canvas id="chart1"></canvas>
                </div>
            </div>
        </div>
        <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-right: 30px;">
            <div class="card-body" style="padding: 20px;">
                <h5 style="color: #2c3e50;">Forme matinale</h5>
                <div style="height: 200px; background-color: #f1f1f1; border-radius: 10px;">
                    <canvas id="chart2"></canvas>
                </div>
            </div>
        </div>
        <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-right: 30px;">
            <div class="card-body" style="padding: 20px;">
                <h5 style="color: #2c3e50;">Cycles cumulés vs objectif</h5>
                <div style="height: 200px; background-color: #f1f1f1; border-radius: 10px;">
                    <canvas id="chart3"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const sleepLogsData = <?php echo json_encode($sleepDataByDays); ?>;
    console.log(sleepLogsData); // Vérifiez la structure des données

    // Préparer les données pour les graphiques
    const daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    const cyclesData = daysOfWeek.map(day => {
        const log = sleepLogsData[day];
        return log ? log.cycles_count : 0;
    });
    const morningScoreData = daysOfWeek.map(day => {
        const log = sleepLogsData[day];
        return log ? log.morning_form_score : 0;
    });

    // Graphique 1 : Cycles de sommeil par jour
    const ctx1 = document.getElementById('chart1').getContext('2d');
    const chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: daysOfWeek,
            datasets: [{
                label: 'Nombre de cycles de sommeil',
                data: cyclesData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique 2 : Score de forme matinale par jour
    const ctx2 = document.getElementById('chart2').getContext('2d');
    const chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: daysOfWeek,
            datasets: [{
                label: 'Forme matinale',
                data: morningScoreData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique 3 : Cycles cumulés vs objectif
    const ctx3 = document.getElementById('chart3').getContext('2d');
    const totalCycles = cyclesData.reduce((a, b) => a + b, 0);
    const chart3 = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Cycles cumulés', 'Objectif restant'],
            datasets: [{
                label: 'Objectif de cycles',
                data: [totalCycles, Math.max(42 - totalCycles, 0)],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>