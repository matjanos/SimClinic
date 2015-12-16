<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Analyzes Controller
 *
 * @property \App\Model\Table\AnalyzesTable $Analyzes
 */
class AnalyzesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    // Allow users to register and logout.
    // You should not add the "login" action to allow list. Doing so would
    // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['analyzeSupport']);
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {        
        $conditions = [];
        if($this->isPatient() && !$this->isAdmin()){
            $conditions = ['patient_id'=>$this->Auth->user('id')];
        }
        $this->paginate = [
            'contain' => ['Examinations', 'Doctors', 'Doctors.PersonalData'],
            'conditions' => $conditions
        ];
        $this->set('analyzes', $this->paginate($this->Analyzes));
        $this->set('_serialize', ['analyzes']);
    }

    /**
     * View method
     *
     * @param string|null $id Analyze id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $conditions = [];

        $analyze = $this->Analyzes->get($id, [
            'contain' => ['Examinations', 'Doctors','AnalyzesParameters.Parameters','Doctors.PersonalData'],
            'conditions' => $conditions
        ]);
        $this->set('analyze', $analyze);
        $this->set('_serialize', ['analyze']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if(!$this->isDoctor()){
            $this->Flash->error(__('Insufficient priviledges'));
            return $this->redirect(['action' => 'index']);
        }


        $analyze = $this->Analyzes->newEntity();
        $parameters = $this->Analyzes->AnalyzesParameters->Parameters->find('all', ['limit' => 200]);
        $doctors = $this->Analyzes->Doctors->find('list', 
            ['conditions' => ['Doctors.id'=>$this->Auth->user('id')],
            'valueField' =>  'full_name',
            'keyField' => 'id'])->contain(['PersonalData']);
        
        $analyze->examination = $this->Analyzes->Examinations->get($id);
        if ($this->request->is('post')) {
            $analyze = $this->Analyzes->patchEntity($analyze, $this->request->data);
            foreach ($this->request->data['analyzes_parameters'] as $key=>$val) {
                $analyzeParams = $this->Analyzes->AnalyzesParameters->newEntity();
                $analyzeParams = $this->Analyzes->AnalyzesParameters->patchEntity($analyzeParams,['parameter_id'=>$key,'value'=>$val]);
                array_push($analyze->analyzes_parameters, $analyzeParams);
            }

            if ($this->Analyzes->save($analyze)) {
                $this->Flash->success(__('The analyze has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The analyze could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('analyze', 'doctors' ,'parameters'));
        $this->set('_serialize', ['analyze']);
    }

    private function processAttributes($params){

    }
    /**
     * Edit method
     *
     * @param string|null $id Analyze id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if(!$this->isDoctor()){
            $this->Flash->error(__('Insufficient priviledges'));
            return $this->redirect(['action' => 'index']);
        }
        $analyze = $this->Analyzes->get($id, [
            'contain' => ['Parameters']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $analyze = $this->Analyzes->patchEntity($analyze, $this->request->data);
            if ($this->Analyzes->save($analyze)) {
                $this->Flash->success(__('The analyze has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The analyze could not be saved. Please, try again.'));
            }
        }
        $examinations = $this->Analyzes->Examinations->find('list', ['limit' => 200]);
        $users = $this->Analyzes->Users->find('list', ['limit' => 200]);
        $parameters = $this->Analyzes->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('analyze', 'examinations', 'users', 'parameters'));
        $this->set('_serialize', ['analyze']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Analyze id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if(!$this->isDoctor()){
            $this->Flash->error(__('Insufficient priviledges'));
            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $analyze = $this->Analyzes->get($id);
        if ($this->Analyzes->delete($analyze)) {
            $this->Flash->success(__('The analyze has been deleted.'));
        } else {
            $this->Flash->error(__('The analyze could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function analyzeSupport(){
        ///kod gedający odpowiedź.
       $parameters = $this->request->data;
        $drusen =   intval($parameters['a1']);
        $vein_dia = intval($parameters['a5']);
        $artery_d = intval($parameters['a4']);
        $av_chang = intval($parameters['a6']);
        $artery_c = intval($parameters['a2']);
        $vein_col = intval($parameters['a3']);
        $cottonwo = intval($parameters['a7']);

           /*Terminal Node 1*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d <= 2.5 &&
            $av_chang <= 0.5 &&
            $artery_c <= 2 
        )
        {
            $terminalNode = -1;
            $result = 11;
        }

        /*Terminal Node 2*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d <= 2.5 &&
            $av_chang <= 0.5 &&
            $artery_c > 2 
        )
        {
            $terminalNode = -2;
            $result = 4;
        }

        /*Terminal Node 3*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d <= 1 &&
            $vein_col <= 0.5 
        )
        {
            $terminalNode = -3;
            $result = 8;
        }

        /*Terminal Node 4*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d <= 1 &&
            $vein_col > 0.5 &&
            $artery_c <= 0.5 
        )
        {
            $terminalNode = -4;
            $result = 5;
        }

        /*Terminal Node 5*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d <= 1 &&
            $vein_col > 0.5 &&
            $artery_c > 0.5 
        )
        {
            $terminalNode = -5;
            $result = 7;
        }

        /*Terminal Node 6*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 1 &&
            $artery_d <= 2.5 &&
            $artery_c <= 2.5 &&
            $vein_col <= 0.5 
        )
        {
            $terminalNode = -6;
            $result = 6;
        }

        /*Terminal Node 7*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 1 &&
            $artery_d <= 2.5 &&
            $vein_col > 0.5 &&
            $vein_col <= 1.5 &&
            $artery_c <= 0.5 
        )
        {
            $terminalNode = -7;
            $result = 8;
        }

        /*Terminal Node 8*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 1 &&
            $artery_d <= 2.5 &&
            $vein_col > 0.5 &&
            $vein_col <= 1.5 &&
            $artery_c > 0.5 &&
            $artery_c <= 2.5 &&
            $cottonwo <= 1.5 
        )
        {
            $terminalNode = -8;
            $result = 6;
        }

        /*Terminal Node 9*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 1 &&
            $artery_d <= 2.5 &&
            $vein_col > 0.5 &&
            $vein_col <= 1.5 &&
            $artery_c > 0.5 &&
            $artery_c <= 2.5 &&
            $cottonwo > 1.5 
        )
        {
            $terminalNode = -9;
            $result = 7;
        }

        /*Terminal Node 10*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 1 &&
            $artery_d <= 2.5 &&
            $vein_col <= 1.5 &&
            $artery_c > 2.5 
        )
        {
            $terminalNode = -10;
            $result = 6;
        }

        /*Terminal Node 11*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 1 &&
            $artery_d <= 2.5 &&
            $vein_col > 1.5 
        )
        {
            $terminalNode = -11;
            $result = 8;
        }

        /*Terminal Node 12*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col <= 2 &&
            $artery_c <= 2 &&
            $cottonwo <= 2 
        )
        {
            $terminalNode = -12;
            $result = 0;
        }

        /*Terminal Node 13*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col <= 2 &&
            $artery_c <= 2 &&
            $cottonwo > 2 
        )
        {
            $terminalNode = -13;
            $result = 7;
        }

        /*Terminal Node 14*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col <= 2 &&
            $artery_c > 2 
        )
        {
            $terminalNode = -14;
            $result = 1;
        }

        /*Terminal Node 15*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col > 2 
        )
        {
            $terminalNode = -15;
            $result = 8;
        }

        /*Terminal Node 16*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d > 2.5 &&
            $artery_d <= 3.5 &&
            $vein_col <= 1.5 &&
            $artery_c <= 1.5 
        )
        {
            $terminalNode = -16;
            $result = 11;
        }

        /*Terminal Node 17*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d > 2.5 &&
            $artery_d <= 3.5 &&
            $vein_col <= 1.5 &&
            $artery_c > 1.5 &&
            $artery_c <= 3 
        )
        {
            $terminalNode = -17;
            $result = 2;
        }

        /*Terminal Node 18*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 2.5 &&
            $artery_d <= 3.5 &&
            $vein_col <= 1.5 &&
            $artery_c > 3 &&
            $drusen <= 0.5 
        )
        {
            $terminalNode = -18;
            $result = 11;
        }

        /*Terminal Node 19*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 2.5 &&
            $artery_d <= 3.5 &&
            $vein_col <= 1.5 &&
            $artery_c > 3 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 
        )
        {
            $terminalNode = -19;
            $result = 4;
        }

        /*Terminal Node 20*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia <= 3.5 &&
            $artery_d > 2.5 &&
            $artery_d <= 3.5 &&
            $vein_col > 1.5 
        )
        {
            $terminalNode = -20;
            $result = 4;
        }

        /*Terminal Node 21*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 3.5 &&
            $drusen <= 0.5 
        )
        {
            $terminalNode = -21;
            $result = 12;
        }

        /*Terminal Node 22*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $cottonwo <= 1.5 &&
            $vein_col <= 2 &&
            $av_chang <= 0.5 &&
            $artery_c <= 2 
        )
        {
            $terminalNode = -22;
            $result = 12;
        }

        /*Terminal Node 23*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $cottonwo <= 1.5 &&
            $vein_col <= 2 &&
            $av_chang <= 0.5 &&
            $artery_c > 2 
        )
        {
            $terminalNode = -23;
            $result = 13;
        }

        /*Terminal Node 24*/
        if
        (
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $cottonwo <= 1.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 6 &&
            $vein_dia <= 1.5 &&
            $vein_col <= 0.5 
        )
        {
            $terminalNode = -24;
            $result = 8;
        }

        /*Terminal Node 25*/
        if
        (
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $cottonwo <= 1.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 6 &&
            $vein_dia <= 1.5 &&
            $vein_col > 0.5 &&
            $vein_col <= 2 
        )
        {
            $terminalNode = -25;
            $result = 5;
        }

        /*Terminal Node 26*/
        if
        (
            $cottonwo <= 1.5 &&
            $vein_col <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 4.5 
        )
        {
            $terminalNode = -26;
            $result = 10;
        }

        /*Terminal Node 27*/
        if
        (
            $cottonwo <= 1.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $vein_col <= 0.5 
        )
        {
            $terminalNode = -27;
            $result = 0;
        }

        /*Terminal Node 28*/
        if
        (
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $vein_col > 0.5 &&
            $vein_col <= 2 &&
            $cottonwo <= 0.5 
        )
        {
            $terminalNode = -28;
            $result = 0;
        }

        /*Terminal Node 29*/
        if
        (
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $vein_col > 0.5 &&
            $vein_col <= 2 &&
            $cottonwo > 0.5 &&
            $cottonwo <= 1.5 &&
            $artery_c <= 0.5 
        )
        {
            $terminalNode = -29;
            $result = 0;
        }

        /*Terminal Node 30*/
        if
        (
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $vein_col > 0.5 &&
            $vein_col <= 2 &&
            $cottonwo > 0.5 &&
            $cottonwo <= 1.5 &&
            $artery_c > 0.5 &&
            $artery_c <= 2 
        )
        {
            $terminalNode = -30;
            $result = 14;
        }

        /*Terminal Node 31*/
        if
        (
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $vein_col > 0.5 &&
            $vein_col <= 2 &&
            $cottonwo > 0.5 &&
            $cottonwo <= 1.5 &&
            $artery_c > 2 
        )
        {
            $terminalNode = -31;
            $result = 7;
        }

        /*Terminal Node 32*/
        if
        (
            $cottonwo <= 1.5 &&
            $vein_col <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 6 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 1.5 &&
            $drusen <= 2.5 &&
            $artery_c <= 2 
        )
        {
            $terminalNode = -32;
            $result = 13;
        }

        /*Terminal Node 33*/
        if
        (
            $cottonwo <= 1.5 &&
            $vein_col <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 6 &&
            $vein_dia > 1.5 &&
            $vein_dia <= 3.5 &&
            $drusen > 1.5 &&
            $drusen <= 2.5 &&
            $artery_c > 2 
        )
        {
            $terminalNode = -33;
            $result = 0;
        }

        /*Terminal Node 34*/
        if
        (
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $cottonwo <= 1.5 &&
            $vein_col <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 6 
        )
        {
            $terminalNode = -34;
            $result = 10;
        }

        /*Terminal Node 35*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang <= 1.5 &&
            $cottonwo <= 1.5 &&
            $vein_col > 2 &&
            $artery_c <= 2.5 
        )
        {
            $terminalNode = -35;
            $result = 11;
        }

        /*Terminal Node 36*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang <= 1.5 &&
            $cottonwo <= 1.5 &&
            $vein_col > 2 &&
            $artery_c > 2.5 
        )
        {
            $terminalNode = -36;
            $result = 0;
        }

        /*Terminal Node 37*/
        if
        (
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang <= 1.5 &&
            $cottonwo > 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 4.5 
        )
        {
            $terminalNode = -37;
            $result = 1;
        }

        /*Terminal Node 38*/
        if
        (
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 &&
            $cottonwo > 1.5 &&
            $cottonwo <= 2.5 
        )
        {
            $terminalNode = -38;
            $result = 7;
        }

        /*Terminal Node 39*/
        if
        (
            $vein_dia <= 3.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 &&
            $cottonwo > 2.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 
        )
        {
            $terminalNode = -39;
            $result = 10;
        }

        /*Terminal Node 40*/
        if
        (
            $vein_dia <= 3.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 &&
            $cottonwo > 2.5 &&
            $drusen > 1.5 &&
            $drusen <= 2.5 
        )
        {
            $terminalNode = -40;
            $result = 0;
        }

        /*Terminal Node 41*/
        if
        (
            $vein_dia <= 3.5 &&
            $artery_d > 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col <= 0.5 
        )
        {
            $terminalNode = -41;
            $result = 2;
        }

        /*Terminal Node 42*/
        if
        (
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c <= 2 &&
            $artery_d > 3.5 &&
            $artery_d <= 4.5 &&
            $vein_dia <= 2.5 
        )
        {
            $terminalNode = -42;
            $result = 5;
        }

        /*Terminal Node 43*/
        if
        (
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c <= 2 &&
            $artery_d > 3.5 &&
            $artery_d <= 4.5 &&
            $vein_dia > 2.5 &&
            $vein_dia <= 3.5 
        )
        {
            $terminalNode = -43;
            $result = 14;
        }

        /*Terminal Node 44*/
        if
        (
            $vein_dia <= 3.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c <= 2 &&
            $artery_d > 4.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $cottonwo <= 1.5 
        )
        {
            $terminalNode = -44;
            $result = 4;
        }

        /*Terminal Node 45*/
        if
        (
            $vein_dia <= 3.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c <= 2 &&
            $artery_d > 4.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $cottonwo > 1.5 &&
            $cottonwo <= 2.5 
        )
        {
            $terminalNode = -45;
            $result = 5;
        }

        /*Terminal Node 46*/
        if
        (
            $vein_dia <= 3.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c <= 2 &&
            $artery_d > 4.5 &&
            $drusen > 0.5 &&
            $drusen <= 1.5 &&
            $cottonwo > 2.5 
        )
        {
            $terminalNode = -46;
            $result = 4;
        }

        /*Terminal Node 47*/
        if
        (
            $vein_dia <= 3.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c <= 2 &&
            $artery_d > 4.5 &&
            $drusen > 1.5 &&
            $drusen <= 2.5 &&
            $cottonwo <= 2 
        )
        {
            $terminalNode = -47;
            $result = 1;
        }

        /*Terminal Node 48*/
        if
        (
            $vein_dia <= 3.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c <= 2 &&
            $artery_d > 4.5 &&
            $drusen > 1.5 &&
            $drusen <= 2.5 &&
            $cottonwo > 2 
        )
        {
            $terminalNode = -48;
            $result = 10;
        }

        /*Terminal Node 49*/
        if
        (
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c > 2 &&
            $artery_d > 3.5 &&
            $artery_d <= 4.5 
        )
        {
            $terminalNode = -49;
            $result = 9;
        }

        /*Terminal Node 50*/
        if
        (
            $vein_dia <= 3.5 &&
            $drusen > 0.5 &&
            $drusen <= 2.5 &&
            $av_chang > 1.5 &&
            $vein_col > 0.5 &&
            $artery_c > 2 &&
            $artery_d > 4.5 
        )
        {
            $terminalNode = -50;
            $result = 15;
        }

        /*Terminal Node 51*/
        if
        (
            $drusen <= 2.5 &&
            $artery_c <= 3.5 &&
            $cottonwo <= 1.5 &&
            $artery_d <= 3 &&
            $vein_dia > 3.5 &&
            $vein_dia <= 4.5 
        )
        {
            $terminalNode = -51;
            $result = 3;
        }

        /*Terminal Node 52*/
        if
        (
            $drusen <= 2.5 &&
            $artery_c <= 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia > 4.5 &&
            $av_chang <= 1.5 &&
            $artery_d <= 1 
        )
        {
            $terminalNode = -52;
            $result = 7;
        }

        /*Terminal Node 53*/
        if
        (
            $drusen <= 2.5 &&
            $artery_c <= 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia > 4.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 1 &&
            $artery_d <= 3 
        )
        {
            $terminalNode = -53;
            $result = 5;
        }

        /*Terminal Node 54*/
        if
        (
            $drusen <= 2.5 &&
            $artery_c <= 3.5 &&
            $cottonwo <= 1.5 &&
            $artery_d <= 3 &&
            $vein_dia > 4.5 &&
            $av_chang > 1.5 
        )
        {
            $terminalNode = -54;
            $result = 3;
        }

        /*Terminal Node 55*/
        if
        (
            $drusen <= 2.5 &&
            $artery_c <= 3.5 &&
            $cottonwo <= 1.5 &&
            $artery_d > 3 &&
            $artery_d <= 4.5 &&
            $vein_dia > 3.5 &&
            $vein_dia <= 4.5 
        )
        {
            $terminalNode = -55;
            $result = 9;
        }

        /*Terminal Node 56*/
        if
        (
            $drusen <= 2.5 &&
            $artery_c <= 3.5 &&
            $cottonwo <= 1.5 &&
            $artery_d > 3 &&
            $artery_d <= 4.5 &&
            $vein_dia > 4.5 
        )
        {
            $terminalNode = -56;
            $result = 3;
        }

        /*Terminal Node 57*/
        if
        (
            $vein_dia > 3.5 &&
            $artery_d <= 4.5 &&
            $artery_c <= 3.5 &&
            $cottonwo > 1.5 &&
            $drusen <= 1.5 
        )
        {
            $terminalNode = -57;
            $result = 6;
        }

        /*Terminal Node 58*/
        if
        (
            $vein_dia > 3.5 &&
            $artery_d <= 4.5 &&
            $artery_c <= 3.5 &&
            $cottonwo > 1.5 &&
            $drusen > 1.5 &&
            $drusen <= 2.5 
        )
        {
            $terminalNode = -58;
            $result = 4;
        }

        /*Terminal Node 59*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia > 3.5 &&
            $artery_d <= 4.5 &&
            $artery_c > 3.5 &&
            $vein_col <= 1 
        )
        {
            $terminalNode = -59;
            $result = 6;
        }

        /*Terminal Node 60*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia > 3.5 &&
            $artery_d <= 4.5 &&
            $artery_c > 3.5 &&
            $vein_col > 1 
        )
        {
            $terminalNode = -60;
            $result = 12;
        }

        /*Terminal Node 61*/
        if
        (
            $drusen <= 2.5 &&
            $artery_d > 4.5 &&
            $vein_dia > 3.5 &&
            $vein_dia <= 4.5 &&
            $av_chang <= 0.5 
        )
        {
            $terminalNode = -61;
            $result = 4;
        }

        /*Terminal Node 62*/
        if
        (
            $drusen <= 2.5 &&
            $artery_d > 4.5 &&
            $vein_dia > 3.5 &&
            $vein_dia <= 4.5 &&
            $av_chang > 0.5 
        )
        {
            $terminalNode = -62;
            $result = 6;
        }

        /*Terminal Node 63*/
        if
        (
            $drusen <= 2.5 &&
            $artery_d > 4.5 &&
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $cottonwo <= 2.5 &&
            $av_chang <= 0.5 
        )
        {
            $terminalNode = -63;
            $result = 6;
        }

        /*Terminal Node 64*/
        if
        (
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $cottonwo <= 1.5 &&
            $drusen <= 1.5 &&
            $vein_col <= 2 
        )
        {
            $terminalNode = -64;
            $result = 8;
        }

        /*Terminal Node 65*/
        if
        (
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $cottonwo <= 1.5 &&
            $drusen <= 1.5 &&
            $vein_col > 2 
        )
        {
            $terminalNode = -65;
            $result = 0;
        }

        /*Terminal Node 66*/
        if
        (
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $cottonwo <= 1.5 &&
            $drusen > 1.5 &&
            $drusen <= 2.5 
        )
        {
            $terminalNode = -66;
            $result = 5;
        }

        /*Terminal Node 67*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 &&
            $cottonwo > 1.5 &&
            $cottonwo <= 2.5 
        )
        {
            $terminalNode = -67;
            $result = 7;
        }

        /*Terminal Node 68*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $cottonwo <= 2.5 &&
            $av_chang > 0.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 6 
        )
        {
            $terminalNode = -68;
            $result = 0;
        }

        /*Terminal Node 69*/
        if
        (
            $drusen <= 2.5 &&
            $artery_d > 4.5 &&
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $av_chang > 1.5 &&
            $cottonwo <= 1.5 
        )
        {
            $terminalNode = -69;
            $result = 1;
        }

        /*Terminal Node 70*/
        if
        (
            $drusen <= 2.5 &&
            $artery_d > 4.5 &&
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $av_chang > 1.5 &&
            $cottonwo > 1.5 &&
            $cottonwo <= 2.5 
        )
        {
            $terminalNode = -70;
            $result = 8;
        }

        /*Terminal Node 71*/
        if
        (
            $drusen <= 2.5 &&
            $artery_d > 4.5 &&
            $vein_dia > 4.5 &&
            $artery_c <= 2 &&
            $cottonwo > 2.5 
        )
        {
            $terminalNode = -71;
            $result = 5;
        }

        /*Terminal Node 72*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia > 4.5 &&
            $artery_c > 2 &&
            $artery_d > 4.5 &&
            $artery_d <= 6 
        )
        {
            $terminalNode = -72;
            $result = 2;
        }

        /*Terminal Node 73*/
        if
        (
            $drusen <= 2.5 &&
            $vein_dia > 4.5 &&
            $artery_c > 2 &&
            $artery_d > 6 
        )
        {
            $terminalNode = -73;
            $result = 5;
        }

        /*Terminal Node 74*/
        if
        (
            $artery_d <= 3.5 &&
            $artery_c <= 2.5 &&
            $drusen > 2.5 &&
            $drusen <= 4 
        )
        {
            $terminalNode = -74;
            $result = 6;
        }

        /*Terminal Node 75*/
        if
        (
            $artery_d <= 3.5 &&
            $artery_c <= 2.5 &&
            $drusen > 4 
        )
        {
            $terminalNode = -75;
            $result = 10;
        }

        /*Terminal Node 76*/
        if
        (
            $drusen > 2.5 &&
            $artery_d <= 3.5 &&
            $artery_c > 2.5 
        )
        {
            $terminalNode = -76;
            $result = 4;
        }

        /*Terminal Node 77*/
        if
        (
            $artery_d > 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia <= 4 &&
            $drusen > 2.5 &&
            $drusen <= 3.5 &&
            $av_chang <= 1.5 
        )
        {
            $terminalNode = -77;
            $result = 15;
        }

        /*Terminal Node 78*/
        if
        (
            $artery_d > 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia <= 4 &&
            $drusen > 2.5 &&
            $drusen <= 3.5 &&
            $av_chang > 1.5 
        )
        {
            $terminalNode = -78;
            $result = 13;
        }

        /*Terminal Node 79*/
        if
        (
            $artery_d > 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia <= 4 &&
            $drusen > 3.5 &&
            $drusen <= 4.5 &&
            $av_chang <= 1.5 
        )
        {
            $terminalNode = -79;
            $result = 15;
        }

        /*Terminal Node 80*/
        if
        (
            $artery_d > 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia <= 4 &&
            $drusen > 3.5 &&
            $drusen <= 4.5 &&
            $av_chang > 1.5 
        )
        {
            $terminalNode = -80;
            $result = 0;
        }

        /*Terminal Node 81*/
        if
        (
            $artery_d > 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia > 4 &&
            $drusen > 2.5 &&
            $drusen <= 3.5 
        )
        {
            $terminalNode = -81;
            $result = 7;
        }

        /*Terminal Node 82*/
        if
        (
            $artery_d > 3.5 &&
            $cottonwo <= 1.5 &&
            $vein_dia > 4 &&
            $drusen > 3.5 &&
            $drusen <= 4.5 
        )
        {
            $terminalNode = -82;
            $result = 5;
        }

        /*Terminal Node 83*/
        if
        (
            $artery_d > 3.5 &&
            $drusen > 2.5 &&
            $drusen <= 4.5 &&
            $cottonwo > 1.5 
        )
        {
            $terminalNode = -83;
            $result = 8;
        }

        /*Terminal Node 84*/
        if
        (
            $drusen > 4.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 4.5 
        )
        {
            $terminalNode = -84;
            $result = 13;
        }

        /*Terminal Node 85*/
        if
        (
            $drusen > 4.5 &&
            $av_chang <= 1.5 &&
            $artery_d > 4.5 
        )
        {
            $terminalNode = -85;
            $result = 15;
        }

        /*Terminal Node 86*/
        if
        (
            $drusen > 4.5 &&
            $av_chang > 1.5 &&
            $artery_d > 3.5 &&
            $artery_d <= 5.5 
        )
        {
            $terminalNode = -86;
            $result = 7;
        }

        /*Terminal Node 87*/
        if
        (
            $drusen > 4.5 &&
            $av_chang > 1.5 &&
            $artery_d > 5.5 
        )
        {
            $terminalNode = -87;
            $result = 13;
        }



        //to poniżej zostawić!!
        $this->viewBuilder()->layout(false);
        $this->set('result', $result);
    }
}
