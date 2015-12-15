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
        <h4><?= __('Parameters') ?></h4>
        <?php if (!empty($analyze->analyzes_parameters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Name') ?></th>
                <th><?= __('Value') ?></th>
            </tr>
            <?php foreach ($analyze->analyzes_parameters as $parameterValue): ?>
            <tr>
                <td><?= h($parameterValue->parameter->name)." (0-".h($parameterValue->parameter->maxParameterValue).")" ?></td>
                <td><?= h($parameterValue->value) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
