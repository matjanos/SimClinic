<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personal Data'), ['action' => 'edit', $personalData->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personal Data'), ['action' => 'delete', $personalData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personalData->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personal Data'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personal Data'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personalData view large-9 medium-8 columns content">
    <h3><?= h($personalData->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $personalData->has('user') ? $this->Html->link($personalData->user->id, ['controller' => 'Users', 'action' => 'view', $personalData->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($personalData->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($personalData->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone No') ?></th>
            <td><?= h($personalData->phone_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($personalData->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personalData->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Sex') ?></th>
            <td><?= $this->Number->format($personalData->sex) ?></td>
        </tr>
        <tr>
            <th><?= __('Birth Date') ?></th>
            <td><?= h($personalData->birth_date) ?></td>
        </tr>
    </table>
</div>
