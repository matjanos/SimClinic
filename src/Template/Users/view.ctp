<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personal Data'), ['controller' => 'PersonalData', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personal Data'), ['controller' => 'PersonalData', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
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
        <h4><?= __('Related Personal Data') ?></h4>
        <?php if (!empty($user->personal_data)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Birth Date') ?></th>
                <th><?= __('Sex') ?></th>
                <th><?= __('Phone No') ?></th>
                <th><?= __('Address') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->personal_data as $personalData): ?>
            <tr>
                <td><?= h($personalData->id) ?></td>
                <td><?= h($personalData->user_id) ?></td>
                <td><?= h($personalData->first_name) ?></td>
                <td><?= h($personalData->last_name) ?></td>
                <td><?= h($personalData->birth_date) ?></td>
                <td><?= h($personalData->sex) ?></td>
                <td><?= h($personalData->phone_no) ?></td>
                <td><?= h($personalData->address) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PersonalData', 'action' => 'view', $personalData->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'PersonalData', 'action' => 'edit', $personalData->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PersonalData', 'action' => 'delete', $personalData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personalData->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
