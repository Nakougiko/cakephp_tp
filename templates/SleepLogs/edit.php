<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SleepLog $sleepLog
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <div class="column column-100">
        <div class="sleepLogs form content">
            <?= $this->Form->create($sleepLog) ?>
            <fieldset>
                <legend><?= __('Modifier le journal de sommeil') ?></legend>
                <?php
                    echo $this->Form->control('date', ['label' => 'Date']);
                    echo $this->Form->control('bedtime', ['label' => 'Heure du coucher', 'type' => 'time', 'id' => 'bedtime']);
                    echo $this->Form->control('wake_time', ['label' => 'Heure du réveil', 'type' => 'time', 'id' => 'wake_time']);

                    // Calcul du nombre de cycles côté PHP
                    $cycles = '';
                    if (!empty($sleepLog->bedtime) && !empty($sleepLog->wake_time)) {
                        // Conversion des heures en timestamps Unix
                        $bedtimeTimestamp = strtotime($sleepLog->bedtime);
                        $wakeTimeTimestamp = strtotime($sleepLog->wake_time);

                        // Durée de sommeil en minutes
                        $sleepDurationMinutes = ($wakeTimeTimestamp - $bedtimeTimestamp) / 60;

                        // Calcul du nombre de cycles (90 minutes par cycle)
                        $cycleDuration = 90; // Durée d'un cycle en minutes
                        $cycles = round($sleepDurationMinutes / $cycleDuration); // Arrondi au nombre entier le plus proche
                    }

                    // Affichage du champ readonly avec la valeur calculée ou vide
                    echo $this->Form->control('cycles_count', [
                        'label' => 'Nombre de cycles',
                        'readonly' => true,
                        'value' => $cycles,
                        'id' => 'cycles_count' // Ajoutez un ID pour ce champ
                    ]);

                    echo $this->Form->control('nap_afternoon', ['label' => 'Sieste de l\'après-midi']);
                    echo $this->Form->control('nap_evening', ['label' => 'Sieste du soir']);
                    echo $this->Form->control('morning_form_score', ['label' => 'Score de forme matinale']);
                    echo $this->Form->control('comment', ['label' => 'Commentaire']);
                    echo $this->Form->control('sports_activity', ['label' => 'Activité sportive']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Valider')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Ajout de JavaScript pour le recalcul dynamique des cycles -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour recalculer les cycles de sommeil
        function calculateCycles() {
            var bedtime = document.getElementById('bedtime').value;
            var wakeTime = document.getElementById('wake_time').value;

            if (bedtime && wakeTime) {
                var bedtimeDate = new Date('1970-01-01T' + bedtime + 'Z');
                var wakeTimeDate = new Date('1970-01-01T' + wakeTime + 'Z');

                // Durée de sommeil en minutes
                var sleepDurationMinutes = (wakeTimeDate - bedtimeDate) / (1000 * 60); // Convertir en minutes

                // Durée d'un cycle de sommeil en minutes (90 minutes)
                var cycleDuration = 90;

                // Calcul du nombre de cycles
                var cycles = Math.round(sleepDurationMinutes / cycleDuration);

                // Mettre à jour le champ readonly 'cycles_count'
                document.getElementById('cycles_count').value = cycles;
            }
        }

        // Fonction pour écouter les événements sur les champs bedtime et wake_time
        var bedtimeField = document.getElementById('bedtime');
        var wakeTimeField = document.getElementById('wake_time');

        // Utilisez l'événement 'input' pour détecter les changements immédiatement
        if (bedtimeField && wakeTimeField) {
            bedtimeField.addEventListener('input', calculateCycles);
            wakeTimeField.addEventListener('input', calculateCycles);
        }

        // Initialiser au cas où les valeurs sont déjà présentes au chargement
        calculateCycles();
    });
</script>
