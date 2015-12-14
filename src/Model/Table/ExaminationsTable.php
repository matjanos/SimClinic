<?php
namespace App\Model\Table;

use App\Model\Entity\Examination;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Examinations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Analyzes
 */
class ExaminationsTable extends Table
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

        $this->table('examinations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Technicans', [
            'propertyName' => 'technican',
            'foreignKey' => 'technican_id',
            'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('Patients', [
            'propertyName' => 'patient',
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->hasMany('Analyzes', [
            'foreignKey' => 'examination_id'
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

        $validator
            ->add('eye_side', 'valid', ['rule' => 'numeric'])
            ->requirePresence('eye_side', 'create')
            ->notEmpty('eye_side');

        $validator
            ->add('technican_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('technican_id', 'create')
            ->notEmpty('technican_id');

        $validator
            ->add('patient_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('patient_id', 'create')
            ->notEmpty('patient_id');

        $validator
            ->requirePresence('image_path', 'create')
            ->notEmpty('image_path');

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
        $rules->add($rules->existsIn(['technican_id'], 'Users'));
        $rules->add($rules->existsIn(['patient_id'], 'Users'));
        return $rules;
    }
}
