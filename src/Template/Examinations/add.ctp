<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Examinations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examinations form large-9 medium-8 columns content">
    <?= $this->Form->create($examination, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Examination') ?></legend>
        <?php
            echo $this->Form->input('technican_id', ['options' => $technicians, 'empty'=>'Choose one...']);
            echo $this->Form->input('patient_id', ['options' => $patients, 'empty'=>'Choose one...']);
            echo $this->Form->input('date',[
                'minYear' => date('Y') - 120,
                'maxYear' => date('Y') ]);
            echo $this->Form->input('eye_side',['options'=>[0=>'Left', 1=>'Right']]);
            echo $this->Form->input('image_path',['type'=>'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
