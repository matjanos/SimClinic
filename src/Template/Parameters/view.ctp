<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parameter'), ['action' => 'edit', $parameter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parameter'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parameters view large-9 medium-8 columns content">
    <h3><?= h($parameter->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($parameter->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= $this->Number->format($parameter->name) ?></td>
        </tr>
        <tr>
            <th><?= __('MeasureUnit') ?></th>
            <td><?= $this->Number->format($parameter->measureUnit) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Analyzes') ?></h4>
        <?php if (!empty($parameter->analyzes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Examination Id') ?></th>
                <th><?= __('Doctor Id') ?></th>
                <th><?= __('Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($parameter->analyzes as $analyzes): ?>
            <tr>
                <td><?= h($analyzes->id) ?></td>
                <td><?= h($analyzes->examination_id) ?></td>
                <td><?= h($analyzes->doctor_id) ?></td>
                <td><?= h($analyzes->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Analyzes', 'action' => 'view', $analyzes->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Analyzes', 'action' => 'edit', $analyzes->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Analyzes', 'action' => 'delete', $analyzes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyzes->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
