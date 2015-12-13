<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $analyze->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $analyze->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Examinations'), ['controller' => 'Examinations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Examination'), ['controller' => 'Examinations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="analyzes form large-9 medium-8 columns content">
    <?= $this->Form->create($analyze) ?>
    <fieldset>
        <legend><?= __('Edit Analyze') ?></legend>
        <?php
            echo $this->Form->input('examination_id', ['options' => $examinations]);
            echo $this->Form->input('doctor_id', ['options' => $users]);
            echo $this->Form->input('date');
            echo $this->Form->input('parameters._ids', ['options' => $parameters]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
