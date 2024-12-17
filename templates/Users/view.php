<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Modifier l\'utilisateur'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer l\'utilisateur'), ['action' => 'delete', $user->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer l\'utilisateur # {0} ?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Liste des utilisateurs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nouvel utilisateur'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->nom) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($user->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prénom') ?></th>
                    <td><?= h($user->prenom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Identifiant') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Actif') ?></th>
                    <td><?= $user->actif ? __('Oui') : __('Non') ?></td>
                </tr>
                <tr>
                    <th><?= __('Créé le') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifié le') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Observation') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->observation)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
