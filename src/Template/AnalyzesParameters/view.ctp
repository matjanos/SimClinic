<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Analyzes Parameter'), ['action' => 'edit', $analyzesParameter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Analyzes Parameter'), ['action' => 'delete', $analyzesParameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyzesParameter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Analyzes Parameters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyzes Parameter'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="analyzesParameters view large-9 medium-8 columns content">
    <h3><?= h($analyzesParameter->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Analyze') ?></th>
            <td><?= $analyzesParameter->has('analyze') ? $this->Html->link($analyzesParameter->analyze->id, ['controller' => 'Analyzes', 'action' => 'view', $analyzesParameter->analyze->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Parameter') ?></th>
            <td><?= $analyzesParameter->has('parameter') ? $this->Html->link($analyzesParameter->parameter->name, ['controller' => 'Parameters', 'action' => 'view', $analyzesParameter->parameter->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($analyzesParameter->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= $this->Number->format($analyzesParameter->value) ?></td>
        </tr>
    </table>
</div>
