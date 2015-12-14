<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Examinations Controller
 *
 * @property \App\Model\Table\ExaminationsTable $Examinations
 */
class ExaminationsController extends AppController
{
     public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Upload');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Technicans', 'Technicans.PersonalData','Patients', 'Patients.PersonalData']
        ];
        $this->set('examinations', $this->paginate($this->Examinations));
        $this->set('_serialize', ['examinations']);
    }

    /**
     * View method
     *
     * @param string|null $id Examination id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $examination = $this->Examinations->get($id, [
            'contain' => ['Technicans', 'Technicans.PersonalData','Patients', 'Patients.PersonalData']
        ]);
        $this->set('examination', $examination);
        $this->set('_serialize', ['examination']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $examination = $this->Examinations->newEntity();
        if ($this->request->is('post')) {

            $examination = $this->Examinations->patchEntity($examination, $this->request->data);

            $imageUrl= $this->Upload->upload($this->request->data['image_path']);
            $examination->image_path=$imageUrl;

            if ($this->Examinations->save($examination)) {
                $this->Flash->success(__('The examination has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The examination could not be saved. Please, try again.'));
            }
        }
        $patients = $this->Examinations->Patients->find('list', [
            'limit' => 200,
            'conditions' => ['Patients.role LIKE' => 'patient'],
            'valueField' =>  'full_name',
            'keyField' => 'id'
            ])->contain(['PersonalData']);

        $technicians = $this->Examinations->Technicans->find('list', [
            'limit' => 200,
            'conditions' => ['Technicans.role LIKE' => 'technican'],
            'valueField' =>  'full_name',
            'keyField' => 'id'
            ])->contain(['PersonalData']);
        $this->set(compact('examination', 'patients','technicians'));
        $this->set('_serialize', ['examination']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Examination id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $examination = $this->Examinations->get($id);
        if ($this->Examinations->delete($examination)) {
            $this->Flash->success(__('The examination has been deleted.'));
        } else {
            $this->Flash->error(__('The examination could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
