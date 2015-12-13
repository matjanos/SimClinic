<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personalData->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personalData->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Personal Data'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personalData form large-9 medium-8 columns content">
    <?= $this->Form->create($personalData) ?>
    <fieldset>
        <legend><?= __('Edit Personal Data') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('birth_date');
            echo $this->Form->input('sex');
            echo $this->Form->input('phone_no');
            echo $this->Form->input('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
