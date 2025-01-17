<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * SleepLogs Controller
 *
 * @property \App\Model\Table\SleepLogsTable $SleepLogs
 */
class SleepLogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = $this->Authentication->getIdentity();

        // Vérifier si un utilisateur est authentifié
        if (!$user) {
            $this->Flash->error(__('Vous devez être connecté pour accéder à cette page.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        // Créer une requête pour filtrer les logs de l'utilisateur
        $query = $this->SleepLogs->find()
            ->where(['SleepLogs.user_id' => $user->get('id')]) // Filtrer par user_id
            ->contain(['Users']); // Inclure les relations nécessaires

        // Paginer les résultats
        $sleepLogs = $this->paginate($query, [
            'limit' => 10,
            'order' => ['SleepLogs.date' => 'desc'], // Trier par date (descendant)
        ]);

        // Envoyer les données à la vue
        $this->set(compact('sleepLogs'));
    }



    /**
     * View method
     *
     * @param string|null $id Sleep Log id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sleepLog = $this->SleepLogs->get($id, contain: ['Users']);
        $this->set(compact('sleepLog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sleepLog = $this->SleepLogs->newEmptyEntity();
        if ($this->request->is('post')) {
            // Récupérer l'utilisateur actuellement connecté
            $user = $this->Authentication->getIdentity();

            // Vérifier si l'utilisateur est authentifié
            if ($user) {
                // Assigner l'ID de l'utilisateur à l'entité SleepLog
                $sleepLog->user_id = $user->get('id');
            } else {
                // Si l'utilisateur n'est pas connecté, rediriger
                $this->Flash->error(__('Vous devez être connecté pour ajouter un journal de sommeil.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }

            // Récupérer les données du formulaire et les associer à l'entité
            $sleepLog = $this->SleepLogs->patchEntity($sleepLog, $this->request->getData());

            // Calcul des cycles
            $analysis = $this->SleepLogs->calculateSleepCycles($sleepLog->bedtime, $sleepLog->wake_time);
            $sleepLog->cycles_count = floor($analysis['cycles']); // Arrondir à l'entier inférieur

            // Sauvegarder l'entité
            if ($this->SleepLogs->save($sleepLog)) {
                $this->Flash->success(__('Le journal de sommeil a été ajouté avec succès.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Impossible d\'ajouter le journal de sommeil. Veuillez réessayer.'));
            }
        }
        $this->set(compact('sleepLog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sleep Log id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sleepLog = $this->SleepLogs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sleepLog = $this->SleepLogs->patchEntity($sleepLog, $this->request->getData());
            if ($this->SleepLogs->save($sleepLog)) {
                $this->Flash->success(__('The sleep log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sleep log could not be saved. Please, try again.'));
        }
        $users = $this->SleepLogs->Users->find('list', limit: 200)->all();
        $this->set(compact('sleepLog', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sleep Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sleepLog = $this->SleepLogs->get($id);
        if ($this->SleepLogs->delete($sleepLog)) {
            $this->Flash->success(__('The sleep log has been deleted.'));
        } else {
            $this->Flash->error(__('The sleep log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function weekData()
    {

        // Récupérer l'utilisateur connecté
        $user = $this->Authentication->getIdentity();

        // Vérifier si l'utilisateur est authentifié
        if (!$user) {
            $this->Flash->error(__('Vous devez être connecté pour accéder à vos données de la semaine.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        // Récupérer les paramètres 'start' et 'end' depuis la requête GET
        $start = $this->request->getQuery('start');
        $end = $this->request->getQuery('end');

        // Si les paramètres ne sont pas définis, utiliser la semaine actuelle par défaut
        if (!$start || !$end) {
            $currentDate = new \DateTime();
            $currentWeekStart = $currentDate->modify('monday this week')->format('Y-m-d');
            $currentWeekEnd = $currentDate->modify('sunday this week')->format('Y-m-d');
        } else {
            // Utiliser les dates passées dans la requête
            $currentWeekStart = $start;
            $currentWeekEnd = $end;
        }

        // Calcul de la semaine précédente et suivante
        $previousWeekStart = date('Y-m-d', strtotime($currentWeekStart . ' - 7 days'));
        $previousWeekEnd = date('Y-m-d', strtotime($currentWeekEnd . ' - 7 days'));
        $nextWeekStart = date('Y-m-d', strtotime($currentWeekStart . ' + 7 days'));
        $nextWeekEnd = date('Y-m-d', strtotime($currentWeekEnd . ' + 7 days'));

        // Récupérer les logs de sommeil pour la semaine en cours
        $sleepLogs = $this->paginate(
            $this->SleepLogs->find()
                ->where(['user_id' => $user->get('id')])
                ->where(['date >=' => $currentWeekStart, 'date <=' => $currentWeekEnd])
                ->order(['date' => 'ASC'])
        );

        // Créer un tableau pour les jours de la semaine avec les données par jour
        $sleepDataByDays = [
            "Lundi" => ["cycles_count" => 0, "morning_form_score" => 0],
            "Mardi" => ["cycles_count" => 0, "morning_form_score" => 0],
            "Mercredi" => ["cycles_count" => 0, "morning_form_score" => 0],
            "Jeudi" => ["cycles_count" => 0, "morning_form_score" => 0],
            "Vendredi" => ["cycles_count" => 0, "morning_form_score" => 0],
            "Samedi" => ["cycles_count" => 0, "morning_form_score" => 0],
            "Dimanche" => ["cycles_count" => 0, "morning_form_score" => 0]
        ];

        // Remplir le tableau avec les données
        foreach ($sleepLogs as $log) {
            // Récupérer le jour de la semaine 
            $dayOfWeek = $log->date->format('l');

            // Mapper les jours de la semaine en français
            $daysInFrench = [
                'Monday' => 'Lundi',
                'Tuesday' => 'Mardi',
                'Wednesday' => 'Mercredi',
                'Thursday' => 'Jeudi',
                'Friday' => 'Vendredi',
                'Saturday' => 'Samedi',
                'Sunday' => 'Dimanche'
            ];

            // Vérifier si le jour existe dans le tableau
            if (isset($daysInFrench[$dayOfWeek])) {
                // Ajouter le nombre de cycles
                $sleepDataByDays[$daysInFrench[$dayOfWeek]]['cycles_count'] += $log->cycles_count;

                // Ajouter le score de forme matinale
                $sleepDataByDays[$daysInFrench[$dayOfWeek]]['morning_form_score'] += $log->morning_form_score;
            }
        }

        // Calcul des totaux des cycles pour la semaine en cours
        $totalCycles = $this->SleepLogs->find()
            ->where(['user_id' => $user->get('id')])
            ->where(['date >=' => $currentWeekStart, 'date <=' => $currentWeekEnd])
            ->select(['total_cycles' => $this->SleepLogs->find()->func()->sum('cycles_count')])
            ->first();

        $totalCycles = $totalCycles ? $totalCycles->total_cycles : 0;

        // Récupérer les cycles par jour pour la semaine en cours
        $sleepLogsByDate = $this->SleepLogs->find()
            ->select(['date', 'cycles_count'])
            ->where(['user_id' => $user->get('id')])
            ->where(['date >=' => $currentWeekStart, 'date <=' => $currentWeekEnd])
            ->order(['date' => 'ASC'])
            ->all();

        // Calcul du nombre de jours consécutifs où le nombre de cycles est >= 5
        $maxConsecutiveDays = 0;
        $currentConsecutiveDays = 0;

        foreach ($sleepLogsByDate as $log) {
            if ($log->cycles_count >= 5) {
                $currentConsecutiveDays++;
                $maxConsecutiveDays = max($maxConsecutiveDays, $currentConsecutiveDays);
            } else {
                $currentConsecutiveDays = 0;
            }
        }

        // Passer les données à la vue
        $this->set(compact('sleepLogs', 'totalCycles', 'maxConsecutiveDays', 'currentWeekStart', 'currentWeekEnd', 'previousWeekStart', 'previousWeekEnd', 'nextWeekStart', 'nextWeekEnd', 'sleepDataByDays'));
    }
}
