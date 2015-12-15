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
            echo $this->Form->input('doctor_id', ['options' => $doctors]);
            foreach ($parameters as $parameter) {
                echo "<div class='small-input'>";
                echo $this->Form->input("analyzes_parameters.".$parameter->id,['type'=>'select','options'=>range(0,$parameter->maxParameterValue),'id'=>'att'.$parameter->id,'label'=> $parameter->name]);   # code...
                echo "</div>";
            }
            echo $this->Form->input('Decision',['type'=>'select', 'options'=> range(1,16)]);
            echo "<br/><br/><span class='support'>According to our awesome support disease system it is: <span id='support-proposal'>unknown</span></span>";
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
$('#decision').focus(function(){
    var dataa=[];
    <?php
    foreach ($parameters as $parameter) {
     echo "dataa[\"".$parameter->id."\"] = $('#att".$parameter->id."').val(); ".PHP_EOL;  
    }
    ?>
    $.post( "../analyze-support/index.php", dataa).done(function( data )
     {
        $('#support-proposal').text( data );
    }  )
});
</script>