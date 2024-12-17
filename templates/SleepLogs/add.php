<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SleepLog $sleepLog
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <div class="column column-100">
        <div class="sleepLogs form content">
            <?= $this->Form->create($sleepLog) ?>
            <fieldset>
                <legend><?= __('Ajouter un journal de sommeil') ?></legend>
                <?php
                    echo $this->Form->control('date', ['label' => 'Date']);
                    echo $this->Form->control('bedtime', ['label' => 'Heure du coucher']);
                    echo $this->Form->control('wake_time', ['label' => 'Heure du réveil']);
                    echo $this->Form->control('nap_afternoon', ['label' => 'Sieste de l\'après-midi']);
                    echo $this->Form->control('nap_evening', ['label' => 'Sieste du soir']);
                    echo $this->Form->control('morning_form_score', ['label' => 'Forme matinale (score)']);
                    echo $this->Form->control('comment', ['label' => 'Commentaire']);
                    echo $this->Form->control('sports_activity', ['label' => 'Activité sportive']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Envoyer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
