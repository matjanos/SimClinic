<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personal Data'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personalData index large-9 medium-8 columns content">
    <h3><?= __('Personal Data') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('first_name') ?></th>
                <th><?= $this->Paginator->sort('last_name') ?></th>
                <th><?= $this->Paginator->sort('birth_date') ?></th>
                <th><?= $this->Paginator->sort('sex') ?></th>
                <th><?= $this->Paginator->sort('phone_no') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personalData as $personalData): ?>
            <tr>
                <td><?= $this->Number->format($personalData->id) ?></td>
                <td><?= $personalData->has('user') ? $this->Html->link($personalData->user->id, ['controller' => 'Users', 'action' => 'view', $personalData->user->id]) : '' ?></td>
                <td><?= h($personalData->first_name) ?></td>
                <td><?= h($personalData->last_name) ?></td>
                <td><?= h($personalData->birth_date) ?></td>
                <td><?= $this->Number->format($personalData->sex) ?></td>
                <td><?= h($personalData->phone_no) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personalData->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personalData->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personalData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personalData->id)]) ?>
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
