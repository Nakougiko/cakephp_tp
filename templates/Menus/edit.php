<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<div class="row">
    <div class="column column-100">
        <div class="menus form content">
            <?= $this->Form->create($menu) ?>
            <fieldset>
                <legend><?= __('Modifier le menu') ?></legend>
                <?php
                    echo $this->Form->control('ordre', ['label' => 'Ordre']);
                    echo $this->Form->control('intitule', ['label' => 'Intitulé']);
                    echo $this->Form->control('lien', ['label' => 'Lien']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Valider')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
