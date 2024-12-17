<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Menu> $menus
 */
?>
<div class="menus index content">
    <?= $this->Html->link(__('Nouveau menu'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menus') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('ordre', 'Ordre') ?></th>
                    <th><?= $this->Paginator->sort('intitule', 'Intitulé') ?></th>
                    <th><?= $this->Paginator->sort('lien', 'Lien') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Créé le') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Modifié le') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu): ?>
                <tr>
                    <td><?= $this->Number->format($menu->id) ?></td>
                    <td><?= $this->Number->format($menu->ordre) ?></td>
                    <td><?= h($menu->intitule) ?></td>
                    <td><?= h($menu->lien) ?></td>
                    <td><?= h($menu->created) ?></td>
                    <td><?= h($menu->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $menu->id]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $menu->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $menu->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer le menu # {0} ?', $menu->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('première')) ?>
            <?= $this->Paginator->prev('< ' . __('précédente')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivante') . ' >') ?>
            <?= $this->Paginator->last(__('dernière') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, affichant {{current}} enregistrement(s) sur un total de {{count}}')) ?></p>
    </div>
</div>
