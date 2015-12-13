<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="parameters index large-9 medium-8 columns content">
    <h3><?= __('Parameters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('measureUnit') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parameters as $parameter): ?>
            <tr>
                <td><?= $this->Number->format($parameter->id) ?></td>
                <td><?= $this->Number->format($parameter->name) ?></td>
                <td><?= $this->Number->format($parameter->measureUnit) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $parameter->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $parameter->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?>
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