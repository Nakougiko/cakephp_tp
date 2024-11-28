<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Mot de passe oublié</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Entrez votre email pour réinitialiser votre mot de passe') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Envoyer')); ?>
    <?= $this->Form->end() ?>
</div>
