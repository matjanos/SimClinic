<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Analyze'), ['action' => 'edit', $analyze->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Analyze'), ['action' => 'delete', $analyze->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyze->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Analyzes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyze'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Examinations'), ['controller' => 'Examinations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Examination'), ['controller' => 'Examinations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="analyzes view large-9 medium-8 columns content">
    <h3><?= h($analyze->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Examination') ?></th>
            <td><?= $analyze->has('examination') ? $this->Html->link($analyze->examination->id, ['controller' => 'Examinations', 'action' => 'view', $analyze->examination->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $analyze->has('user') ? $this->Html->link($analyze->user->id, ['controller' => 'Users', 'action' => 'view', $analyze->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($analyze->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($analyze->date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Parameters') ?></h4>
        <?php if (!empty($analyze->parameters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('MeasureUnit') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($analyze->parameters as $parameters): ?>
            <tr>
                <td><?= h($parameters->id) ?></td>
                <td><?= h($parameters->name) ?></td>
                <td><?= h($parameters->measureUnit) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Parameters', 'action' => 'view', $parameters->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Parameters', 'action' => 'edit', $parameters->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Parameters', 'action' => 'delete', $parameters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameters->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
