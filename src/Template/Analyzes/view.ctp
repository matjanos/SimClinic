<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['action' => 'index']) ?> </li>
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
            <th><?= __('Doctor') ?></th>
            <td><?= $analyze->has('doctor') ? $this->Html->link($analyze->doctor->fullName, ['controller' => 'Users', 'action' => 'view', $analyze->doctor->id]) : '' ?></td>
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
