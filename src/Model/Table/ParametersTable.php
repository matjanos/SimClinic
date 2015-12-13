<?php
namespace App\Model\Table;

use App\Model\Entity\Parameter;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parameters Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Analyzes
 */
class ParametersTable extends Table
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

        $this->table('parameters');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('Analyzes', [
            'foreignKey' => 'parameter_id',
            'targetForeignKey' => 'analyze_id',
            'joinTable' => 'analyzes_parameters'
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
            ->add('name', 'valid', ['rule' => 'numeric'])
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('measureUnit', 'valid', ['rule' => 'numeric'])
            ->requirePresence('measureUnit', 'create')
            ->notEmpty('measureUnit');

        return $validator;
    }
}
