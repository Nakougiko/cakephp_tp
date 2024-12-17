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
                    echo $this->Form->control('user_id', ['options' => $users, 'label' => 'Utilisateur']);
                    echo $this->Form->control('date', ['label' => 'Date']);
                    echo $this->Form->control('bedtime', ['label' => 'Heure du coucher']);
                    echo $this->Form->control('wake_time', ['label' => 'Heure du réveil']);

                    // Calcul du compteur de cycles
                    if (!empty($sleepLog->bedtime) && !empty($sleepLog->wake_time)) {
                        // Conversion des heures en timestamp Unix
                        $bedtimeTimestamp = strtotime($sleepLog->bedtime);
                        $wakeTimeTimestamp = strtotime($sleepLog->wake_time);

                        // Durée de sommeil en minutes
                        $sleepDurationMinutes = ($wakeTimeTimestamp - $bedtimeTimestamp) / 60;

                        // Calcul du nombre de cycles (90 minutes par cycle)
                        $cycleDuration = 90; // Durée d'un cycle
                        $cycles = round($sleepDurationMinutes / $cycleDuration); // Arrondi au nombre entier le plus proche

                        echo $this->Form->control('cycles_count', [
                            'label' => 'Nombre de cycles',
                            'value' => $cycles,
                            'readonly' => true
                        ]);
                    } else {
                        // Si les heures sont vides, afficher un champ normal pour cycles_count
                        echo $this->Form->control('cycles_count', ['label' => 'Nombre de cycles']);
                    }

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
