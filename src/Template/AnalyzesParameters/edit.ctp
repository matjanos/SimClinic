<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $analyzesParameter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $analyzesParameter->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Analyzes Parameters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="analyzesParameters form large-9 medium-8 columns content">
    <?= $this->Form->create($analyzesParameter) ?>
    <fieldset>
        <legend><?= __('Edit Analyzes Parameter') ?></legend>
        <?php
            echo $this->Form->input('analysis_id', ['options' => $analyzes]);
            echo $this->Form->input('parameter_id', ['options' => $parameters]);
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
