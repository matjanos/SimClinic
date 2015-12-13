<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Examination'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examinations index large-9 medium-8 columns content">
    <h3><?= __('Examinations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('technican_id') ?></th>
                <th><?= $this->Paginator->sort('patient_id') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('eye_side') ?></th>
                <th><?= $this->Paginator->sort('image_path') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($examinations as $examination): ?>
            <tr>
                <td><?= $this->Number->format($examination->id) ?></td>
                <td><?= $this->Number->format($examination->technican_id) ?></td>
                <td><?= $examination->has('user') ? $this->Html->link($examination->user->id, ['controller' => 'Users', 'action' => 'view', $examination->user->id]) : '' ?></td>
                <td><?= h($examination->date) ?></td>
                <td><?= $this->Number->format($examination->eye_side) ?></td>
                <td><?= h($examination->image_path) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $examination->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $examination->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $examination->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examination->id)]) ?>
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
