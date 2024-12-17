<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column column-100">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Ajouter un utilisateur') ?></legend>
                <?php
                    echo $this->Form->control('actif', ['label' => 'Actif']);
                    echo $this->Form->control('nom', ['label' => 'Nom']);
                    echo $this->Form->control('prenom', ['label' => 'Prénom']);
                    echo $this->Form->control('email', ['label' => 'Email']);
                    echo $this->Form->control('password', ['label' => 'Mot de passe']);
                    echo $this->Form->control('observation', ['label' => 'Observation']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Soumettre')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
