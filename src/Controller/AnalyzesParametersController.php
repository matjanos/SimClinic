<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AnalyzesParameters Controller
 *
 * @property \App\Model\Table\AnalyzesParametersTable $AnalyzesParameters
 */
class AnalyzesParametersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Analyzes', 'Parameters']
        ];
        $this->set('analyzesParameters', $this->paginate($this->AnalyzesParameters));
        $this->set('_serialize', ['analyzesParameters']);
    }

    /**
     * View method
     *
     * @param string|null $id Analyzes Parameter id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $analyzesParameter = $this->AnalyzesParameters->get($id, [
            'contain' => ['Analyzes', 'Parameters']
        ]);
        $this->set('analyzesParameter', $analyzesParameter);
        $this->set('_serialize', ['analyzesParameter']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $analyzesParameter = $this->AnalyzesParameters->newEntity();
        if ($this->request->is('post')) {
            $analyzesParameter = $this->AnalyzesParameters->patchEntity($analyzesParameter, $this->request->data);
            if ($this->AnalyzesParameters->save($analyzesParameter)) {
                $this->Flash->success(__('The analyzes parameter has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The analyzes parameter could not be saved. Please, try again.'));
            }
        }
        $analyzes = $this->AnalyzesParameters->Analyzes->find('list', ['limit' => 200]);
        $parameters = $this->AnalyzesParameters->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('analyzesParameter', 'analyzes', 'parameters'));
        $this->set('_serialize', ['analyzesParameter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Analyzes Parameter id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $analyzesParameter = $this->AnalyzesParameters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $analyzesParameter = $this->AnalyzesParameters->patchEntity($analyzesParameter, $this->request->data);
            if ($this->AnalyzesParameters->save($analyzesParameter)) {
                $this->Flash->success(__('The analyzes parameter has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The analyzes parameter could not be saved. Please, try again.'));
            }
        }
        $analyzes = $this->AnalyzesParameters->Analyzes->find('list', ['limit' => 200]);
        $parameters = $this->AnalyzesParameters->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('analyzesParameter', 'analyzes', 'parameters'));
        $this->set('_serialize', ['analyzesParameter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Analyzes Parameter id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $analyzesParameter = $this->AnalyzesParameters->get($id);
        if ($this->AnalyzesParameters->delete($analyzesParameter)) {
            $this->Flash->success(__('The analyzes parameter has been deleted.'));
        } else {
            $this->Flash->error(__('The analyzes parameter could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
