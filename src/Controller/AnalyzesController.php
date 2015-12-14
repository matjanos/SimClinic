<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Analyzes Controller
 *
 * @property \App\Model\Table\AnalyzesTable $Analyzes
 */
class AnalyzesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Examinations', 'Users']
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
        $analyze = $this->Analyzes->get($id, [
            'contain' => ['Examinations', 'Users', 'Parameters']
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
        $analyze = $this->Analyzes->newEntity();
        $analyze->examination = $this->Analyzes->Examinations->get($id);
        $analyze->user=$this->Auth->user();
        if ($this->request->is('post')) {
            $analyze = $this->Analyzes->patchEntity($analyze, $this->request->data);
            if ($this->Analyzes->save($analyze)) {
                $this->Flash->success(__('The analyze has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The analyze could not be saved. Please, try again.'));
            }
        }
        $parameters = $this->Analyzes->Parameters->find('all', ['limit' => 200]);
        $this->set(compact('analyze', 'users' ,'parameters'));
        $this->set('_serialize', ['analyze']);
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
        $this->request->allowMethod(['post', 'delete']);
        $analyze = $this->Analyzes->get($id);
        if ($this->Analyzes->delete($analyze)) {
            $this->Flash->success(__('The analyze has been deleted.'));
        } else {
            $this->Flash->error(__('The analyze could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
