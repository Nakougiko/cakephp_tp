<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc.
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- CSS par défaut de CakePHP -->
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    
    <!-- Ajout de custom.css pour personnalisation -->
    <?= $this->Html->css('custom') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>TP</span> Lukas</a>
        </div>
        <div class="top-nav-links">
            <?php if ($this->request->getAttribute('identity')): ?>
                <div class="user-info">
                    Bienvenue, <?= h($this->request->getAttribute('identity')->prenom) ?> <?= h($this->request->getAttribute('identity')->nom) ?>
                    <?= $this->Html->link('Déconnexion', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button logout-button']) ?>
                </div>
            <?php else: ?>
                <?= $this->Html->link('Connexion', ['controller' => 'Users', 'action' => 'login'], ['class' => 'button login-button']) ?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer class="main-footer">
        <div class="footer-content">
            <p>&copy; <?= date('Y') ?> GOULOIS Lukas. Tous droits réservés.</p>
            <p>Propulsé avec <a href="https://cakephp.org" target="_blank">CakePHP</a>.</p>
        </div>
    </footer>
</body>
</html>
