<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $examination->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $examination->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Examinations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examinations form large-9 medium-8 columns content">
    <?= $this->Form->create($examination) ?>
    <fieldset>
        <legend><?= __('Edit Examination') ?></legend>
        <?php
            echo $this->Form->input('technican_id');
            echo $this->Form->input('patient_id', ['options' => $users]);
            echo $this->Form->input('date');
            echo $this->Form->input('eye_side');
            echo $this->Form->input('image_path');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
