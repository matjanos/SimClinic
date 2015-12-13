<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Analyze'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Examinations'), ['controller' => 'Examinations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Examination'), ['controller' => 'Examinations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="analyzes index large-9 medium-8 columns content">
    <h3><?= __('Analyzes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('examination_id') ?></th>
                <th><?= $this->Paginator->sort('doctor_id') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($analyzes as $analyze): ?>
            <tr>
                <td><?= $this->Number->format($analyze->id) ?></td>
                <td><?= $analyze->has('examination') ? $this->Html->link($analyze->examination->id, ['controller' => 'Examinations', 'action' => 'view', $analyze->examination->id]) : '' ?></td>
                <td><?= $analyze->has('user') ? $this->Html->link($analyze->user->id, ['controller' => 'Users', 'action' => 'view', $analyze->user->id]) : '' ?></td>
                <td><?= h($analyze->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $analyze->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $analyze->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $analyze->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyze->id)]) ?>
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
