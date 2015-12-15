<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php if($this->isTechnican($authUser)){
    echo "<ul class=\"side-nav\">";
    echo "<li class=\"heading\">". __('Actions') ."</li>";
    echo "<li>". $this->Html->link(__('New Examination'), ['action' => 'add']) ."</li>";
    echo "</ul>";
    } ?>
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
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($examinations as $examination): ?>
            <?php if(($authUser['role']=='doctor' && $examination->analyze==null)||$authUser['role']!='doctor'): ?>
            <tr>
                <td><?= $this->Number->format($examination->id) ?></td>
                <td><?= $examination->has('technican') ? $this->Html->link($examination->technican->fullName, ['controller' => 'Users', 'action' => 'view', $examination->technican->id]) : ''?></td>
                <td><?= $examination->has('patient') ? $this->Html->link($examination->patient->fullName, ['controller' => 'Users', 'action' => 'view', $examination->patient->id]) : '' ?></td>
                <td><?= h($examination->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $examination->id]) ?>
                    <?= $this->isDoctor($authUser)?$this->Html->link(__('Analize'), ['controller' => 'Analyzes','action' => 'add', $examination->id]):'' ?>
                    <?= $this->isTechnican($authUser)?$this->Form->postLink(__('Delete'), ['action' => 'delete', $examination->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examination->id)]):'' ?>
                </td>
            </tr>
            <?php endif; ?>
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
