<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Modifier le menu'), ['action' => 'edit', $menu->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer le menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer le menu # {0} ?', $menu->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Liste des menus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nouveau menu'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menus view content">
            <h3><?= h($menu->intitule) ?></h3>
            <table>
                <tr>
                    <th><?= __('Intitulé') ?></th>
                    <td><?= h($menu->intitule) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lien') ?></th>
                    <td><?= h($menu->lien) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID') ?></th>
                    <td><?= $this->Number->format($menu->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ordre') ?></th>
                    <td><?= $this->Number->format($menu->ordre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Créé le') ?></th>
                    <td><?= h($menu->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifié le') ?></th>
                    <td><?= h($menu->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
