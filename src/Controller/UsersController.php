<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configurez l'action de connexion pour ne pas exiger d'authentification,
        // évitant ainsi le problème de la boucle de redirection infinie
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // indépendamment de POST ou GET, rediriger si l'utilisateur est connecté
        if ($result && $result->isValid()) {
            // rediriger vers /users après la connexion réussie
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // afficher une erreur si l'utilisateur a soumis un formulaire
        // et que l'authentification a échoué
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Votre identifiant ou votre mot de passe est incorrect.'));
        }
    }

    public function forgotPassword()
    {
        // Si l'utilisateur est déjà connecté, redirige-le vers la page d'accueil
        if ($this->Authentication->getIdentity()) {
            return $this->redirect(['action' => 'index']);
        }

        // Si le formulaire est soumis
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $user = $this->Users->findByEmail($email)->first();

            // Si l'utilisateur n'existe pas
            if (!$user) {
                $this->Flash->error(__('Aucun utilisateur trouvé avec cet email.'));
                return;
            }

            // Générer un nouveau mot de passe
            $newPassword = bin2hex(random_bytes(8)); // Générer un mot de passe aléatoire de 8 caractères
            // $newPassword = '12345678'; // Mot de passe temporaire pour les tests
            // Mettre à jour le mot de passe de l'utilisateur
            $user->password = $newPassword;
            if ($this->Users->save($user)) {
                // Envoi de l'email avec le nouveau mot de passe
                if ($this->_sendResetPasswordEmail($user->email, $newPassword)) {
                    $this->Flash->success(__('Un nouveau mot de passe a été envoyé à votre adresse email.'));
                } else {
                    $this->Flash->error(__('Une erreur est survenue lors de l\'envoi du nouveau mot de passe.'));
                }
            } else {
                $this->Flash->error(__('Le mot de passe n\'a pas pu être réinitialisé.'));
            }
        }
    }

    private function _sendResetPasswordEmail($email, $newPassword)
    {
        try {
            $mailer = new Mailer('default');
            $mailer->setFrom(['noreply@gouloislukas.com' => 'GOULOIS Lukas TP'])
                   ->setTo($email)
                   ->setSubject('Réinitialisation de votre mot de passe')
                   ->deliver('Votre nouveau mot de passe est : ' . $newPassword);
    
            return true;  // Si l'email a été envoyé avec succès
        } catch (\Exception $e) {
            // Si une erreur se produit lors de l'envoi de l'email
            $this->log('Erreur lors de l\'envoi du mail : ' . $e->getMessage(), 'error');
            return false;
        }
    }
}
