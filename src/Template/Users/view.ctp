<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User name') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Creation Date') ?></th>
            <td><?= h($user->creation_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <?php if (!empty($user->personal_data)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Birth Date') ?></th>
                <th><?= __('Sex') ?></th>
                <th><?= __('Phone No') ?></th>
                <th><?= __('Address') ?></th>
            </tr>
            <tr>
                <td><?= h($user->personal_data->first_name) ?></td>
                <td><?= h($user->personal_data->last_name) ?></td>
                <td><?= h($user->personal_data->birth_date) ?></td>
                <td><?= h($user->personal_data->sex)==0?'Female':'Male' ?></td>
                <td><?= h($user->personal_data->phone_no) ?></td>
                <td><?= h($user->personal_data->address) ?></td>
            </tr>
        </table>
        <?php endif; ?>
    </div>
</div>
