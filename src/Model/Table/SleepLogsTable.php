<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SleepLogs Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\SleepLog newEmptyEntity()
 * @method \App\Model\Entity\SleepLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\SleepLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SleepLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\SleepLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\SleepLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\SleepLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SleepLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\SleepLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\SleepLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SleepLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SleepLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SleepLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SleepLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SleepLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SleepLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SleepLog> deleteManyOrFail(iterable $entities, array $options = [])
 */
class SleepLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('sleep_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->time('bedtime')
            ->requirePresence('bedtime', 'create')
            ->notEmptyTime('bedtime');

        $validator
            ->time('wake_time')
            ->requirePresence('wake_time', 'create')
            ->notEmptyTime('wake_time');

        $validator
            ->integer('cycles_count')
            ->requirePresence('cycles_count', 'create')
            ->notEmptyString('cycles_count');

        $validator
            ->boolean('nap_afternoon')
            ->requirePresence('nap_afternoon', 'create')
            ->notEmptyString('nap_afternoon');

        $validator
            ->boolean('nap_evening')
            ->requirePresence('nap_evening', 'create')
            ->notEmptyString('nap_evening');

        $validator
            ->integer('morning_form_score')
            ->requirePresence('morning_form_score', 'create')
            ->notEmptyString('morning_form_score');

        $validator
            ->scalar('comment')
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment');

        $validator
            ->boolean('sports_activity')
            ->requirePresence('sports_activity', 'create')
            ->notEmptyString('sports_activity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    public function calculateSleepCycles($bedtime, $wakeTime)
    {
        // Convertir les objets Time en chaînes de caractères au format accepté par DateTime
        $bedtime = $bedtime instanceof \Cake\I18n\Time ? $bedtime->format('Y-m-d H:i:s') : $bedtime;
        $wakeTime = $wakeTime instanceof \Cake\I18n\Time ? $wakeTime->format('Y-m-d H:i:s') : $wakeTime;

        // Créer des objets DateTime à partir des chaînes de caractères
        $bedtime = new \DateTime($bedtime);
        $wakeTime = new \DateTime($wakeTime);

        $duration = $bedtime->diff($wakeTime); // Calcul de la durée de sommeil
        $totalMinutes = ($duration->h * 60) + $duration->i;

        // Un cycle = 90 minutes
        $cycles = $totalMinutes / 90;

        // Vérification si proche d'un entier (10 minutes de marge)
        $isCloseToWholeCycle = abs($cycles - round($cycles)) <= (10 / 90);

        return [
            'cycles' => $cycles,
            'isCloseToWholeCycle' => $isCloseToWholeCycle,
            'isMinFiveCycles' => $cycles >= 5,
        ];
    }

}
