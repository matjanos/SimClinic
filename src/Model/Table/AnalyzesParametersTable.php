<?php
namespace App\Model\Table;

use App\Model\Entity\AnalyzesParameter;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnalyzesParameters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Analyzes
 * @property \Cake\ORM\Association\BelongsTo $Parameters
 */
class AnalyzesParametersTable extends Table
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

        $this->table('analyzes_parameters');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Analyzes', [
            'foreignKey' => 'analysis_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Parameters', [
            'foreignKey' => 'parameter_id',
            'joinType' => 'INNER'
        ]);
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('value', 'valid', ['rule' => 'numeric'])
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['analysis_id'], 'Analyzes'));
        $rules->add($rules->existsIn(['parameter_id'], 'Parameters'));
        return $rules;
    }
}
