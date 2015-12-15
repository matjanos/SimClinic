<?php
namespace App\Model\Table;

use App\Model\Entity\Analyze;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Analyzes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Examinations
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsToMany $Parameters
 */
class AnalyzesTable extends Table
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

        $this->table('analyzes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Examinations', [
            'foreignKey' => 'examination_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Doctors', [
            'propertyName' => 'doctor',
            'foreignKey' => 'doctor_id',
            'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->hasMany('AnalyzesParameters', [
            'foreignKey' => 'analysis_id'
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
            ->add('date', 'valid', ['rule' => 'date'])
            ->requirePresence('date', 'create')
            ->notEmpty('date');

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
        $rules->add($rules->existsIn(['examination_id'], 'Examinations'));
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));
        return $rules;
    }
}
