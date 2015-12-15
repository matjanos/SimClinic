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
                echo $this->Form->input("analyzes_parameters.".$parameter->id,['id'=>'att'.$parameter->id,'label'=> $parameter->name,'type'=>'number','min'=>'0', 'max'=>$parameter->maxParameterValue]);   # code...
                echo "</div>";
            }
            echo "<span class='support'>According to our awesome support disease system it is: <span id='support-proposal'>unknown</span></span>";
            echo $this->Form->input('Decision',['type'=>'number','min'=>'0', 'id'=>'decision']);
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