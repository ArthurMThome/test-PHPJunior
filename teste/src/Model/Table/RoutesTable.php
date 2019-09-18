<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Routes Model
 *
 * @method \App\Model\Entity\Route get($primaryKey, $options = [])
 * @method \App\Model\Entity\Route newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Route[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Route|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Route saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Route patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Route[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Route findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoutesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('routes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('origin_route')
            ->maxLength('origin_route', 5)
            ->requirePresence('origin_route', 'create')
            ->notEmptyString('origin_route');

        $validator
            ->scalar('destiny_route')
            ->maxLength('destiny_route', 5)
            ->requirePresence('destiny_route', 'create')
            ->notEmptyString('destiny_route');

        $validator
            ->integer('altonomy_route')
            ->requirePresence('altonomy_route', 'create')
            ->notEmptyString('altonomy_route');

        return $validator;
    }
}
