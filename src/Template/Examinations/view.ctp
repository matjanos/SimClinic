<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Examination'), ['action' => 'edit', $examination->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Examination'), ['action' => 'delete', $examination->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examination->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Examinations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Examination'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Analyzes'), ['controller' => 'Analyzes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Analyze'), ['controller' => 'Analyzes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="examinations view large-9 medium-8 columns content">
    <h3><?= h($examination->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $examination->has('user') ? $this->Html->link($examination->user->id, ['controller' => 'Users', 'action' => 'view', $examination->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Image Path') ?></th>
            <td><?= $this->Html->Image($examination->image_path,[
                                'width'    => '100',
                                'height'   => '100',
                                'alt'      => 'No Image' 
                             ]) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($examination->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Technican Id') ?></th>
            <td><?= $this->Number->format($examination->technican_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Eye Side') ?></th>
            <td><?= $this->Number->format($examination->eye_side)==0?'Left':'Right' ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($examination->date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Analyzes') ?></h4>
        <?php if (!empty($examination->analyzes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Examination Id') ?></th>
                <th><?= __('Doctor Id') ?></th>
                <th><?= __('Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($examination->analyzes as $analyzes): ?>
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
