<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('role', [
            'options' => ['technican' => 'Technician', 'doctor' => 'Doctor', 'patient' => 'Patient']
        ]) ?>
        <?php
            echo $this->Form->input('personal_data.first_name');
            echo $this->Form->input('personal_data.last_name');
            echo $this->Form->input('personal_data.birth_date',['minYear'=>date('Y')-100]);
            echo $this->Form->input('personal_data.sex', ['options'=>[1=>'Male',0=>'Female']]);
            echo $this->Form->input('personal_data.phone_no');
            echo $this->Form->input('personal_data.address');
        ?>
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>