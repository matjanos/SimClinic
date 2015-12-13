<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Analyzes Parameter'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="analyzesParameters index large-9 medium-8 columns content">
    <h3><?= __('Analyzes Parameters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('analysis_id') ?></th>
                <th><?= $this->Paginator->sort('parameter_id') ?></th>
                <th><?= $this->Paginator->sort('value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($analyzesParameters as $analyzesParameter): ?>
            <tr>
                <td><?= $this->Number->format($analyzesParameter->id) ?></td>
                <td><?= $analyzesParameter->has('analyze') ? $this->Html->link($analyzesParameter->analyze->id, ['controller' => 'Analyzes', 'action' => 'view', $analyzesParameter->analyze->id]) : '' ?></td>
                <td><?= $analyzesParameter->has('parameter') ? $this->Html->link($analyzesParameter->parameter->name, ['controller' => 'Parameters', 'action' => 'view', $analyzesParameter->parameter->id]) : '' ?></td>
                <td><?= $this->Number->format($analyzesParameter->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $analyzesParameter->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $analyzesParameter->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $analyzesParameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyzesParameter->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
