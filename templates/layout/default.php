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

<?php
use Cake\Routing\Router;
?>

<?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>


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

    <!-- jQuery -->
    <?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
    <?= $this->Html->script('https://code.jquery.com/ui/1.13.2/jquery-ui.min.js') ?>
    <?= $this->Html->css('https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css') ?>


</head>

<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>TP</span> Lukas</a>
        </div>
        <div class="top-nav-links">
            <?php if ($this->request->getAttribute('identity')): ?>
                <div class="user-info">
                    Bienvenue, <?= h($this->request->getAttribute('identity')->prenom) ?>
                    <?= h($this->request->getAttribute('identity')->nom) ?>
                    <?= $this->Html->link('Déconnexion', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button logout-button']) ?>
                </div>
            <?php else: ?>
                <?= $this->Html->link('Connexion', ['controller' => 'Users', 'action' => 'login'], ['class' => 'button login-button']) ?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container" style="display: flex;">
            <!-- Menu latéral gauche -->
            <?php if ($this->request->getAttribute('identity')): ?>
                <nav id="menu"
                    style="width: 200px; background-color: #f4f4f4; padding: 10px; border-right: 2px solid #ccc;">
                    <ul id="sortableMenu">
                        <?php
                        $menus = \Cake\ORM\TableRegistry::getTableLocator()->get('Menus')->find('all')->order(['ordre' => 'ASC']);
                        foreach ($menus as $menu): ?>
                            <li class="menu-item" data-id="<?= $menu->id ?>">
                                <a href="<?= Router::url($menu->lien, false) ?>"><?= h($menu->intitule) ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>

            <!-- Contenu principal -->
            <div id="content" style="flex: 1; padding: 20px;">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>&copy; <?= date('Y') ?> <a href="https://github.com/Nakougiko">GOULOIS Lukas</a>. Tous droits réservés.
            </p>
            <p>Propulsé avec <a href="https://cakephp.org" target="_blank">CakePHP</a>.</p>
        </div>
    </footer>

    <script>
        $(document).ready(function () {
            // Vérification si l'élément existe avant d'appliquer sortable
            if ($('#sortableMenu').length) {
                $('#sortableMenu').sortable({
                    update: function (event, ui) {
                        // Récupérer l'ordre des menus après réorganisation
                        const sortedIds = $('#sortableMenu').sortable('toArray', { attribute: 'data-id' });

                        // Envoyer l'ordre des menus via AJAX
                        $.ajax({
                            url: '<?= $this->Url->build('/menus/reorder'); ?>', // Utilisation de Router pour générer l'URL
                            method: 'POST',
                            data: { order: sortedIds },
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') // Protection CSRF
                            },
                            success: function (response) {
                                location.reload();
                            },
                            error: function () {
                                alert('Une erreur est survenue. Veuillez réessayer.');
                            }
                        });
                    }
                });
            }
        });

    </script>
</body>

</html>