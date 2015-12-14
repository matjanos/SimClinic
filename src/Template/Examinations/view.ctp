<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(__('Delete Examination'), ['action' => 'delete', $examination->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examination->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Examinations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Examination'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Analyze'), ['controller' => 'Analyzes', 'action' => 'add', $examination->id]) ?> </li>
    </ul>
</nav>
<div class="examinations view large-9 medium-8 columns content">
    <h3><?= "Examination no. ".h($examination->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Patient') ?></th>
            <td><?= $examination->has('patient') ? $this->Html->link($examination->patient->fullName, ['controller' => 'Users', 'action' => 'view', $examination->patient->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Technician') ?></th>
            <td><?= $examination->has('technican') ? $this->Html->link($examination->technican->fullName, ['controller' => 'Users', 'action' => 'view', $examination->technican->id]) : '' ?></td>
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
            <?= $this->Html->Image($examination->image_path,[
                                'width'    => '600',
                                'height'   => '600',
                                'alt'      => 'No Image' 
                             ]) ?>
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
