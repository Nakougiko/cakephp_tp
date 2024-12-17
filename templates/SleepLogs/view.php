<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SleepLog $sleepLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Modifier le journal de sommeil'), ['action' => 'edit', $sleepLog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer le journal de sommeil'), ['action' => 'delete', $sleepLog->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer le journal # {0} ?', $sleepLog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Liste des journaux de sommeil'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nouveau journal de sommeil'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="sleepLogs view content">
            <h3><?= h($sleepLog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Utilisateur') ?></th>
                    <td><?= $sleepLog->hasValue('user') ? $this->Html->link($sleepLog->user->nom, ['controller' => 'Users', 'action' => 'view', $sleepLog->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('ID') ?></th>
                    <td><?= $this->Number->format($sleepLog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre de cycles') ?></th>
                    <td><?= $this->Number->format($sleepLog->cycles_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Score de forme matinale') ?></th>
                    <td><?= $this->Number->format($sleepLog->morning_form_score) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($sleepLog->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Heure du coucher') ?></th>
                    <td><?= h($sleepLog->bedtime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Heure du réveil') ?></th>
                    <td><?= h($sleepLog->wake_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sieste l’après-midi') ?></th>
                    <td><?= $sleepLog->nap_afternoon ? __('Oui') : __('Non'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Sieste le soir') ?></th>
                    <td><?= $sleepLog->nap_evening ? __('Oui') : __('Non'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Activité sportive') ?></th>
                    <td><?= $sleepLog->sports_activity ? __('Oui') : __('Non'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Commentaire') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($sleepLog->comment)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
