<div class="view list">
<h4><?php echo $html->link(__('All', true), array('controller'=> 'threadcats', 'action'=>'index')); ?> -> <?php echo $threadcat['Threadcat']['name']; ?></h4>
</div>
<br/>
<div class="view list">
	<div class="threads form" >
	
	
	<?php echo $form->create('Thread');?>
		<?php
			echo $form->input('title', array('style' => 'width:250px'));
			echo $form->input('body', array('cols' => '60'));		
			echo $form->input('threadcat_id', array('type'=>'hidden', 'value'=>$threadCatId));
		?>
		<br/>
	<?php echo $form->end(strtoupper(__('Submit', true)));?>
	
	</div>
</div>
