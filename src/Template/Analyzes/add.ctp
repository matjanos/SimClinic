<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Analyzes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Examinations'), ['controller' => 'Examinations', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="analyzes form large-9 medium-8 columns content">
    <?= $this->Form->create($analyze) ?>
    <fieldset>
        <legend><?= __('Add Analyze') ?></legend>
        <?php
            echo $this->Html->image($analyze->examination->image_path);
            echo $this->Form->input('date');
            foreach ($parameters as $key=>$value) {
                echo "<div class='small-input'>";
                echo $this->Form->input($value->name,['type'=>'number','min'=>'0', 'max'=>$value->maxParameterValue]);   # code...
                echo "</div>";
            }
            echo $this->Form->input('Decision',['type'=>'number','min'=>'0']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
