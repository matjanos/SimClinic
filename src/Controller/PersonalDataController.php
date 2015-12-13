<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PersonalData Controller
 *
 * @property \App\Model\Table\PersonalDataTable $PersonalData
 */
class PersonalDataController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('personalData', $this->paginate($this->PersonalData));
        $this->set('_serialize', ['personalData']);
    }

    /**
     * View method
     *
     * @param string|null $id Personal Data id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personalData = $this->PersonalData->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('personalData', $personalData);
        $this->set('_serialize', ['personalData']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personalData = $this->PersonalData->newEntity();
        if ($this->request->is('post')) {
            $personalData = $this->PersonalData->patchEntity($personalData, $this->request->data);
            if ($this->PersonalData->save($personalData)) {
                $this->Flash->success(__('The personal data has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personal data could not be saved. Please, try again.'));
            }
        }
        $users = $this->PersonalData->Users->find('list', ['limit' => 200]);
        $this->set(compact('personalData', 'users'));
        $this->set('_serialize', ['personalData']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Personal Data id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personalData = $this->PersonalData->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personalData = $this->PersonalData->patchEntity($personalData, $this->request->data);
            if ($this->PersonalData->save($personalData)) {
                $this->Flash->success(__('The personal data has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The personal data could not be saved. Please, try again.'));
            }
        }
        $users = $this->PersonalData->Users->find('list', ['limit' => 200]);
        $this->set(compact('personalData', 'users'));
        $this->set('_serialize', ['personalData']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Personal Data id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personalData = $this->PersonalData->get($id);
        if ($this->PersonalData->delete($personalData)) {
            $this->Flash->success(__('The personal data has been deleted.'));
        } else {
            $this->Flash->error(__('The personal data could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
